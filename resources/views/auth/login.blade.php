@extends('layouts.auth')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">

                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>

                        <div class="col-lg-6">
                            <div class="p-5">

                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>

                                {{-- ERROR --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        {{ $errors->first() }}
                                    </div>
                                @endif

                                {{-- SUCCESS (session) --}}
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('login') }}" class="user">
                                    @csrf

                                    <div class="form-group">
                                        <input type="email"
                                            name="email"
                                            class="form-control form-control-user"
                                            placeholder="Enter Email Address..."
                                            value="{{ old('email') }}"
                                            required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <input type="password"
                                            name="password"
                                            class="form-control form-control-user"
                                            placeholder="Password"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox"
                                                name="remember"
                                                class="custom-control-input"
                                                id="remember">
                                            <label class="custom-control-label" for="remember">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit"
                                        class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>

                                </form>

                                <hr>

                                @if (Route::has('password.request'))
                                <div class="text-center">
                                    <a class="small" href="{{ route('password.request') }}">
                                        Forgot Password?
                                    </a>
                                </div>
                                @endif

                                <div class="text-center">
                                    <a class="small" href="{{ route('register') }}">
                                        Create an Account!
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection