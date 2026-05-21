@extends('layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">

    <h1 class="h3 mb-0 text-gray-800">

        Kelola User

    </h1>

    <a href="{{ route('users.create') }}"
       class="btn btn-primary shadow-sm">

        <i class="fas fa-plus fa-sm text-white-50 mr-1"></i>

        Tambah User

    </a>

</div>


@if(session('success'))

    <div class="alert alert-success">

        {{ session('success') }}

    </div>

@endif


<div class="card shadow mb-4 border-0">

    <div class="card-header py-3 bg-white border-0">

        <h6 class="m-0 font-weight-bold text-primary">

            Data User

        </h6>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="thead-light">

                    <tr>

                        <th width="60">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th width="160">Role</th>
                        <th width="220">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($users as $item)

                        <tr>

                            <td>

                                {{ $loop->iteration }}

                            </td>

                            <td class="font-weight-bold text-gray-800">

                                {{ $item->name }}

                            </td>

                            <td>

                                {{ $item->email }}

                            </td>

                            <td>

                                @if($item->role == 'superadmin')

                                    <span class="badge badge-primary px-3 py-2">

                                        Superadmin

                                    </span>

                                @else

                                    <span class="badge badge-success px-3 py-2">

                                        Bendahara

                                    </span>

                                @endif

                            </td>

                            <td>

                                <a href="{{ route('users.edit', $item->id) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                    Edit

                                </a>

                                <form action="{{ route('users.destroy', $item->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus user ini?')">

                                        <i class="fas fa-trash"></i>

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="text-center text-muted py-4">

                                Belum ada user

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection