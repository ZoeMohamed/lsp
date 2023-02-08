@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
    {{-- Scrollable --}}


    <style>
        .scrollable {
            max-height: 400px;
            overflow-y: auto;
            scrollbar-width: thin;
        }


        /* width */
        ::-webkit-scrollbar {
            width: 10px;
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
    @php
        use App\Models\Pemberitahuan;
        $pemberitahuan = Pemberitahuan::all();
        
    @endphp

    <div class="col-6 mb-3">
        <h3 class="d-inline">Dashboard</h3>
    </div>
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="bi-book"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Jumlah Buku</h6>
                                    <h6 class="font-extrabold mb-0">
                                        {{ $bukus }}

                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="bi-hospital-fill"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h6 class="text-muted font-semibold">Jumlah Kategori</h6>
                                    <h6 class="font-extrabold mb-0">{{ $kategoris }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="bi-diagram-3-fill"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h6 class="text-muted font-semibold">Jumlah Member</h6>
                                    <h6 class="font-extrabold mb-0">{{ $members }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="bi-file-medical-fill"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h6 class="text-muted font-semibold"> Jumlah Penerbit</h6>
                                    <h6 class="font-extrabold mb-0">{{ $penerbits }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4-5 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="/assets/images/faces/2.jpg" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">{{ Auth::user()->username }}</h5>
                            <h6 class="text-muted mb-0">{{ Str::ucfirst(Auth::user()->role) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="col-12 text-center mt-5">

            @php
                use App\Models\Identitas;
                $identitas = Identitas::first();
                
            @endphp
            <img src="{{ $identitas->foto ?? '/assets/images/app_image/not-found.png' }}" alt="" width="300"
                height="300" class="mb-5">
            <h5 class="mb-4">{{ $identitas->nama_app }}</h5>
            <h5 class="mb-4">{{ $identitas->email_app }}</h5>
            <h5 class="mb-4">{{ $identitas->no_hp }}</h5>
            <h5 class="mb-4">{{ $identitas->alamat_app }}</h5>
        </div>


        {{-- <div class="row">
            <div class="col-12 col-xl-12 ">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10">
                                <h6>Pemberitahuan</h6>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive scrollable">
                            <table class="table table-hover table-lg">
                                <thead>
                                    <tr>
                                        <th class="col-6">No.</th>
                                        <th>Isi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($pemberitahuan as $p)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $p->isi }}</td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>
@endsection
