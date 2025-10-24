@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Stock Transfer</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('stock-transfers.update', $stockTransfer->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="item_id" class="form-label">Item <span class="text-danger">*</span></label>
                            <select class="form-select @error('item_id') is-invalid @enderror" 
                                    id="item_id" 
                                    name="item_id">
                                <option value="">-- Pilih Item --</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}" 
                                        {{ old('item_id', $stockTransfer->item_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_item }} ({{ $item->unit_satuan }})
                                    </option>
                                @endforeach
                            </select>
                            @error('item_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="asal_lokasi" class="form-label">Dari Lokasi <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('asal_lokasi') is-invalid @enderror" 
                                           id="asal_lokasi" 
                                           name="asal_lokasi" 
                                           value="{{ old('asal_lokasi', $stockTransfer->asal_lokasi) }}"
                                           placeholder="Contoh: Gudang A">
                                    @error('asal_lokasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tujuan_lokasi" class="form-label">Ke Lokasi <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('tujuan_lokasi') is-invalid @enderror" 
                                           id="tujuan_lokasi" 
                                           name="tujuan_lokasi" 
                                           value="{{ old('tujuan_lokasi', $stockTransfer->tujuan_lokasi) }}"
                                           placeholder="Contoh: Gudang B">
                                    @error('tujuan_lokasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('jumlah') is-invalid @enderror" 
                                   id="jumlah" 
                                   name="jumlah" 
                                   value="{{ old('jumlah', $stockTransfer->jumlah) }}"
                                   step="0.01"
                                   min="0"
                                   placeholder="Masukkan jumlah">
                            @error('jumlah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status">
                                <option value="In-Transit" {{ old('status', $stockTransfer->status) == 'In-Transit' ? 'selected' : '' }}>In-Transit</option>
                                <option value="Completed" {{ old('status', $stockTransfer->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                                <option value="Cancelled" {{ old('status', $stockTransfer->status) == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('stock-transfers.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection