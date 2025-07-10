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
              <img src="{{ ('assets/frontend/img/hero-img.png')}}" class="img-fluid" alt="">
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
  
        <div class="container">
  
          <div class="row gy-4">
  
            <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
              <p class="who-we-are">Who We Are</p>
              <h3>Unleashing Potential with Creative Strategy</h3>
              <p class="fst-italic">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                magna aliqua.
              </p>
              <ul>
                <li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
                <li><i class="bi bi-check-circle"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
                <li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
              </ul>
              <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
            </div>
  
            <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">
                <div class="col-lg-6">
                  <img src="{{ ('assets/frontend/img/about-company-1.jpg')}}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6">
                  <div class="row gy-4">
                    <div class="col-lg-12">
                      <img src="{{ ('assets/frontend/img/about-company-2.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-12">
                      <img src="{{ ('assets/frontend/img/about-company-3.jpg')}}" class="img-fluid" alt="">
                    </div>
                  </div>
                </div>
              </div>
  
            </div>
  
          </div>
  
        </div>
      </section><!-- /About Section -->

@endsection