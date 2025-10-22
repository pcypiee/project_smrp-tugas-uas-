@extends('layouts.app')

@section('title', 'Daftar Purchase Order')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Daftar Purchase Order</h1>
    <a href="{{ route('purchaseorders.create') }}" class="btn btn-primary">Buat PO Baru</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Supplier</th>
                <th>Project</th>
                <th>Tgl Kirim Dijanjikan</th>
                <th>Status PO</th>
                <th class="text-center" style="width: 200px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($purchaseorders as $po)
                <tr>
                    <td>{{ $po->id }}</td>
                    <td>{{ $po->supplier->name ?? 'Supplier Dihapus' }}</td>
                    <td>{{ $po->project->name ?? 'Project Dihapus' }}</td>
                    <td>{{ $po->tanggal_kirim_dijanjikan->format('d-m-Y') }}</td>
                    <td>{{ $po->status_po }}</td>
                    <td class="text-center">
                        <form action="{{ route('purchaseorders.destroy', $po->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('purchaseorders.show', $po->id) }}" class="btn btn-sm btn-info">Lihat</a>
                            <a href="{{ route('purchaseorders.edit', $po->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
{{ $purchaseorders->links() }}
@endsection