@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Inventory Stocks</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('inventory-stocks.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Stock
            </a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Item</th>
                    <th>Lokasi</th>
                    <th>Kuantitas</th>
                    <th>Nilai Avg Cost</th>
                    <th>Total Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stocks as $stock)
                    <tr>
                        <td>{{ ($stocks->currentPage() - 1) * $stocks->perPage() + $loop->iteration }}</td>
                        <td>{{ $stock->item->nama ?? '-' }}</td>
                        <td>{{ $stock->lokasi->nama ?? '-' }}</td>
                        <td>{{ $stock->kuantitas }}</td>
                        <td>Rp {{ number_format($stock->nilai_avg_cost, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($stock->kuantitas * $stock->nilai_avg_cost, 2, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('inventory-stocks.show', $stock->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('inventory-stocks.edit', $stock->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('inventory-stocks.destroy', $stock->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Tidak ada data inventory stock
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-3">
        {{ $stocks->links() }}
    </div>
</div>
@endsection