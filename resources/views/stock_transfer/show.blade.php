@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Stock Transfer</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="200">ID</th>
                                <td>{{ $stockTransfer->id }}</td>
                            </tr>
                            <tr>
                                <th>Item</th>
                                <td>
                                    <strong>{{ $stockTransfer->item->nama_item ?? '-' }}</strong><br>
                                    <small class="text-muted">Unit: {{ $stockTransfer->item->unit_satuan ?? '-' }}</small>
                                </td>
                            </tr>
                            <tr>
                                <th>Dari Lokasi</th>
                                <td>{{ $stockTransfer->asal_lokasi }}</td>
                            </tr>
                            <tr>
                                <th>Ke Lokasi</th>
                                <td>{{ $stockTransfer->tujuan_lokasi }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah</th>
                                <td>{{ number_format($stockTransfer->jumlah, 2) }} {{ $stockTransfer->item->unit_satuan ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge bg-{{ $stockTransfer->status_badge }}">
                                        {{ $stockTransfer->status }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Created By</th>
                                <td>{{ $stockTransfer->created_by ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Updated By</th>
                                <td>{{ $stockTransfer->updated_by ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $stockTransfer->created_at->format('d-m-Y H:i:s') }}</td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td>{{ $stockTransfer->updated_at->format('d-m-Y H:i:s') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Quick Status Update -->
                    @if($stockTransfer->status != 'Completed' && $stockTransfer->status != 'Cancelled')
                    <div class="card mt-3">
                        <div class="card-body">
                            <h6 class="card-title">Update Status Cepat</h6>
                            <form action="{{ route('stock-transfers.update-status', $stockTransfer->id) }}" 
                                  method="POST" 
                                  class="d-flex gap-2">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select" style="width: auto;">
                                    <option value="In-Transit" {{ $stockTransfer->status == 'In-Transit' ? 'selected' : '' }}>In-Transit</option>
                                    <option value="Completed" {{ $stockTransfer->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="Cancelled" {{ $stockTransfer->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Update Status</button>
                            </form>
                        </div>
                    </div>
                    @endif

                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('stock-transfers.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <div>
                            <a href="{{ route('stock-transfers.edit', $stockTransfer->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('stock-transfers.destroy', $stockTransfer->id) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus transfer ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection