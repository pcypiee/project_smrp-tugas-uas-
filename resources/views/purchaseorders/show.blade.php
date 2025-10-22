@extends('layouts.app')

@section('title', 'Detail Purchase Order')

@section('content')
<h1>Detail Purchase Order</h1>

<div class="card">
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th style="width: 200px;">ID</th>
                <td>{{ $purchaseorder->id }}</td>
            </tr>
            <tr>
                <th>Supplier</th>
                <td>{{ $purchaseorder->supplier->name }}</td>
            </tr>
            <tr>
                <th>Project</th>
                <td>{{ $purchaseorder->project->name }}</td>
            </tr>
            <tr>
                <th>Tanggal Kirim Dijanjikan</th>
                <td>{{ $purchaseorder->tanggal_kirim_dijanjikan->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th>Status PO</th>
                <td>{{ $purchaseorder->status_po }}</td>
            </tr>
            <tr>
                <th>Dibuat pada</th>
                <td>{{ $purchaseorder->created_at->format('d-m-Y H:i') }}</td>
            </tr>
        </table>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('purchaseorders.edit', $purchaseorder->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('purchaseorders.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
</div>
@endsection