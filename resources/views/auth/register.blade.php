@extends('layouts.auth')

@section('content')
    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
        <div class="card card-plain">
            <div class="card-header pb-0 text-start">
                <h4 class="font-weight-bolder">Sign Up</h4>
                <p class="mb-0">Enter your login, email and password to sign up</p>
            </div>
            <div class="card-body">
                <form role="form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <input name="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Username" aria-label="Email" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input name="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email" aria-label="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input name="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" aria-label="Password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input name="password_confirmation" type="password" class="form-control form-control-lg" placeholder="Password confirm" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-check form-check-info text-start">
                        <input name="terms_accept" class="form-check-input @error('terms_accept') is-invalid @enderror" type="checkbox" value="1" id="terms_accept" checked required>
                        <label class="form-check-label" for="terms_accept">
                            I agree the <a href="{{url('regulations')}}" class="text-dark font-weight-bolder">Terms and Conditions</a>
                        </label>
                        @error('terms_accept')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign up</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                    Already registered ?
                    <a href="{{url('login')}}" class="text-primary text-gradient font-weight-bold">Sign in</a>
                </p>
            </div>
        </div>
    </div>


@endsection
