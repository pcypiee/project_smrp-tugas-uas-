@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Item Material</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('item-materials.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_item" class="form-label">Nama Item <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('nama_item') is-invalid @enderror" 
                                   id="nama_item" 
                                   name="nama_item" 
                                   value="{{ old('nama_item') }}"
                                   placeholder="Masukkan nama item">
                            @error('nama_item')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="unit_satuan" class="form-label">Unit Satuan <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('unit_satuan') is-invalid @enderror" 
                                   id="unit_satuan" 
                                   name="unit_satuan" 
                                   value="{{ old('unit_satuan') }}"
                                   placeholder="Contoh: Pcs, Kg, Liter">
                            @error('unit_satuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="rop" class="form-label">ROP (Reorder Point) <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('rop') is-invalid @enderror" 
                                   id="rop" 
                                   name="rop" 
                                   value="{{ old('rop') }}"
                                   placeholder="Masukkan nilai ROP">
                            @error('rop')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('item-materials.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection