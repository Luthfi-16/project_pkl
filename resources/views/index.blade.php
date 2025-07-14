@extends('layouts.frontend')
@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">
        <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
          <div class="row gy-5">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
              <h2>Kelola Dana <span class="kdm">M</span>andiri</h2>
              <p>Untuk melihat total uang kas dan pengeluaran</p>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
              <img src="{{ asset ('assets/frontend/img/hero-img.png')}}" class="img-fluid" alt="">
            </div>
          </div>
        </div>
  
        <div class="icon-boxes position-relative" data-aos="fade-up" data-aos-delay="200">
          <div class="container position-relative">
            <div class="row gy-4 mt-5">
              <div class="col-xl-6 col-md-3 mx-auto">
                <div class="icon-box">
                  <div class="icon"><i class="bi bi-cash-stack"></i></div>
                  <h4 class="title">Saldo Kas</h4>
                  <h5>Rp. {{ number_format($saldoKas, '0', '.', '.') }}</h5>
                </div>
              </div><!--End Icon Box -->
            </div>
          </div>
        </div>
  
      </section><!-- /Hero Section -->
  
      <!-- About Section -->
      <section id="about" class="about section">
  
      <div class="container-fluid" style="width: 70%">
            <div class="d-flex mb-1 align-items-center">
              <div>
                <h4 class="card-title mb-0">Data Pengeluaran</h4>
              </div>
            </div>
            <p class="card-subtitle mb-3">
            </p>
            <div class="table-responsive border rounded-2">
              <table class="table mb-0 table-sm text-nowrap" id="dataTransaksi">
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
                    <td>{{ $data->jenis}}</td>
                    <td>Rp. {{ number_format($data->jumlah, '0','.','.') }}</td>
                    <td>{{ $data->keterangan }}</td>
                    <td>{{ $data->tanggal->format('d M Y') }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
      </div>
      </section><!-- /About Section -->
@endsection