@extends('layouts.backend')
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
          <a href="{{ route('backend.pembayaran.create')}}" class="btn btn-info btn-sm" style="color: white;float: right;">
            Tambah
          </a>
          <div class="d-flex mb-1 align-items-center">
            <div>
              <h4 class="card-title mb-0">Data pembayaran</h4>
            </div>
          </div>
          <p class="card-subtitle mb-3">
          </p>
          <div class="table-responsive border rounded-4">
            <table id="dataBayar" class="table mb-0">
              <thead class="table-dark">
                <!-- start row -->
                <tr>
                  <th class="text-white">#</th>
                  <th class="text-white">Nama</th>
                  <th class="text-white">Jumlah</th>
                  <th class="text-white">Tanggal</th>
                  <th class="text-white">Aksi</th>
                </tr>
                <!-- end row -->
              </thead>
              <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach($pembayaran as $data)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $data->users->name}}</td>
                  <td>Rp. {{ number_format($data->jumlah, '0','.','.') }}</td>
                  <td>{{ $data->tanggal->format('d M Y') }}</td>
                  <td>
                    <a href="{{ route('backend.pembayaran.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ route('backend.pembayaran.destroy', $data->id) }}" class="btn btn-sm btn-danger" data-confirm-delete="true">Hapus</a>
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
@push('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
    <script>
    new DataTable('#dataBayar', {
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
      }
    });
  </script>
@endpush