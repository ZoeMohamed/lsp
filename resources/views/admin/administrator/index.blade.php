@extends('layouts.app')

@section('title', 'Data Administrator')

@section('content')
    <style>
        .dataTable-sorter::before,
        .dataTable-sorter::after {
            display: none;
        }
    </style>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-11 col-md-6 order-md-1 order-last mb-3">
                    <h3 class="mb-4">Data Administrator</h3>
                </div>
            </div>
        </div>
        <section class="section">
            @if (session('status'))
                <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">

                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


            <div class="card">
                <div class="card-body">

                    <button class="btn btn-primary mb-3 ms-2" data-bs-toggle="modal" data-bs-target="#form-admin-create">

                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tambah Administrator
                            <i class="bi bi-plus-lg ms-2"></i>
                        </span>

                    </button>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Nama Pengguna</th>
                                <th>Terakhir Login</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>
                        <tbody>

                            @foreach ($admins as $a)
                                <tr>

                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $a->fullname }}</td>
                                    <td class="align-middle">{{ $a->username }}</td>
                                    <td class="align-middle">{{ $a->terakhir_login }}</td>
                                    <td class="align-middle">
                                        <button class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#form-admin-update{{ $a->id }}"> <i
                                                class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="{{ route('admin.delete_admin', $a->id) }}" method="POST"
                                            style="display:inline-block">
                                            @csrf

                                            <button type="submit" class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    @include('admin.administrator.form.create')
    @include('admin.administrator.form.edit')
@endsection
