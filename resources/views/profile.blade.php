@extends('layouts.frontend')
@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">
        <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
          <div class="row gy-5">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
              <h2>Kelola Dana <span class="kdm">M</span>andiri</h2>
              <p>Halaman Profil</p>
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
            <div class="card">
                <div class="card-header" style="background-color: #71c55d">
                    <h5 class="mb-0"> Profile Anda </h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong>Nama : {{ Auth::user()->name}}</strong></label>
                                <div></div>
                            </div>

                            <div class="mb-3">
                                <label><strong>Email : {{ Auth::user()->email }}</strong></label>
                                <div></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label><strong> Jumlah Uangmu : Rp. {{ number_format($jumlahUang, 0, '.', '.')}}</strong></label>
                                <div></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ url('/')}}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
              </div><!--End Icon Box -->
            </div>
          </div>
        </div>
  
      </section><!-- /Hero Section -->

@endsection