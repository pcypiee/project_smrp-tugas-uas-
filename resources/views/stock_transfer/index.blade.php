@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Data Stock Transfer</h4>
                    <a href="{{ route('stock-transfers.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Transfer
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Item</th>
                                    <th>Dari Lokasi</th>
                                    <th>Ke Lokasi</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stockTransfers as $transfer)
                                    <tr>
                                        <td>{{ $stockTransfers->firstItem() + $loop->index }}</td>
                                        <td>
                                            <strong>{{ $transfer->item->nama_item ?? '-' }}</strong><br>
                                            <small class="text-muted">{{ $transfer->item->unit_satuan ?? '' }}</small>
                                        </td>
                                        <td>{{ $transfer->asal_lokasi }}</td>
                                        <td>{{ $transfer->tujuan_lokasi }}</td>
                                        <td>{{ number_format($transfer->jumlah, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $transfer->status_badge }}">
                                                {{ $transfer->status }}
                                            </span>
                                        </td>
                                        <td>{{ $transfer->created_by ?? '-' }}</td>
                                        <td>{{ $transfer->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('stock-transfers.show', $transfer->id) }}" 
                                                   class="btn btn-info btn-sm" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('stock-transfers.edit', $transfer->id) }}" 
                                                   class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('stock-transfers.destroy', $transfer->id) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus transfer ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $stockTransfers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection