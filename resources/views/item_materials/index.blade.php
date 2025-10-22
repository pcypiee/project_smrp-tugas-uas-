@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Data Item Material</h4>
                    <a href="{{ route('item-materials.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Item
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
                                    <th>Nama Item</th>
                                    <th>Unit Satuan</th>
                                    <th>ROP</th>
                                    <th>Created By</th>
                                    <th>Updated By</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($itemMaterials as $item)
                                    <tr>
                                        <td>{{ $itemMaterials->firstItem() + $loop->index }}</td>
                                        <td>{{ $item->nama_item }}</td>
                                        <td>{{ $item->unit_satuan }}</td>
                                        <td>{{ $item->rop }}</td>
                                        <td>{{ $item->created_by ?? '-' }}</td>
                                        <td>{{ $item->updated_by ?? '-' }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('item-materials.show', $item->id) }}" 
                                                   class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('item-materials.edit', $item->id) }}" 
                                                   class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('item-materials.destroy', $item->id) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $itemMaterials->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection