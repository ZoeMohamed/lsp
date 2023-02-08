@extends('layouts.app')

@section('title', 'Data Administrator')

@section('content')
    <style>
        /* .dataTable-sorter::before,
                        .dataTable-sorter::after {
                            display: inline-block;
                        } */
    </style>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-11 col-md-6 order-md-1 order-last mb-3">
                    <h3 class="mb-4">Data Peminjaman</h3>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Kondisi Buku Saat Dipinjam</th>
                                <th>Kondisi Buku Saat Dikembalikan</th>
                                <th>Denda</th>
                            </tr>

                        </thead>
                        <tbody>

                            @foreach ($peminjams as $p)
                                <tr>

                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $p->user->username }}</td>
                                    <td class="align-middle">{{ $p->buku->judul }}</td>
                                    <td class="align-middle">{{ $p->tanggal_peminjaman }}</td>
                                    <td class="align-middle">{{ $p->tanggal_pengembalian }}</td>
                                    <td class="align-middle">{{ $p->kondisi_buku_saat_dipinjam }}</td>
                                    <td class="align-middle">{{ $p->kondisi_buku_saat_dikembalikan }}</td>
                                    <td class="align-middle">{{ $p->denda }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
