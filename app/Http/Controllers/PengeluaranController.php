<?php

namespace App\Http\Controllers;
use App\Models\Pengeluaran;

use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        return view('pengeluaran.index');

    }

    public function data()
    {
        $pengeluaran = Pengeluaran::orderBy('created_at', 'asc')->get();

        return datatables()
        ->of($pengeluaran)
        ->addIndexColumn()
        ->addColumn('created_at', function ($pengeluaran) {
            return tanggal_indonesia($pengeluaran->created_at);
        })
        ->addColumn('nominal', function ($pengeluaran) {
            return format_uang($pengeluaran->nominal);
        })
        ->addColumn('aksi', function($pengeluaran){
            $editBtn = '<button onclick="editForm(`' . route('pengeluaran.update', $pengeluaran->id_pengeluaran) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fas fa-edit"></i>Ubah</button>';
            $deleteBtn = '<button onclick="deleteData(`'. route('pengeluaran.destroy', $pengeluaran->id_pengeluaran) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fas fa-trash"></i>Hapus</button>';
            return $editBtn . ' ' . $deleteBtn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pengeluaran = Pengeluaran::create($request->all());
    
        return view('pengeluaran.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengeluaran = Pengeluaran::find($id);

        return response()->json($pengeluaran);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pengeluaran = Pengeluaran::find($id)->update($request->all());

    
        return view('pengeluaran.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::find($id)->delete();

        return view('pengeluaran.index');
    }
    
}
