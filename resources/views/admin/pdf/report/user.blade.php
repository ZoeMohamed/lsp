@extends('layouts.app')


@section('content')
    <style>
        .choices__inner {
            background-color: white;
            border: 1px solid #dce7f1;
            /* padding: .825rem 1rem; */
            font-size: 18px;
        }
    </style>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-11 col-md-6 order-md-1 order-last mb-3">
                    <h3 class="mb-4">Laporan User</h3>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('admin.download_user') }}" method="POST"
                        autocomplete="off">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label class="mb-3">
                                            <h6>Masukkan Username</h6>
                                        </label>

                                        <select name="user_id" class="form-select choices">
                                            @foreach ($users as $u)
                                                <option value="{{ $u->id }}">{{ $u->username }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="">
                                    <button class="btn btn-danger col-12 mb-3" name="file" value="pdf">
                                        Export To PDF
                                    </button>

                                    <button class="btn btn-success col-12 mt-1" name="file" value="excel">
                                        Export To Excel
                                    </button>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
    </div>
    </section>
    </div>
@endsection
