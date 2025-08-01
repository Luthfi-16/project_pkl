@extends('layouts.backend')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">Tambah akun</h4>
              <p class="card-subtitle mb-3">
                Untuk menambah data akun
              </p>
              <form action="{{ route('backend.siswa.store')}}" method="POST">
                @csrf
                <div class="form-floating mb-3">
                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Username" />
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <label>
                    <i class="ti ti-user me-2 fs-4"></i>Nama
                  </label>
                </div>
                <div class="form-floating mb-3">
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" />
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <label>
                    <i class="ti ti-mail me-2 fs-4"></i>Email
                  </label>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" />
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                  <label>
                    <i class="ti ti-lock me-2 fs-4"></i>Password
                  </label>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" name="password_confirmation" class="form-control" placeholder="CPassword" />
                  <label>
                    <i class="ti ti-lock me-2 fs-4"></i>Konfirmasi
                    Password
                  </label>
                </div>

                <div class="d-md-flex align-items-center">
                  <div class="mt-3 mt-md-0 ms-auto">
                    <button type="submit" class="btn btn-primary  hstack gap-6">
                      <i class="ti ti-send fs-4"></i>
                      Simpan
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
    </div>
@endsection