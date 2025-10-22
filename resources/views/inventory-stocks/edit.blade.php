@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-4">Edit Inventory Stock</h1>

            <card>
                <form action="{{ route('inventory-stocks.update', $inventoryStock->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="item_id" class="form-label">Item <span class="text-danger">*</span></label>
                        <select class="form-control @error('item_id') is-invalid @enderror" id="item_id" name="item_id" required>
                            <option value="">-- Pilih Item --</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}" {{ $inventoryStock->item_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('item_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="lokasi_id" class="form-label">Lokasi <span class="text-danger">*</span></label>
                        <select class="form-control @error('lokasi_id') is-invalid @enderror" id="lokasi_id" name="lokasi_id" required>
                            <option value="">-- Pilih Lokasi --</option>
                            @foreach($lokasis as $lokasi)
                                <option value="{{ $lokasi->id }}" {{ $inventoryStock->lokasi_id == $lokasi->id ? 'selected' : '' }}>
                                    {{ $lokasi->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('lokasi_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="kuantitas" class="form-label">Kuantitas <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('kuantitas') is-invalid @enderror" 
                               id="kuantitas" name="kuantitas" value="{{ $inventoryStock->kuantitas }}" required min="0">
                        @error('kuantitas')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="nilai_avg_cost" class="form-label">Nilai Avg Cost <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control @error('nilai_avg_cost') is-invalid @enderror" 
                               id="nilai_avg_cost" name="nilai_avg_cost" value="{{ $inventoryStock->nilai_avg_cost }}" required min="0">
                        @error('nilai_avg_cost')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('inventory-stocks.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </card>
        </div>
    </div>
</div>
@endsection