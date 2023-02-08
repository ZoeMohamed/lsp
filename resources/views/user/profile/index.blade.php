@extends('layouts.app')

@section('title', 'Profile User')

@section('content')
    <div class="container">

        @if (session('status'))
            <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">

                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4>Update Profil</h4>
            </div>

            <div class="card-body">

                <div class="user-img d-flex align-items-center mb-5">
                    <div class="avatar avatar-xl" style="margin:0 auto;border:1px solid light-grey">
                        <img src="{{ Auth::user()->foto }} " style="width:200px;height:200px;">
                    </div>
                </div>


                <form action="{{ route('user.profil.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <table class="table table-striped table-bordered">



                        <tr>

                            <th>Foto</th>

                            <td>
                                <input name="foto" class="form-control" type="file">

                                <img src="" alt="">
                            </td>

                        </tr>
                        <tr>
                            <th>
                                Nama Lengkap
                            </th>

                            <td>
                                <input type="text" name="fullname" value="{{ Auth::user()->fullname }}"
                                    class="form-control" required>
                            </td>


                        </tr>

                        <tr>
                            <th>NIS</th>

                            <td><input type="text" class="form-control" name="nis" value="{{ Auth::user()->nis }}"
                                    required>

                                {{-- <input type="hidden" class="form-control" name="kode" value="{{ Auth::user()->kode }}"> --}}
                            </td>
                        </tr>

                        <tr>

                            <th>Alamat</th>

                            <td>
                                <textarea name="alamat" class="form-control" name="alamat" required>{{ Auth::user()->alamat }}</textarea>
                            </td>

                        </tr>
                        <tr>
                            <th>Username</th>

                            <td>
                                <input class="form-control" name="username" required value="{{ Auth::user()->username }}">
                            </td>

                        </tr>

                        <tr>
                            <th>Kelas</th>

                            <td>
                                <input name="kelas" class="form-control" required type="text"
                                    value="{{ Auth::user()->kelas }}">
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-primary text-white mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
