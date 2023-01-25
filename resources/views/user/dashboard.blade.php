@extends('layouts.app')


@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                {{-- <div class="col-12 col-md-6 order-md-1 order-last mb-2">
                    <h3>Buku Perpustakaan</h3>
                </div> --}}
            </div>
        </div>
        <section class="section">

            <div class="row row-cols-1 row-cols-md-3 g-4">

                @foreach ($buku as $b)
                    <div class="col-xl-3 col-md-6 col-sm-12">
                        <div class="card h-100">
                            <div class="card-content">

                                <img src="{{ $b->foto ?? '/assets/images/not-found.png' }}" class="card-img-top "
                                    alt="singleminded" style="height: 220px;object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $b->judul }}</h5>
                                    <span class="badge bg-light-primary badge-pill badge-round float-right mt-60">
                                        {{ $b->kategori->nama }}
                                    </span>

                                    <p class="mt-3 mb-1">Penerbit : {{ $b->penerbit->nama }}</p>
                                    <p>Pengarang : {{ $b->pengarang }}</p>
                                    <hr>
                                    <form action="{{ route('user.form_peminjaman_dashboard') }}" method="POST">

                                        <input type="hidden" name="buku_id" value="{{ $b->id }}" />

                                        @csrf

                                        <a href="{{ route('user.form_peminjaman_dashboard') }}">
                                            <button class="btn btn-primary" type="submit">Pinjam Buku</button>
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
