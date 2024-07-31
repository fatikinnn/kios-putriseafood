<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('member.index');

    }

    /**
     * Show the form for creating a new resource.
     */

     public function data()
     {
          $member = Member::orderBy('kode_member')->get();
 
         return datatables()
         ->of($member)
         ->addIndexColumn()
         ->addColumn('kode_member', function ($member) {
            return '<span class="badge badge-warning">' . $member->kode_member . '</span>';
        })
         ->addColumn('aksi', function($member){
             $editBtn = '<button onclick="editForm(`' . route('member.update', $member->id_member) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fas fa-edit"></i>Ubah</button>';
             $deleteBtn = '<button onclick="deleteData(`'. route('member.destroy', $member->id_member) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fas fa-trash"></i>Hapus</button>';
             return $editBtn . ' ' . $deleteBtn;
         })
         ->rawColumns(['aksi', 'kode_member'])
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
        $member = Member::latest()->first() ?? new Member;
        $kode_member = (int) $member->kode_member +1;

        $member = new Member();
        $member->kode_member = tambah_nol_didepan($kode_member, 5);
        $member->nama = $request->nama;
        $member->telepon = $request->telepon;
        $member->alamat = $request->alamat;
        $member->save();
    
        return view('member.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $member = Member::find($id);

        return response()->json($member);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $member = Member::find($id)->update($request->all());

    
        return view('member.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();

        return view('member.index');
    }
}
