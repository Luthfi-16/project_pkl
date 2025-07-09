@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
          <h4 class="card-title">Tambah transaksi kas</h4>
          <p class="card-subtitle mb-3">
            Untuk menambah data transaksi kas
          </p>
          <form action="{{route('backend.transaksi.update', $transaksi->id)}}" method="post">
            @csrf
            @method('put')
            <div class="row">
                <div class="col">
                    <div class="form-group mb-4">
                        <label for="exampleFormControlSelect1">Pilih Nama Siswa</label>
                        <select class="form-select @error('user_id') is-invalid @enderror" name="user_id" id="exampleFormControlSelect1">
                          <option>Pilih</option>
                          @foreach($users as $data)
                          <option value="{{$data->id}}"{{ $data->id == $transaksi->user_id ? 'selected' : ''}}>{{$data->name}}</option>
                          @endforeach
                        </select>
                        @error('user_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group mb-4">
                        <label for="">Pilih Jenis Transaksi</label>
                        <select name="jenis" class="form-select @error('jenis') is-invalid @enderror" id="">
                            <option value="">Pilih</option>
                            <option value="pemasukkan"{{ $transaksi->jenis == 'pemasukkan' ? 'selected' : ''}}>Pemasukkan</option>
                            <option value="pengeluaran"{{ $transaksi->jenis == 'pengeluaran' ? 'selected' : ''}}>Pengeluaran</option>
                        </select>
                        @error('jenis')
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
                        <input type="number" name="jumlah" value="{{$transaksi->jumlah}}" class="form-control @error('jumlah') is-invalid @enderror" placeholder="Masukkan jumlah uang">
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
                        <input type="date" name="tanggal" value="{{$transaksi->tanggal}}" class="form-control @error('tanggal') is-invalid @enderror" >
                        @error('tanggal')
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
                        <label for="">Keterangan</label>
                        <textarea name="keterangan" id="" cols="5" rows="10" class="form-control @error('keterangan') is-invalid @enderror">{{ $transaksi->keterangan }}</textarea>
                        @error('keterangan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
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