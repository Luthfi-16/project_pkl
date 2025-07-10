@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
          <div class="d-flex mb-1 align-items-center">
            <div>
              <h4 class="card-title mb-0">Data Kas</h4>
            </div>
          </div>
          <p class="card-subtitle mb-3">
          </p>
          <div class="table-responsive border rounded-4">
            <table class="table mb-0">
              <thead class="table-dark">
                <!-- start row -->
                <tr>
                  <th class="text-white">#</th>
                  <th class="text-white">Nama</th>
                  <th class="text-white">Status</th>
                  <th class="text-white">Minggu Ke</th>
                  <th class="text-white">Bulan</th>
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
                    <a href="{{ route('backend.kas.show', $data->id) }}" class="btn btn-info btn-sm">Show</a>
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