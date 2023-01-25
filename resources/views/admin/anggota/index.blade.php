@extends('layouts.app')

@section('title', 'Data Anggota')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-11 col-md-6 order-md-1 order-last mb-3">
                    <h3 class="mb-4">Data Anggota</h3>
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

                    <button class="btn btn-primary mb-3 ms-2" data-bs-toggle="modal" data-bs-target="#form-anggota-create">

                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tambah Anggota
                            <i class="bi bi-plus-lg ms-2"></i>
                        </span>

                    </button>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Anggota</th>
                                <th>NIS</th>
                                <th>Nama Lengkap</th>
                                <th>Kelas</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>
                        <tbody>

                            @foreach ($anggotas as $a)
                                <tr>

                                    <td class="align-middle">{{ $loop->iteration }}</td>

                                    <td class="align-middle">{{ $a->kode }}</td>
                                    <td class="align-middle">{{ $a->nis }}</td>
                                    <td class="align-middle">{{ $a->fullname }}</td>

                                    <td class="align-middle">{{ $a->kelas }}</td>
                                    <td class="align-middle">{{ $a->alamat }}</td>

                                    <td class="align-middle">


                                        <form action="{{ route('admin.update_status_anggota', $a->id) }}" method="POST"
                                            style="display: inline-block">
                                            @csrf

                                            <input type="hidden" value="{{ $a->verif }}" name="verif">
                                            <button type="submit"
                                                class="btn btn-{{ $a->verif == 'verified' ? 'success' : 'danger' }}">
                                                {{ $a->verif }}
                                            </button>


                                        </form>

                                    </td>
                                    <td class="align-middle">
                                        {{-- <form action="{{ }}" method="POST"> --}}
                                        {{-- @csrf --}}



                                        <button class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#form-anggota-update{{ $a->id }}"> <i
                                                class="bi bi-pencil-square"></i>
                                        </button>





                                        <form action="{{ route('admin.delete_anggota', $a->id) }}" method="POST"
                                            style="display:inline-block">
                                            @csrf

                                            <button type="submit" class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>




                                        {{-- </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    @include('admin.anggota.form.create')
    @include('admin.anggota.form.edit')
@endsection
