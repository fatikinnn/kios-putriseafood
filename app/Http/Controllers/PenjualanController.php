<?php
namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\PenjualanDetail;
use App\Models\Setting;
use App\Models\Inventory; // Tambahkan ini untuk Inventory
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    public function index()
    {
        return view('penjualan.index');
    }

    public function data()
    {
        $user = auth()->user();
    
        if ($user->level == 1) {
            $penjualan = Penjualan::with('member')->orderBy('id_penjualan', 'desc')->get();
        } else {
            $penjualan = Penjualan::with('member')
                ->where('id_user', $user->id)
                ->orderBy('id_penjualan', 'desc')
                ->get();
        }
    
        return datatables()
            ->of($penjualan)
            ->addIndexColumn()
            ->addColumn('total_item', function ($penjualan) {
                return formatkg($penjualan->total_item);
            })
            ->addColumn('total_harga', function ($penjualan) {
                return format_uang($penjualan->total_harga);
            })
            ->addColumn('bayar', function ($penjualan) {
                return format_uang($penjualan->bayar);
            })
            ->addColumn('tanggal', function ($penjualan) {
                return tanggal_indonesia($penjualan->created_at);
            })
            ->addColumn('nama', function ($penjualan) {
                $member = $penjualan->member->nama ?? 'Umum';
                return '<span>'. $member .'</span>';
            })
            ->editColumn('diskon', function ($penjualan) {
                return $penjualan->diskon . '%';
            })
            ->editColumn('kasir', function ($penjualan) {
                return $penjualan->user->name ?? '';
            })
            ->addColumn('aksi', function ($penjualan) {
                $buttons = '<div class="btn-group">
                    <button onclick="showDetail(`' . route('penjualan.show', $penjualan->id_penjualan) . '`)" class="btn btn-xs btn-info btn-flat mr-1"><i class="fa fa-eye"></i> Lihat</button>';
    
                if (auth()->user()->level == 1) {
                    $buttons .= '<button onclick="deleteData(`' . route('penjualan.destroy', $penjualan->id_penjualan) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</button>';
                }
    
                $buttons .= '</div>';
                return $buttons;
            })
            ->rawColumns(['aksi', 'nama'])
            ->make(true);
    }
    

    public function create()
    {
        $penjualan = new Penjualan();
        $penjualan->id_member = null;
        $penjualan->total_item = 0;
        $penjualan->total_harga = 0;
        $penjualan->diskon = 0;
        $penjualan->bayar = 0;
        $penjualan->diterima = 0;
        $penjualan->id_user = auth()->id();
        $penjualan->save();

        session(['id_penjualan' => $penjualan->id_penjualan]);
        return redirect()->route('transaksi.index');
    }

    public function cancel($id)
    {
        DB::beginTransaction();
        try {
            $penjualan = Penjualan::findOrFail($id);
            $details = PenjualanDetail::where('id_penjualan', $penjualan->id_penjualan)->get();
    
            foreach ($details as $item) {
                $produk = Produk::find($item->id_produk);
                if ($produk) {
                    $produk->stok += $item->jumlah; // Menambah stok produk kembali
                    $produk->update();

                    // Mencatat aktivitas penghapusan ke tabel inventory
                    Inventory::create([
                        'activity_type' => 'Pengembalian',
                        'id_penjualan' => $penjualan->id_penjualan,
                        'id_produk' => $item->id_produk,
                        'quantity' => $item->jumlah,
                    ]);
                }
                $item->delete(); // Hapus detail Penjualan
            }
    
            $penjualan->delete(); // Hapus Penjualan
    
            session()->forget('id_penjualan');
            session()->forget('id_user');
            session()->forget('id_member');

            DB::commit();
            return redirect()->route('penjualan.index')->with('success', 'Transaksi berhasil dibatalkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('penjualan.index')->with('error', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            // Mulai transaksi
            DB::beginTransaction();
    
            $penjualan = Penjualan::findOrFail($request->id_penjualan);
    
            $penjualan->id_member = $request->id_member;
            $penjualan->total_item = $request->total_item;
            $penjualan->total_harga = $request->total;
            $penjualan->diskon = $request->diskon;
            $penjualan->bayar = $this->convertToNumber($request->bayar); // Konversi nilai bayar
            $penjualan->diterima = $this->convertToNumber($request->diterima); // Konversi nilai diterima
            $penjualan->update();
    
            $detail = PenjualanDetail::where('id_penjualan', $penjualan->id_penjualan)->get();
            foreach ($detail as $item) {
                $item->diskon = $request->diskon;
                $item->update();
    
                $produk = Produk::find($item->id_produk);
                $produk->stok -= $item->jumlah;
                $produk->update();

                // Mencatat aktivitas penjualan ke tabel inventory
                Inventory::create([
                    'activity_type' => 'Penjualan',
                    'id_penjualan' => $penjualan->id_penjualan,
                    'id_produk' => $item->id_produk,
                    'quantity' => $item->jumlah,
                ]);
            }
    
            // Commit transaksi
            DB::commit();
    
            return redirect()->route('transaksi.selesai');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('penjualan.index')->with('error', $e->getMessage());
        }
    }
    
    private function convertToNumber($value)
    {
        // Menghapus simbol mata uang dan pemisah ribuan
        $value = str_replace(['Rp', '.', ','], ['', '', '.'], $value);
        return (float) $value;
    }

    public function selesai()
    {
        $setting = Setting::first();
        return view('penjualan.selesai', compact('setting'));
    }

    public function show($id)
    {
        $detail = PenjualanDetail::with('produk')->where('id_penjualan', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('kode_produk', function ($detail) {
                return '<span class="badge badge-warning">'. $detail->produk->kode_produk .'</span>';
            })
            ->addColumn('nama_produk', function ($detail) {
                return $detail->produk->nama_produk;
            })
            ->addColumn('jenis', function ($detail) {
                return $detail->produk->jenis;
            })
            ->addColumn('harga_jual', function ($detail) {
                return format_uang($detail->harga_jual);
            })
            ->addColumn('jumlah', function ($detail) {
                return formatkg($detail->jumlah);
            })
            ->addColumn('subtotal', function ($detail) {
                return format_uang($detail->subtotal);
            })
            ->rawColumns(['kode_produk'])
            ->make(true);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $penjualan = Penjualan::findOrFail($id);
            $details = PenjualanDetail::where('id_penjualan', $penjualan->id_penjualan)->get();

            foreach ($details as $item) {
                $produk = Produk::find($item->id_produk);
                if ($produk) {
                    $produk->stok += $item->jumlah; // Mengembalikan stok produk
                    $produk->update();

                    // Mencatat aktivitas penghapusan ke tabel inventory
                    Inventory::create([
                        'activity_type' => 'Pengembalian dari customer',
                        'id_penjualan' => $penjualan->id_penjualan,
                        'id_produk' => $item->id_produk,
                        'quantity' => $item->jumlah,
                    ]);
                }
                $item->delete(); // Hapus detail penjualan
            }

            // Hapus penjualan
            $penjualan->delete();

            DB::commit();
            return response(null, 204);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function notaKecil()
    {
        $setting = Setting::first();
        $penjualan = Penjualan::find(session('id_penjualan'));
        if (!$penjualan) {
            abort(404);
        }
        $detail = PenjualanDetail::with('produk')
            ->where('id_penjualan', session('id_penjualan'))
            ->get();
        
        return view('penjualan.nota_kecil', compact('setting', 'penjualan', 'detail'));
    }

    public function notaBesar()
    {
        $setting = Setting::first();
        $penjualan = Penjualan::find(session('id_penjualan'));
        if (! $penjualan) {
            abort(404);
        }
        $detail = PenjualanDetail::with('produk')
            ->where('id_penjualan', session('id_penjualan'))
            ->get();

        $pdf = Pdf::loadView('penjualan.nota_besar', compact('setting', 'penjualan', 'detail'));
        $pdf->setPaper([0, 0, 609, 440], 'portrait'); // Menggunakan array untuk ukuran kertas dan string untuk orientasi

        return $pdf->stream('Transaksi-'. date('Y-m-d-his') .'.pdf');
    }
}
