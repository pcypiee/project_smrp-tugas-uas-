@extends('layouts.app')

@section('title', 'Edit Purchase Order')

@section('content')
<h1>Edit Purchase Order</h1>

<form action="{{ route('purchaseorders.update', $purchaseorder->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="supplier_id" class="form-label">Supplier</label>
        <select name="supplier_id" id="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror">
            <option value="">-- Pilih Supplier --</option>
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ old('supplier_id', $purchaseorder->supplier_id) == $supplier->id ? 'selected' : '' }}>
                    {{ $supplier->name }}
                </option>
            @endforeach
        </select>
        @error('supplier_id')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="project_id" class="form-label">Project</label>
        <select name="project_id" id="project_id" class="form-select @error('project_id') is-invalid @enderror">
            <option value="">-- Pilih Project --</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}" {{ old('project_id', $purchaseorder->project_id) == $project->id ? 'selected' : '' }}>
                    {{ $project->name }}
                </option>
            @endforeach
        </select>
        @error('project_id')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="tanggal_kirim_dijanjikan" class="form-label">Tanggal Kirim Dijanjikan</label>
        <input type="date" name="tanggal_kirim_dijanjikan" id="tanggal_kirim_dijanjikan" class="form-control @error('tanggal_kirim_dijanjikan') is-invalid @enderror" value="{{ old('tanggal_kirim_dijanjikan', $purchaseorder->tanggal_kirim_dijanjikan->format('Y-m-d')) }}">
        @error('tanggal_kirim_dijanjikan')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="status_po" class="form-label">Status PO</label>
        <input type="text" name="status_po" id="status_po" class="form-control @error('status_po') is-invalid @enderror" value="{{ old('status_po', $purchaseorder->status_po) }}" placeholder="Contoh: Draft, Sent">
        @error('status_po')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-success">Perbarui PO</button>
        <a href="{{ route('purchaseorders.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection