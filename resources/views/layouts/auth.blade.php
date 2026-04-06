@extends('layouts.auth')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card shadow-lg my-5">
                <div class="card-body p-0">

                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>

                        <div class="col-lg-6">
                            <div class="p-5">

                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login SIMKEU</h1>
                                </div>

                                <form method="POST" action="#">
                                    @csrf

                                    <div class="form-group">
                                        <input type="email" name="email"
                                            class="form-control form-control-user"
                                            placeholder="Email">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password"
                                            class="form-control form-control-user"
                                            placeholder="Password">
                                    </div>

                                    <button type="submit"
                                        class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>

                                </form>

                                <hr>

                                <div class="text-center">
                                    <a class="small" href="#">Forgot Password?</a>
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