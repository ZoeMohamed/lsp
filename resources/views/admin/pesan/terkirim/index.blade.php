@extends('layouts.app')

@section('title', 'Pesan Terkirim')

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

                    <h3 class="mb-4">Pesan Terkirim</h3>
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


                    <button class="btn btn-primary mb-3 ms-2" data-bs-toggle="modal" data-bs-target="#form-pesan-admin">

                        <i class="bi bi-send-fill me-2"></i> Kirim Pesan



                    </button>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Penerima</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th>Status</th>
                                <th>Tanggal Kirim</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>
                        <tbody>

                            @foreach ($data_pesan as $pesan)
                                <tr>
                                    <td class="align-middle">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="align-middle">
                                        {{ $pesan->penerima->username }}
                                    </td>

                                    <td class="align-middle">
                                        {{ $pesan->judul }}
                                    </td>

                                    <td class="align-middle">
                                        {{ $pesan->isi }}
                                    </td>

                                    <td class="align-middle">
                                        {{ $pesan->status }}
                                    </td>

                                    <td class="align-middle">
                                        {{ $pesan->tanggal_kirim }}
                                    </td>

                                    <td class="align-middle">
                                        <form action="{{ route('admin.delete_pesan', $pesan->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger">
                                                <i class="bi bi-trash-fill"></i>
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
    @include('admin.pesan.terkirim.form.create')
@endsection
