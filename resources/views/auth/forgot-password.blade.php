@extends('layouts.auth')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">

                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>

                        <div class="col-lg-6">
                            <div class="p-5">

                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                    <p class="mb-4">
                                        Just enter your email and we’ll send you a reset link!
                                    </p>
                                </div>

                                {{-- SUCCESS MESSAGE --}}
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                {{-- ERROR --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        {{ $errors->first() }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('password.email') }}" class="user">
                                    @csrf

                                    <div class="form-group">
                                        <input type="email"
                                            name="email"
                                            class="form-control form-control-user"
                                            placeholder="Enter Email Address..."
                                            value="{{ old('email') }}"
                                            required autofocus>
                                    </div>

                                    <button type="submit"
                                        class="btn btn-primary btn-user btn-block">
                                        Reset Password
                                    </button>

                                </form>

                                <hr>

                                <div class="text-center">
                                    <a class="small" href="{{ route('register') }}">
                                        Create an Account!
                                    </a>
                                </div>

                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">
                                        Already have an account? Login!
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