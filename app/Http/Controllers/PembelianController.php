<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Supplier;
use App\Models\PembelianDetail;
use App\Models\Produk;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use App\Models\Inventory;
use Barryvdh\DomPDF\Facade\Pdf;




class PembelianController extends Controller
{
    public function index()
    {
        $supplier = Supplier::orderBy('nama')->get();

        return view('pembelian.index', compact('supplier'));
    }


    public function data()
    {
        $pembelian = Pembelian::orderBy('id_pembelian', 'desc')->get();

        return datatables()
            ->of($pembelian)
            ->addIndexColumn()
            ->addColumn('total_item', function ($pembelian) {
                return formatkg($pembelian->total_item);
            })
            ->addColumn('total_harga', function ($pembelian) {
                return format_uang($pembelian->total_harga);
            })
            ->addColumn('bayar', function ($pembelian) {
                return format_uang($pembelian->bayar);
            })
            ->addColumn('tanggal', function ($pembelian) {
                return tanggal_indonesia($pembelian->created_at);
            })
            ->addColumn('supplier', function ($pembelian) {
                return $pembelian->supplier->nama;
            })
            ->editColumn('diskon', function ($pembelian) {
                return $pembelian->diskon . '%';
            })
            ->addColumn('aksi', function ($pembelian) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('pembelian.show', $pembelian->id_pembelian) .'`)" class="btn btn-xs btn-info btn-flat mr-1">
                        Lihat <i class="fa fa-eye"></i>
                    </button>
                    <button onclick="deleteData(`'. route('pembelian.destroy', $pembelian->id_pembelian) .'`)" class="btn btn-xs btn-danger btn-flat">
                        Hapus <i class="fa fa-trash"></i>
                    </button>
                </div>
                ';
            })
            
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function create($id)
    {
        $pembelian = new Pembelian();
        $pembelian->id_supplier = $id;
        $pembelian->total_item  = 0;
        $pembelian->total_harga = 0;
        $pembelian->diskon      = 0;
        $pembelian->bayar       = 0;
        $pembelian->save();

        session(['id_pembelian'=> $pembelian->id_pembelian]);
        session(['id_supplier'=> $pembelian->id_supplier]);

        return redirect()->route('pembelian_detail.index');

    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $pembelian = Pembelian::findOrFail($request->id_pembelian);
            $pembelian->total_item = $request->total_item;
            $pembelian->total_harga = $request->total;
            $pembelian->diskon = $request->diskon;
            $pembelian->bayar = $request->bayar;
            $pembelian->update();
    
            $detail = PembelianDetail::where('id_pembelian', $pembelian->id_pembelian)->get();
            foreach ($detail as $item) {
                $produk = Produk::find($item->id_produk);
                if ($produk) {
                    $produk->stok += $item->jumlah; // Menambah stok produk
                    $produk->update();
    
                    // Mencatat aktivitas pembelian ke tabel inventory
                    Inventory::create([
                        'activity_type' => 'Pembelian',
                        'id_pembelian' => $pembelian->id_pembelian,
                        'id_produk' => $item->id_produk,
                        'quantity' => $item->jumlah,
                    ]);
                }
            }
    
            DB::commit();
            return redirect()->route('pembelian_transaksi.selesai');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error in store method: ' . $e->getMessage());
            return redirect()->route('pembelian_transaksi.selesai')->with('error', $e->getMessage());
        }
    }

    public function selesai()
    {
        $supplier = Supplier::first();

        return view('pembelian.selesai', compact('supplier'));
    }
    

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $pembelian = Pembelian::findOrFail($id);
            $details = PembelianDetail::where('id_pembelian', $pembelian->id_pembelian)->get();
    
            foreach ($details as $item) {
                $produk = Produk::find($item->id_produk);
                if ($produk) {
                    $produk->stok -= $item->jumlah; // Mengurangi stok produk
                    $produk->update();
    
                    // Mencatat aktivitas penghapusan ke tabel inventory
                    Inventory::create([
                        'activity_type' => 'Pengembalian ke supplier',
                        'id_pembelian' => $pembelian->id_pembelian,
                        'id_produk' => $item->id_produk,
                        'quantity' => $item->jumlah,
                    ]);
    
                    // Hapus detail pembelian
                    $item->delete();
                }
            }
    
            // Hapus pembelian
            $pembelian->delete();
    
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error in destroy method: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $detail = PembelianDetail::with('produk')->where('id_pembelian', $id)->get();

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
            ->addColumn('harga_beli', function ($detail) {
                return format_uang($detail->harga_beli);
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

    public function cancel($id)
{
    DB::beginTransaction();
    try {
        $pembelian = Pembelian::findOrFail($id);
        $details = PembelianDetail::where('id_pembelian', $pembelian->id_pembelian)->get();

        foreach ($details as $item) {
            $produk = Produk::find($item->id_produk);
            $produk->update();
            $item->delete(); // Hapus detail pembelian
        }

        $pembelian->delete(); // Hapus pembelian

        session()->forget('id_pembelian');
        session()->forget('id_supplier');

        DB::commit();
        return redirect()->route('pembelian.index')->with('success', 'Transaksi berhasil dibatalkan');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('pembelian.index')->with('error', $e->getMessage());
    }
}

    public function notaKecil()
    {
        $setting = Setting::first();
        $pembelian = Pembelian::find(session('id_pembelian'));
        if (!$pembelian) {
            abort(404);
        }
        $detail = pembelianDetail::with('produk')
            ->where('id_pembelian', session('id_pembelian'))
            ->get();
        
        return view('pembelian.nota_kecil', compact('setting', 'pembelian', 'detail'));
    }

    public function notaBesar()
    {
        $supplier = Supplier::first();
        $setting = Setting::first();
        $pembelian = Pembelian::find(session('id_pembelian', 'id_supplier'));
        if (! $pembelian) {
            abort(404);
        }
        $detail = PembelianDetail::with('produk', 'supplier')
            ->where('id_pembelian', session('id_pembelian'))
            ->get();

        $pdf = Pdf::loadView('pembelian.nota_besar', compact('supplier','setting', 'pembelian', 'detail'));
        $pdf->setPaper([0, 0, 609, 440], 'portrait'); // Menggunakan array untuk ukuran kertas dan string untuk orientasi

        return $pdf->stream('Transaksi-'. date('Y-m-d-his') .'.pdf');
    }

}
