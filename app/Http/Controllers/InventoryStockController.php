<?php

namespace App\Http\Controllers;

use App\Models\InventoryStock;
use App\Models\Item;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryStockController extends Controller
{
    // INDEX - Menampilkan semua inventory stocks
    public function index()
    {
        $stocks = InventoryStock::with(['item', 'lokasi'])->paginate(10);
        return view('inventory-stocks.index', compact('stocks'));
    }

    // CREATE - Menampilkan form create
    public function create()
    {
        // $items = Item::all();
        // $lokasis = Lokasi::all();
        return view('inventory-stocks.create', compact('items', 'lokasis'));
    }

    // STORE - Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'lokasi_id' => 'required|exists:lokasis,id',
            'kuantitas' => 'required|integer|min:0',
            'nilai_avg_cost' => 'required|numeric|min:0',
        ]);

        $validated['created_by'] = Auth::user()->name ?? 'System';

        InventoryStock::create($validated);

        return redirect()->route('inventory-stocks.index')
                       ->with('success', 'Data inventory stock berhasil ditambahkan');
    }

    // SHOW - Menampilkan detail satu data
    public function show(InventoryStock $inventoryStock)
    {
        $inventoryStock->load(['item', 'lokasi']);
        return view('inventory-stocks.show', compact('inventoryStock'));
    }

    // EDIT - Menampilkan form edit
    public function edit(InventoryStock $inventoryStock)
    {
        // $items = Item::all();
        // $lokasis = Lokasi::all();
        return view('inventory-stocks.edit', compact('inventoryStock', 'items', 'lokasis'));
    }

    // UPDATE - Simpan perubahan data
    public function update(Request $request, InventoryStock $inventoryStock)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'lokasi_id' => 'required|exists:lokasis,id',
            'kuantitas' => 'required|integer|min:0',
            'nilai_avg_cost' => 'required|numeric|min:0',
        ]);

        $validated['updated_by'] = Auth::user()->name ?? 'System';

        $inventoryStock->update($validated);

        return redirect()->route('inventory-stocks.index')
                       ->with('success', 'Data inventory stock berhasil diperbarui');
    }

    // DESTROY - Hapus data
    public function destroy(InventoryStock $inventoryStock)
    {
        $inventoryStock->delete();

        return redirect()->route('inventory-stocks.index')
                       ->with('success', 'Data inventory stock berhasil dihapus');
    }
}