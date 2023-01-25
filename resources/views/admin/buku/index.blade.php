@extends('layouts.app')


@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-11 col-md-6 order-md-1 order-last mb-3">
                    <h3 class="mb-4">Data Buku</h3>
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

                    <button class="btn btn-primary mb-3 ms-2" data-bs-toggle="modal" data-bs-target="#form-buku-create">

                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tambah Buku
                            <i class="bi bi-plus-lg ms-2"></i>
                        </span>

                    </button>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th style="width:125px;">No</th>
                                <th>Gambar Buku</th>
                                <th>Judul Buku </th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Kategori</th>
                                <th>Buku Baik</th>
                                <th>Buku Rusak</th>
                                <th>Jumlah Buku</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>
                        <tbody>

                            @foreach ($bukus as $b)
                                <tr>

                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">
                                        <img src="{{ $b->foto }}" alt="">
                                    </td>

                                    <td class="align-middle">{{ $b->judul }}</td>
                                    <td class="align-middle">{{ $b->pengarang }}</td>
                                    <td class="align-middle">{{ $b->penerbit->nama }}</td>
                                    <td class="align-middle">{{ $b->kategori->nama }}</td>

                                    <td class="align-middle">{{ $b->j_buku_baik }}</td>
                                    <td class="align-middle">{{ $b->j_buku_rusak }}</td>
                                    <td class="align-middle">{{ intval($b->j_buku_baik) + intval($b->j_buku_rusak) }}</td>
                                    <td class="align-middle">
                                        <button class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#form-buku-update{{ $b->id }}"> <i
                                                class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="{{ route('admin.delete_buku', $b->id) }}" method="POST"
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
    @include('admin.buku.form.create')
    @include('admin.buku.form.edit')
@endsection
