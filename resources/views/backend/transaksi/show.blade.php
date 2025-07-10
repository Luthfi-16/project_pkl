@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"> 
                        @if($transaksi->jenis == "pemasukkan")
                            <h5>Detail Pemasukkan</h5>
                        @elseif($transaksi->jenis == "pengeluaran")
                            <h5>Detail Pengeluaran</h5>
                        @endif
                    </h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label><strong>Jenis : </strong></label>
                                <div>{{ $transaksi->jenis}}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label><strong> Keterangan : </strong></label>
                                    <div>{{ $transaksi->keterangan }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong> Jumlah : </strong></label>
                                <div>Rp. {{number_format($transaksi->jumlah,'0', '.', '.',)}}</div>
                            </div>
                            <div class="mb-3">
                                <label><strong>Tanggal : </strong></label>
                                <div>{{ $transaksi->tanggal->format('d M Y') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">


                    </div>

                    <div class="mt-4">
                        <a href="{{ route('backend.transaksi.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection