@extends('layouts.app')

@section('title', 'History Pengembalian Buku')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-11 col-md-6 order-md-1 order-last mb-3">

                    <h3 class="mb-4">History Pengembalian Buku</h3>
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
                    <a href="{{ route('user.form_pengembalian') }} ">

                        <button class="btn btn-primary mb-3 ms-2">

                            Kembalikan Buku

                        </button></a>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Kondisi Buku Saat Dipinjam</th>
                                <th>Kondisi Buku Saat Dikembalikan</th>
                                <th class="col-1">Denda</th>
                            </tr>

                        </thead>
                        <tbody>

                            @foreach ($query as $b)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $b->buku->judul }}</td>
                                    <td>{{ $b->tanggal_pengembalian }}</td>
                                    <td>{{ $b->kondisi_buku_saat_dipinjam }}</td>
                                    <td>{{ $b->kondisi_buku_saat_dikembalikan }}</td>
                                    <td>{{ $b->denda }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
