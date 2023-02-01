@extends('layouts.app')


@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-11 col-md-6 order-md-1 order-last mb-3">
                    <h3 class="mb-4">Laporan Peminjaman Buku</h3>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('admin.download_peminjaman') }}" method="POST"
                        autocomplete="off">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label class="mb-3">
                                            <h6>Masukkan Tanggal Peminjaman Buku</h6>
                                        </label>
                                        <input type="date" class="form-control" name="tanggal_peminjaman" required />
                                    </div>
                                </div>

                                <div class="">
                                    <button class="btn btn-danger col-12 mb-3" name="pdf" value="pdf">
                                        Export To PDF
                                    </button>

                                    <button class="btn btn-success col-12 mt-1">
                                        <input type="hidden" value="excel" name="excel" value="excel">
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
