@extends('layouts.backend')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
          <h4 class="card-title">Tambah transaksi kas</h4>
          <p class="card-subtitle mb-3">
            Untuk menambah data transaksi kas
          </p>
          <form action="" method="post">
            <div class="row">
                <div class="col">
                    <div class="form-group mb-4">
                        <label for="exampleFormControlSelect1">Pilih Nama Siswa</label>
                        <select class="form-select" name="user_id" id="exampleFormControlSelect1">
                          <option>Pilih</option>
                          @foreach($users as $data)
                          <option value="{{$data->name}}">{{$data->name}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group mb-4">
                        <label for="">Pilih Jenis Transaksi</label>
                        <select name="jenis" class="form-select" id="">
                            <option value="">Pilih</option>
                            <option value="pemasukka">Pemasukkan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                </div>
            </div>
          </form>
        </div>
    </div>
</div>
@endsection