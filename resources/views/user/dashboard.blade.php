@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')


    <style>
        ::-webkit-scrollbar {
            width: 2px;
            height: 3px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                {{-- <div class="col-12 col-md-6 order-md-1 order-last mb-2">
                    <h3>Buku Perpustakaan</h3>
                </div> --}}
            </div>
        </div>
        <section class="section">

            
            @foreach ($kategoris as $kategori)
                @if (count($kategori->bukus) != 0)
                    <div class="ps-2 mb-1">
                        <span class="badge bg-primary badge-pill badge-round float-right mt-60">
                            {{ $kategori->nama }}
                        </span>
                    </div>
                @endif

                <div class="row row-cols-1 row-cols-md-3 g-4  mb-5 d-flex flex-row flex-nowrap overflow-auto ms-1 ">

                    {{-- Foreach Kategori --}}
                    @foreach ($kategori->bukus as $b)
                        <div class="col-xl-3 col-md-6 col-sm-12 g-4 py-2 {{ $loop->iteration == 1 ? 'ps-0' : '' }}">
                            <div class="card h-100">
                                <div class="card-content">
                                    <img src="{{ $b->foto ?? '/assets/images/app_images/not-found.png' }}"
                                        class="card-img-top " alt="singleminded" style="height: 220px;object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $b->judul }}</h5>
                                        <span class="badge bg-light-primary badge-pill badge-round float-right mt-60">
                                            {{ $b->kategori->nama }}
                                        </span>

                                        <p class="mt-3 mb-1 fw-bold">Penerbit : {{ $b->penerbit->nama }}</p>
                                        <p class="mb-1 fw-bold">Pengarang : {{ $b->pengarang }}</p>
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
            @endforeach


        </section>
    </div>
@endsection
