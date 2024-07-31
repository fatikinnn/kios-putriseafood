<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all()->pluck('nama_kategori', 'id_kategori');

        return view('produk.index', compact('kategori'));
    }

    public function data()
    {
        $produk = Produk::leftjoin('kategori', 'kategori.id_kategori', 'produk.id_kategori')
        ->select('produk.*', 'nama_kategori')
        ->orderBy('kode_produk', 'asc')
        ->get();

        return datatables()
        ->of($produk)
        ->addIndexColumn()
        ->addColumn('select_all', function ($produk) {
            return '
                <input type="checkbox" name="id_produk[]" value="'. $produk->id_produk .'">
            ';
        })
        ->addColumn('kode_produk', function ($produk) {
            return '<span class="badge badge-warning">' . $produk->kode_produk . '</span>';
        })
        ->addColumn('harga_beli', function ($produk) {
            return format_uang($produk->harga_beli);
        })
        ->addColumn('harga_jual', function ($produk) {
            return format_uang($produk->harga_jual);
        })
        ->addColumn('stok', function ($produk) {
            return formatKg($produk->stok);
        })
        ->editColumn('diskon', function ($pembelian) {
            return $pembelian->diskon . '%';
        })
        ->addColumn('aksi', function ($produk) {
            return '
            <div class="btn-group">
                <button type="button" onclick="editForm(\''. route('produk.update', $produk->id_produk) .'\')" class="btn btn-xs btn-info btn-flat mr-1"><i class="fas fa-edit"></i>Ubah</button>
                <button type="button" onclick="deleteData(\''. route('produk.destroy', $produk->id_produk) .'\')" class="btn btn-xs btn-danger btn-flat"><i class="fas fa-trash"></i>Hapus</button>
            </div>
            ';
        })
        ->rawColumns(['aksi', 'kode_produk', 'select_all'])
        ->make(true);
    }

    /**
     * Generate product code.
     */
    private function generateKodeProduk($kategoriNama)
    {
        $kategoriSingkatan = strtoupper(substr($kategoriNama, 0, 3));

        // Get the last product's code with the same category prefix
        $lastProduk = Produk::where('kode_produk', 'like', $kategoriSingkatan . '%')
            ->orderBy('kode_produk', 'desc')
            ->first();

        if ($lastProduk) {
            $lastNumber = (int)substr($lastProduk->kode_produk, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $kategoriSingkatan . $newNumber;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'jenis' => 'required|in:Kecil,Sedang,Besar',
            'nama_produk' => 'required|string|max:255',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
            'diskon' => 'nullable|numeric',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        // Get the category name
        $kategori = Kategori::find($request->id_kategori);
        $kategoriNama = $kategori->nama_kategori;

        // Generate the product code
        $kodeProduk = $this->generateKodeProduk($kategoriNama);

        // Create a new product with the generated product code
        $produk = new Produk($request->all());
        $produk->kode_produk = $kodeProduk;
        $produk->save();

        // Redirect with success message
        return redirect()->route('produk.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produk = Produk::find($id);

        return response()->json($produk);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'jenis' => 'required|in:Kecil,Sedang,Besar',
            'nama_produk' => 'required|string|max:255',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
            'diskon' => 'nullable|numeric',
        ]);
        $produk = Produk::find($id);
        $produk->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Data berhasil dihapus');
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_produk as $id) {
            $produk = Produk::find($id);
            $produk->delete();
        }
        return redirect()->route('produk.index')->with('success', 'Data berhasil dihapus');
    }
}
