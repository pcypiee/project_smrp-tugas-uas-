<?php

namespace App\Http\Controllers;

use App\Models\StockTransfer;
use App\Models\ItemMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stockTransfers = StockTransfer::with('item')
            ->latest()
            ->paginate(10);
        
        return view('stock_transfers.index', compact('stockTransfers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = ItemMaterial::all();
        
        return view('stock_transfers.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:item_materials,id',
            'asal_lokasi' => 'required|string|max:255',
            'tujuan_lokasi' => 'required|string|max:255|different:asal_lokasi',
            'jumlah' => 'required|numeric|min:1',
            'status' => 'nullable|in:In-Transit,Completed,Cancelled',
        ], [
            'item_id.required' => 'Item wajib dipilih',
            'item_id.exists' => 'Item tidak ditemukan',
            'asal_lokasi.required' => 'Lokasi asal wajib diisi',
            'tujuan_lokasi.required' => 'Lokasi tujuan wajib diisi',
            'tujuan_lokasi.different' => 'Lokasi tujuan harus berbeda dengan lokasi asal',
            'jumlah.required' => 'Jumlah wajib diisi',
            'jumlah.numeric' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 1',
            'status.in' => 'Status tidak valid',
        ]);

        $validated['status'] = $validated['status'] ?? 'In-Transit';
        $validated['created_by'] = Auth::user()->name ?? 'System';

        StockTransfer::create($validated);

        return redirect()->route('stock-transfers.index')
            ->with('success', 'Stock transfer berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(StockTransfer $stockTransfer)
    {
        $stockTransfer->load('item');
        return view('stock_transfers.show', compact('stockTransfer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockTransfer $stockTransfer)
    {
        $items = ItemMaterial::all();
        
        return view('stock_transfers.edit', compact('stockTransfer', 'items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockTransfer $stockTransfer)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:item_materials,id',
            'asal_lokasi' => 'required|string|max:255',
            'tujuan_lokasi' => 'required|string|max:255|different:asal_lokasi',
            'jumlah' => 'required|numeric|min:1',
            'status' => 'required|in:In-Transit,Completed,Cancelled',
        ], [
            'item_id.required' => 'Item wajib dipilih',
            'item_id.exists' => 'Item tidak ditemukan',
            'asal_lokasi.required' => 'Lokasi asal wajib diisi',
            'tujuan_lokasi.required' => 'Lokasi tujuan wajib diisi',
            'tujuan_lokasi.different' => 'Lokasi tujuan harus berbeda dengan lokasi asal',
            'jumlah.required' => 'Jumlah wajib diisi',
            'jumlah.numeric' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 1',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid',
        ]);

        $validated['updated_by'] = Auth::user()->name ?? 'System';

        $stockTransfer->update($validated);

        return redirect()->route('stock-transfers.index')
            ->with('success', 'Stock transfer berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockTransfer $stockTransfer)
    {
        $stockTransfer->delete();

        return redirect()->route('stock-transfers.index')
            ->with('success', 'Stock transfer berhasil dihapus');
    }

    /**
     * Update status transfer
     */
    public function updateStatus(Request $request, StockTransfer $stockTransfer)
    {
        $validated = $request->validate([
            'status' => 'required|in:In-Transit,Completed,Cancelled',
        ]);

        $validated['updated_by'] = Auth::user()->name ?? 'System';
        $stockTransfer->update($validated);

        return redirect()->back()
            ->with('success', 'Status berhasil diupdate');
    }
}