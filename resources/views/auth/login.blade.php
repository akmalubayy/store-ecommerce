@extends('layouts.auth')

@push('addon-style')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
@endpush

@section('content')

{{-- style baru --}}

<!-- Page Content -->
    <div class="page-content page-auth">
      <section class="section-store-auth" data-aos="fade-up">
        <div class="container">
          <div class="row align-items-center row-login">
            <div class="col-lg-6 text-center">
              <img
                src="{{ url('./images/login-img.png') }}"
                alt="login-illustration"
                class="w-50 mb-4 mb-lg-none img-auth-animate"
              />
            </div>
            <div class="col-lg-5">
              <h2>
                Belanja kebutuhan utama,<br />
                menjadi lebih mudah
              </h2>
              <form method="POST" action="{{ route('login') }}" class="mt-3">
                @csrf
                <div class="form-group">
                  <label for="email">Email Address</label>
                    <input id="email" type="email" class="form-control w-75 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group w-75 ">
                  <label for="password">Password</label>
                    <input id="password" data-toggle="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <button type="submit" class="btn btn-success btn-block w-75 mt-4">
                    Sign In to My Account
                </button>
                <a
                  href="{{ route('register') }}"
                  class="btn btn-signup btn-block w-75 mt-4"
                >
                  Sign Up
                </a>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>


@endsection

@push('addon-script')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
@endpush
