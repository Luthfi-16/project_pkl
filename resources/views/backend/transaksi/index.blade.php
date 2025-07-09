@extends('layouts.backend')
@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-body">
      <a href="{{ route('backend.transaksi.create')}}" class="btn btn-info btn-sm" style="color: white;float: right;">
        Tambah
      </a>
      <div class="d-flex mb-1 align-items-center">
        <div>
          <h4 class="card-title mb-0">Data Transaksi</h4>
        </div>
      </div>
      <p class="card-subtitle mb-3">
        Untuk nambah transaksi kas
      </p>
      <div class="table-responsive border rounded-4">
        <table class="table mb-0">
          <thead class="table-dark">
            <!-- start row -->
            <tr>
              <th class="text-white">#</th>
              <th class="text-white">Nama</th>
              <th class="text-white">Jenis</th>
              <th class="text-white">Jumlah</th>
              <th class="text-white">Keterangan</th>
              <th class="text-white">Tanggal</th>
            </tr>
            <!-- end row -->
          </thead>
          <tbody>
            @php
                $no = 1;
            @endphp
            @foreach($transaksi as $data)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $data->users->name }}</td>
              <td>{{ $data->jenis}}</td>
              <td>{{ $data->jumlah}}</td>
              <td>{{ $data->keterangan }}</td>
              <td>
                <a href="{{ route('backend.transaksi.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ route('backend.transaksi.destroy', $data->id) }}" class="btn btn-sm btn-danger" data-confirm-delete="true">Hapus</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection