<form method="post" action="{{ route('profile.destroy') }}">
    @csrf
    @method('delete')

    <div class="alert alert-danger">
        <h5 class="font-weight-bold">Hapus Akun</h5>
        <p class="mb-3">
            Jika akun dihapus, seluruh data akan hilang permanen.
            Masukkan password untuk konfirmasi.
        </p>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password">

            @error('password', 'userDeletion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-danger">
            Hapus Akun
        </button>
    </div>
</form>