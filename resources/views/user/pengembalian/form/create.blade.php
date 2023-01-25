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
            <h4>Form Pengembalian Buku</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('user.submit_pengembalian') }}" class="form-group" method="POST">

                @csrf


                <div class="mb-5">
                    <label for="tanggal_peminjaman">Tanggal Pengembalian</label>
                    <input type="date" class="form-control" name="tanggal_pengembalian" required
                        value="{{ $carbon::now()->format('Y-m-d') }}" />
                </div>


                <div class="mb-5">
                    <label for="">Pilih Buku</label>

                    <select name="buku_id" class="form-select choices @error('buku_id') is-invalid @enderror" name="buku_id"
                        required id="buku">


                        <option disabled selected value="">--Pilih Opsi--</option>

                        @foreach ($buku->unique('buku_id') as $b)
                            <option value="{{ $b->buku->id }}"
                                {{ isset($buku_id) ? ($buku_id == $b->buku->id ? 'selected' : '') : '' }}>
                                {{ $b->buku->judul }}
                            </option>
                        @endforeach
                    </select>
                </div>




                <div class="mb-5">
                    <label for="">Kondisi buku</label>
                    <select class="form-select" name="kondisi_buku_saat_dikembalikan" required>
                        <option disabled selected id="kondisi">--Pilih Opsi--</option>
                        <option id="kondisi" value="baik">Baik</option>
                        <option id="kondisi" value="rusak">Rusak</option>
                        <option id="kondisi" value="hilang">Hilang</option>

                    </select>
                </div>

                <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" required />
                <button type="submit" class="btn btn-primary text-white">Pengembalian Buku</button>
            </form>
        </div>
    </div>

    <script>
        // let buku = document.getElementById('buku')

        // buku.addEventListener('change', () => {
        //     // Fetch data j_buku_baik
        //     let kondisi = document.getElementById('kondisi')
        //     fetch('http://127.0.0.1:8000/api/peminjaman/' + buku.value).then(res => res.json()).then(data => {

        //         console.log(data.datas.kondisi_buku_saat_dipinjam)

        //         if (data.datas.kondisi_buku_saat_dipinjam == "baik") {
        //             kondisi.innerHTML = ''
        //             kondisi.innerHTML +=
        //             `<option value='${data.datas.id}'>'baik'</option>`
        //             `<option value='${data.datas.id}'>'rusak'</option>`
        //             `<option value='${data.datas.id}'>'hilang'</option>`
        //         } else if (data.datas.kondisi_buku_saat_dikembalikan == "rusak") {

        //             kondisi.innerHTML = ''
        //             kondisi.innerHTML +=
        //                 `<option value='${data.datas.id}'>'rusak'</option>`
        //             `<option value='${data.datas.id}'>'hilang'</option>`

        //         }

        //     })
        // })
    </script>
@endsection

{{--  --}}
