<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <div class="form-group">
        <label>Password Saat Ini</label>
        <input type="password" name="current_password" class="form-control" placeholder="Masukkan password saat ini">

        @error('current_password', 'updatePassword')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label>Password Baru</label>
        <input type="password" name="password" class="form-control" placeholder="Masukkan password baru">

        @error('password', 'updatePassword')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi password baru">

        @error('password_confirmation', 'updatePassword')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button type="submit" class="btn btn-warning">
        Update Password
    </button>

    @if (session('status') === 'password-updated')
        <div class="alert alert-success mt-3">
            Password berhasil diperbarui.
        </div>
    @endif
</form>