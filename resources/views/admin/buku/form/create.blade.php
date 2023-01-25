<style>
    .choices__inner {
        background-color: white;
        border: 1px solid #dce7f1;
        padding: .225rem .2rem;
        font-size: 16px;
    }
</style>
<div class="modal fade modal-lg" id="form-buku-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">
                    Tambah Buku
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form form-vertical" action="{{ route('admin.tambah_buku') }}" method="POST"
                    autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="row">


                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>Judul Buku</label>
                                    <input type="text" class="form-control" name="judul" placeholder="Judul Buku"
                                        required />
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>Kategori Buku</label>
                                    <select class="form-select choices" name="kategori_id" required>
                                        <option value="" selected disabled>--Pilih Opsi--</option>
                                        @foreach ($kategoris as $k)
                                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-12 mb-4">
                                <div class="form-group">

                                    <label for="tanggal_peminjaman">Tanggal Terbit</label>
                                    <input type="date" class="form-control" name="tahun_terbit" required />

                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>ISBN</label>
                                    <input type="text" class="form-control" name="isbn" placeholder="ISBN" />
                                </div>
                            </div>


                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>Pengarang</label>
                                    <input type="text" class="form-control" name="pengarang" placeholder="Pengarang"
                                        required />
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>Penerbit</label>
                                    <select class="form-select choices" name="penerbit_id" required>
                                        <option value="" selected disabled>--Pilih Opsi--</option>
                                        @foreach ($penerbits as $p)
                                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>Jumlah Buku Baik</label>
                                    <input type="number" class="form-control" name="j_buku_baik"
                                        placeholder="Jumlah Buku Baik" required min="1" />
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>Jumlah Buku Rusak</label>
                                    <input type="number" class="form-control" name="j_buku_rusak"
                                        placeholder="Jumlah Buku Baik" required min="1" />
                                </div>
                            </div>


                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>Upload Gambar Buku</label>
                                    <input type="file" class="form-control" name="foto" placeholder="Gambar" />
                                </div>
                            </div>






                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>

                <button type="submit" class="btn btn-primary ml-2 ms-2">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Tambah buku
                        <i class="bi bi-plus-lg ms-2"></i>
                    </span>
                </button>
            </div>

            </form>
        </div>
    </div>
</div>
