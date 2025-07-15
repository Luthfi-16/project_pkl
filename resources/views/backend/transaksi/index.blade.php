@extends('layouts.backend')
@section('styles')
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection
@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-body">
      <a href="{{ route('backend.transaksi.create')}}" class="btn btn-info btn-sm" style="color: white;float: right;">
        Tambah
      </a>
      <div class="d-flex mb-1 align-items-center">
        <div>
          <h4 class="card-title mb-0">Kelola Uang Kas</h4>
        </div>
      </div>
      <p class="card-subtitle mb-3">
      </p>
      <div class="table-responsive border rounded-4">
        <table class="table mb-0" id="dataTransaksi">
          <thead class="table-dark">
            <!-- start row -->
            <tr>
              <th class="text-white">#</th>
              <th class="text-white">Jenis</th>
              <th class="text-white">Jumlah</th>
              <th class="text-white">Keterangan</th>
              <th class="text-white">Tanggal</th>
              <th class="text-white">Aksi</th>
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
              <td>
                  @if($data->jenis == 'pengeluaran')
                      <span class="badge bg-danger text-dark">Pengeluaran</span>
                  @elseif($data->jenis == 'pemasukkan')
                      <span class="badge bg-success text-dark">Pemasukkan</span>
                  @endif
              </td>
              <td>
                  @if($data->jenis == 'pengeluaran')
                      - Rp.{{ number_format($data->jumlah, '0','.','.') }}
                  @elseif($data->jenis == 'pemasukkan')
                      + Rp.{{ number_format($data->jumlah, '0','.','.') }}
                  @endif
              </td>
              <td>{{ Str::limit($data->keterangan, 50) }}</td>
              <td>{{ $data->tanggal->format('d M Y') }}</td>
              <td>
                <a href="{{ route('backend.transaksi.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ route('backend.transaksi.show', $data->id) }}" class="btn btn-info btn-sm">Detail</a>
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
@push('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
    <script>
    new DataTable('#dataTransaksi', {
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
      }
    });
  </script>
@endpush