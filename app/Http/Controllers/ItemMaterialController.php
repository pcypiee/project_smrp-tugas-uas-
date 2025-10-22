<?php

namespace App\Http\Controllers;

use App\Models\ItemMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itemMaterials = ItemMaterial::latest()->paginate(10);
        return view('item_materials.index', compact('itemMaterials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('item_materials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_item' => 'required|string|max:255',
            'unit_satuan' => 'required|string|max:255',
            'rop' => 'required|string|max:255',
        ], [
            'nama_item.required' => 'Nama item wajib diisi',
            'unit_satuan.required' => 'Unit satuan wajib diisi',
            'rop.required' => 'ROP wajib diisi',
        ]);

        $validated['created_by'] = Auth::user()->name ?? 'System';

        ItemMaterial::create($validated);

        return redirect()->route('item-materials.index')
            ->with('success', 'Item material berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemMaterial $itemMaterial)
    {
        return view('item_materials.show', compact('itemMaterial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemMaterial $itemMaterial)
    {
        return view('item_materials.edit', compact('itemMaterial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemMaterial $itemMaterial)
    {
        $validated = $request->validate([
            'nama_item' => 'required|string|max:255',
            'unit_satuan' => 'required|string|max:255',
            'rop' => 'required|string|max:255',
        ], [
            'nama_item.required' => 'Nama item wajib diisi',
            'unit_satuan.required' => 'Unit satuan wajib diisi',
            'rop.required' => 'ROP wajib diisi',
        ]);

        $validated['updated_by'] = Auth::user()->name ?? 'System';

        $itemMaterial->update($validated);

        return redirect()->route('item-materials.index')
            ->with('success', 'Item material berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemMaterial $itemMaterial)
    {
        $itemMaterial->delete();

        return redirect()->route('item-materials.index')
            ->with('success', 'Item material berhasil dihapus');
    }
}