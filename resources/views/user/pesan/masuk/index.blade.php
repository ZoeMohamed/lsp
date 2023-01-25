@extends('layouts.app')


@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-11 col-md-6 order-md-1 order-last mb-3">

                    <h3 class="mb-4">Pesan Masuk</h3>
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

                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th class="col-1">Pengirim</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th>Status</th>
                                <th style="width:90px">Tanggal Kirim</th>
                                <th style="width:90px">Aksi</th>
                            </tr>

                        </thead>
                        <tbody>

                            @foreach ($pesans as $pesan)
                                <tr>
                                    <td class="align-middle">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="align-middle">
                                        {{ $pesan->pengirim->username }}
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


                                        @if ($pesan->status == 'Belum Dibaca')
                                            <form action="{{ route('user.edit_status_pesan', $pesan->id) }}" method="POST">
                                                @csrf


                                                <button class="btn btn-success">
                                                    <i class="bi bi-check-lg"></i>
                                                </button>


                                            </form>
                                        @else
                                            <form action="{{ route('user.delete_pesan', $pesan->id) }}" method="POST">
                                                @csrf


                                                <button class="btn btn-danger">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>


                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
