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
              <h4 class="card-title mb-0">Laporan</h4>
              <form method="GET" action="{{ route('backend.export.index') }}" class="row g-2 mb-4">
                <div class="col-md-3">
                    <label for="jenis" class="form-label">Jenis Laporan</label>
                    <select name="jenis" id="jenis" class="form-select">
                        <option value="">-- Pilih Jenis --</option>
                        <option value="pengeluaran" {{ request('jenis') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                        <option value="pemasukkan" {{ request('jenis') == 'pemasukkan' ? 'selected' : '' }}>Pemasukkan</option>
                        <option value="kas" {{ request('jenis') == 'kas' ? 'selected' : '' }}>Kas</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="awal" class="form-label">Tanggal Awal</label>
                    <input type="date" name="awal" id="awal" class="form-control" value="{{ request('awal') }}">
                </div>

                <div class="col-md-3">
                    <label for="akhir" class="form-label">Tanggal Akhir</label>
                    <input type="date" name="akhir" id="akhir" class="form-control" value="{{ request('akhir') }}">
                </div>

                <div class="col-md-6 d-flex align-items-end gap-6">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="{{ route('backend.export.index') }}" class="btn btn-secondary">Reset</a>
                    @if(request('jenis'))
                        <a href="{{ route('backend.export.index', array_merge(request()->all(), ['export' => 'excel'])) }}"
                          class="btn btn-success">
                            Export Excel
                        </a>
                    @endif
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    @if($jenis == 'pengeluaran' || $jenis == 'pemasukkan')
      <div class="card">
        <div class="card-body">
          <div class="d-flex mb-1 align-items-center">
            <div>
              <h4 class="card-title mb-0">Laporan Transaksi</h4>
            </div>
          </div>
          <p class="card-subtitle mb-3">
          </p>
          <div class="table-responsive border rounded-4">
            <table class="table mb-0" id="">
              <thead class="table-dark">
                <!-- start row -->
                <tr>
                  <th class="text-white">#</th>
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
                  <td>{{ $data->jenis }}</td>
                  <td>{{ number_format($data->jumlah, '0', '.', '.') }}</td>
                  <td>{{ $data->keterangan }}</td>
                  <td>{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d M Y') }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      @elseif($jenis == 'kas')
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
            <table class="table mb-0" id="">
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

    @endif
</div>
@endsection
@push('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#dataKas');
    </script>
    <script>
        new DataTable('#dataTransaksi');
    </script>
@endpush