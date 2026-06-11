@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-4">
        Cetak Laporan
    </h1>

    <div class="card shadow">

        <div class="card-body">

            <form action="{{ route('laporan.cetak') }}" method="GET">

                <div class="form-group">

                    <label>Tahun</label>

                    <input
                        type="number"
                        name="tahun"
                        class="form-control"
                        value="{{ date('Y') }}"
                    >

                </div>

                <button class="btn btn-primary">
                    Cetak Laporan
                </button>

            </form>

        </div>

    </div>

</div>

@endsection