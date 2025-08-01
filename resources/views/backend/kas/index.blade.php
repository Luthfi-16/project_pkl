@extends('layouts.backend')
@section('styles')
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
          <div class="d-flex mb-1 align-items-center">
            <div>
              <h4 class="card-title mb-0">Catatan kas</h4>
            </div>
          </div>
          <p class="card-subtitle mb-3">
          </p>
          <div class="table-responsive border rounded-4">
            <table class="table mb-0" id="dataKas">
              <thead class="table-dark">
                <!-- start row -->
                <tr>
                  <th class="text-white">#</th>
                  <th class="text-white">Nama</th>
                  <th class="text-white">Status</th>
                  <th class="text-white">Minggu Ke</th>
                  <th class="text-white">Bulan</th>
                  <th class="text-white">Jumlah</th>
                  <th class="text-white">Tanggal Lunas</th>
                  <th class="text-white">Aksi</th>
                </tr>
                <!-- end row -->
              </thead>
              <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach($kas as $data)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $data->users->name }}</td>
                  <td>
                  @if($data->status == 'belum')
                      <span class="badge bg-danger text-dark">Belum</span>
                  @elseif($data->status == 'lunas')
                      <span class="badge bg-success text-dark">Lunas</span>
                  @endif
                  </td>
                  <td>{{ $data->minggu_ke }}</td>
                  <td>{{\Carbon\Carbon::create()->month($data->bulan)->translatedFormat('F')}}</td>
                  <td>Rp. {{ number_format($data->jumlah, '0','.','.') }}</td>
                  <td>{{ $data->tanggal_bayar->format('d M Y') }}</td>
                  <td>
                    <a href="{{ route('backend.kas.show', $data->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('backend.kas.destroy', $data->id) }}" class="btn btn-sm btn-danger" data-confirm-delete="true">Hapus</a>
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
    new DataTable('#dataKas', {
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
      }
    });
  </script>
@endpush