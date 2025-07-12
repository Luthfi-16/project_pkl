@extends('layouts.backend')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />   
@endsection
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
          <h4 class="card-title">Tambah pembayaran kas</h4>
          <p class="card-subtitle mb-3">
            Untuk menambah data pembayaran kas
          </p>
          <form action="{{route('backend.pembayaran.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group mb-4">
                        <label for="">Pilih Nama Siswa</label>
                        <select id="nama" name="user_id" class="form-select @error('jenis') is-invalid @enderror" >
                            <option value="">Pilih</option>
                            @foreach($users as $data)
                            <option value="{{ $data->id }}">{{$data->name}}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group mb-4">
                        <label for="">Jumlah Uang</label>
                        <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" placeholder="Masukkan jumlah uang">
                        @error('jumlah')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group mb-4">
                        <label for="">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" >
                        @error('tanggal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
            </div>
            <div class="d-md-flex align-items-center">
                <div class="mt-3 mt-md-0 ms-auto">
                  <button type="submit" class="btn btn-primary  hstack gap-6">
                    <i class="ti ti-send fs-4"></i>
                    Simpan
                  </button>
                </div>
          </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">	
	$(document).ready(function() {
		$('#nama').select2();
	});
</script>
@endpush