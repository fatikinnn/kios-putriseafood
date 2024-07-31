<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Inventory::with(['pembelian', 'penjualan', 'produk'])->orderBy('created_at', 'asc')->get();
        return view('inventory.index', compact('inventory'));
    }

    public function getData(Request $request)
    {
        $query = Inventory::with(['pembelian', 'penjualan', 'produk'])->orderBy('created_at', 'asc');

        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $inventory = $query->get();

        return response()->json($inventory);
    }
}
