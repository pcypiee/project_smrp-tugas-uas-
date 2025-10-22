@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Item Material</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="200">ID</th>
                                <td>{{ $itemMaterial->id }}</td>
                            </tr>
                            <tr>
                                <th>Nama Item</th>
                                <td>{{ $itemMaterial->nama_item }}</td>
                            </tr>
                            <tr>
                                <th>Unit Satuan</th>
                                <td>{{ $itemMaterial->unit_satuan }}</td>
                            </tr>
                            <tr>
                                <th>ROP</th>
                                <td>{{ $itemMaterial->rop }}</td>
                            </tr>
                            <tr>
                                <th>Created By</th>
                                <td>{{ $itemMaterial->created_by ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Updated By</th>
                                <td>{{ $itemMaterial->updated_by ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $itemMaterial->created_at->format('d-m-Y H:i:s') }}</td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td>{{ $itemMaterial->updated_at->format('d-m-Y H:i:s') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('item-materials.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <div>
                            <a href="{{ route('item-materials.edit', $itemMaterial->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('item-materials.destroy', $itemMaterial->id) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
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