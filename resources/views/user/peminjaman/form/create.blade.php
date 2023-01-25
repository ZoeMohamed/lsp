@extends('layouts.app')

@section('content')
    @inject('carbon', 'Carbon\Carbon')
    <style>
        .choices__inner {
            background-color: white;
            border: 1px solid #dce7f1;
            /* padding: .825rem 1rem; */
            font-size: 18px;
        }
    </style>

    <div class="card">
        <div class="card-header">
            <h4>Form Peminjaman</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('user.submit_peminjaman') }}" class="form-group" method="POST">

                @csrf
                <div class="mb-5">
                    <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                    <input type="date" class="form-control" name="tanggal_peminjaman"
                        value="{{ $carbon::now()->format('Y-m-d') }}" readonly required />
                </div>


                <div class="mb-5">
                    <label>Pilih Buku</label>

                    <select id="buku" class="choices form-select @error('buku_id') is-invalid @enderror"
                        name="buku_id">

                        <option disabled selected value="">--Pilih Opsi--</option>


                        @foreach ($buku as $b)
                            <option value="{{ $b->id }}"
                                {{ isset($buku_id) ? ($buku_id == $b->id ? 'selected' : '') : '' }}>

                                <p style="height:100%">{{ $b->judul }}</p>
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label for="">Kondisi buku</label>
                    <select id="" class="form-select" name="kondisi_buku_saat_dipinjam" required>
                        <option disabled selected value="">--Pilih Opsi--</option>
                        <option value="baik">Baik</option>
                        <option value="rusak">Rusak</option>
                    </select>
                </div>

                <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" required />
                <button type="submit" class="btn btn-primary text-white">Pinjam Buku</button>
            </form>
        </div>
    </div>
@endsection
