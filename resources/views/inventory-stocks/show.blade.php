@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-4">Detail Inventory Stock</h1>

            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="text-muted">Item</label>
                            <p class="fs-5"><strong>{{ $inventoryStock->item->nama ?? '-' }}</strong></p>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted">Lokasi</label>
                            <p class="fs-5"><strong>{{ $inventoryStock->lokasi->nama ?? '-' }}</strong></p>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted">Kuantitas</label>
                            <p class="fs-5"><strong>{{ $inventoryStock->kuantitas }}</strong></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="text-muted">Nilai Avg Cost</label>
                            <p class="fs-5"><strong>Rp {{ number_format($inventoryStock->nilai_avg_cost, 2, ',', '.') }}</strong></p>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted">Total Nilai</label>
                            <p class="fs-5"><strong>Rp {{ number_format($inventoryStock->kuantitas * $inventoryStock->nilai_avg_cost, 2, ',', '.') }}</strong></p>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted">Created By</label>
                            <p class="fs-5"><strong>{{ $inventoryStock->created_by ?? '-' }}</strong></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="text-muted">Created At</label>
                            <p class="fs-5"><strong>{{ $inventoryStock->created_at->format('d-m-Y H:i:s') }}</strong></p>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted">Updated By</label>
                            <p class="fs-5"><strong>{{ $inventoryStock->updated_by ?? '-' }}</strong></p>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted">Updated At</label>
                            <p class="fs-5"><strong>{{ $inventoryStock->updated_at->format('d-m-Y H:i:s') }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-3 d-flex gap-2">
                <a href="{{ route('inventory-stocks.edit', $inventoryStock->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('inventory-stocks.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection