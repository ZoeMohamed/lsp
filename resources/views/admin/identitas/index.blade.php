@extends('layouts.app')


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
                <h4>Update Identitas Aplikasi</h4>
            </div>

            <div class="card-body">

                <div class="user-img d-flex align-items-center mb-5">
                    <div class="avatar avatar-xl" style="margin:0 auto;">
                        <img src="{{ $data[0]->foto }} " style="width:200px;height:200px;">
                    </div>
                </div>


                <form action="{{ route('admin.identitas.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <table class="table table-striped table-bordered">



                        <tr>

                            <th>Foto</th>

                            <td>
                                <input name="foto" class="form-control" type="file">
                            </td>

                        </tr>
                        <tr>
                            <th>
                                Nama Aplikasi
                            </th>

                            <td>
                                <input type="text" name="nama_app" value="{{ $data[0]->nama_app }}" class="form-control"
                                    required>
                            </td>


                        </tr>

                        <tr>
                            <th>Email</th>

                            <td><input type="text" class="form-control" name="email_app"
                                    value="{{ $data[0]->email_app }}" required>

                                {{-- <input type="hidden" class="form-control" name="kode" value="{{ Auth::user()->kode }}"> --}}
                            </td>
                        </tr>





                        <tr>

                            <th>Nomor Hp</th>

                            <td>
                                <input class="form-control" name="nomor_hp" required value="{{ $data[0]->nomor_hp }}">
                            </td>

                        </tr>


                        <tr>

                            <th>Alamat</th>

                            <td>
                                <textarea name="alamat" class="form-control" name="alamat">{{ $data[0]->alamat_app }}
                                </textarea>
                            </td>

                        </tr>










                    </table>

                    <button type="submit" class="btn btn-primary text-white mt-3">Simpan</button>


                </form>

            </div>
        </div>



    </div>
@endsection
