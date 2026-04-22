@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Edit Belanja</h1>

        <div class="card shadow">
            <div class="card-body">

                <form action="{{ route('belanja.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="form-group">
                        <label>Bidang</label>
                        <input type="text" name="bidang" value="{{ $data->bidang }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Kegiatan</label>
                        <input type="text" name="nama_kegiatan" value="{{ $data->nama_kegiatan }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Pagu</label>
                        <input type="number" name="pagu" value="{{ $data->pagu }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Realisasi</label>
                        <input type="number" name="realisasi_belanja" value="{{ optional($data->realisasi)->realisasi }}"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Dokumentasi</label>
                        @foreach($data->dokumentasi as $doc)
                            <img src="{{ asset('storage/' . $doc->file) }}" style="width:100px">
                        @endforeach

                        <input type="file" name="dokumentasi[]" multiple class="form-control">
                    </div>

                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('belanja.index') }}" class="btn btn-secondary">Kembali</a>

                </form>

            </div>
        </div>

    </div>
@endsection