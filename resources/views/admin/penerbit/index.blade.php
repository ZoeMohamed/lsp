@extends('layouts.app')


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
                    <h3 class="mb-4">Data Penerbit</h3>
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

                    <button class="btn btn-primary mb-3 ms-2" data-bs-toggle="modal" data-bs-target="#form-penerbit-create">

                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tambah Penerbit
                            <i class="bi bi-plus-lg ms-2"></i>
                        </span>

                    </button>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Penerbit</th>
                                <th>Nama Penerbit</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>
                        <tbody>

                            @foreach ($penerbits as $p)
                                <tr>

                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $p->kode }}</td>
                                    <td class="align-middle">{{ $p->nama }}</td>
                                    <td class="align-middle">
                                        <form action="{{ route('admin.update_status_penerbit', $p->id) }}" method="POST"
                                            style="display: inline-block">
                                            @csrf
                                            <input type="hidden" value="{{ $p->verif }}" name="verif">
                                            <button type="submit"
                                                class="btn btn-{{ $p->verif == 'verified' ? 'success' : 'danger' }}">
                                                {{ $p->verif }}
                                            </button>
                                        </form>

                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#form-penerbit-update{{ $p->id }}"> <i
                                                class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="{{ route('admin.delete_penerbit', $p->id) }}" method="POST"
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
    @include('admin.penerbit.form.create')
    @include('admin.penerbit.form.edit')
@endsection
