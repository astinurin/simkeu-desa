@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">

            Tambah User

        </h1>

        <a href="{{ route('users.index') }}"
           class="btn btn-secondary shadow-sm">

            <i class="fas fa-arrow-left fa-sm"></i>

            Kembali

        </a>

    </div>

    @if ($errors->any())

        <div class="alert alert-danger">

            {{ $errors->first() }}

        </div>

    @endif

    <div class="card shadow border-0">

        <div class="card-body p-4">

            <form action="{{ route('users.store') }}"
                  method="POST">

                @csrf

                <!-- NAMA -->
                <div class="form-group mb-4">

                    <label>

                        Nama

                    </label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           required>

                </div>

                <!-- EMAIL -->
                <div class="form-group mb-4">

                    <label>

                        Email

                    </label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           required>

                </div>

                <!-- PASSWORD -->
                <div class="form-group mb-4">

                    <label>

                        Password

                    </label>

                    <input type="password"
                           name="password"
                           class="form-control"
                           required>

                </div>

                <!-- ROLE -->
                <div class="form-group mb-4">

                    <label>

                        Role

                    </label>

                    <select name="role"
                            class="form-control"
                            required>

                        <option value="bendahara">

                            Bendahara

                        </option>

                        <option value="superadmin">

                            Superadmin

                        </option>

                    </select>

                </div>

                <button class="btn btn-primary">

                    <i class="fas fa-save mr-1"></i>

                    Simpan

                </button>

            </form>

        </div>

    </div>

</div>

@endsection