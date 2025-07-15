@extends('layouts.backend')
@section('styles')
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection
@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-body">
      <a href="{{ route('backend.siswa.create')}}" class="btn btn-info btn-sm" style="color: white;float: right;">
        Tambah
      </a>
      <div class="d-flex mb-1 align-items-center">
        <div>
          <h4 class="card-title mb-0">Data Akun</h4>
        </div>
      </div>
      <p class="card-subtitle mb-3">
      </p>
      <div class="table-responsive border rounded-4">
        <table class="table mb-0" id="dataSiswa">
          <thead class="table-dark">
            <!-- start row -->
            <tr>
              <th class="text-white">#</th>
              <th class="text-white">Nama</th>
              <th class="text-white">Jabatan</th>
              <th class="text-white">Email</th>
              <th class="text-white">Status Bayar</th>
              <th class="text-white">Aksi</th>
            </tr>
            <!-- end row -->
          </thead>
          <tbody>
            @php
                $no = 1;
            @endphp
            @foreach($users as $data)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $data->name }}</td>
              @if ($data->isAdmin == 1)
                  <td>Bendahara</td>
              @else
                  <td>Siswa</td>
              @endif
              <td>{{ $data->email}}</td>
              <td>{{ $data->status_semester ?? '-' }}</td>

              <td>
                <a href="{{ route('backend.siswa.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                @if($data->isAdmin == 1)
                @elseif($data->isAdmin != 1)
                <a href="{{ route('backend.siswa.destroy', $data->id) }}" class="btn btn-sm btn-danger" data-confirm-delete="true">Hapus</a>
                @endif
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
    new DataTable('#dataSiswa', {
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
      }
    });
  </script>
@endpush