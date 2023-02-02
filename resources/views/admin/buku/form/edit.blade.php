@foreach ($bukus as $a)
    <div class="modal fade modal-lg" id="form-buku-update{{ $a->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">
                        Edit Buku
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form form-vertical" action="{{ route('admin.update_buku', $a->id) }}" method="POST"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>Judul Buku</label>
                                    <input type="text" class="form-control" name="judul" placeholder="Judul Buku"
                                        required value="{{ $b->judul }}" />
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>Kategori Buku</label>
                                    <select class="form-select choices" name="kategori_id" required>
                                        {{-- <option value="" selected>--Pilih Opsi--</option> --}}
                                        @foreach ($kategoris as $k)
                                            <option value="{{ $k->id }}"
                                                {{ $k->id == $b->kategori->id ? 'selected' : '' }}>
                                                {{ $k->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-12 mb-4">
                                <div class="form-group">

                                    <label for="tanggal_peminjaman">Tanggal Terbit</label>
                                    <input type="date" class="form-control" name="tahun_terbit" required
                                        value="{{ $b->tahun_terbit }}" />

                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>ISBN</label>
                                    <input type="text" class="form-control" name="isbn" placeholder="ISBN"
                                        value="{{ $b->isbn }}" />
                                </div>
                            </div>


                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>Pengarang</label>
                                    <input type="text" class="form-control" name="pengarang" placeholder="Pengarang"
                                        required value="{{ $b->pengarang }}" />
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>Penerbit</label>
                                    <select class="form-select choices" name="penerbit_id" required>
                                        @foreach ($penerbits as $p)
                                            <option value="{{ $p->id }}"
                                                {{ $p->id == $b->penerbit->id ? 'selected' : '' }}>
                                                {{ $p->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>Jumlah Buku Baik</label>
                                    <input type="number" class="form-control" name="j_buku_baik"
                                        placeholder="Jumlah Buku Baik" required min="1"
                                        value="{{ $b->j_buku_baik }}" />
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>Jumlah Buku Rusak</label>
                                    <input type="number" class="form-control" name="j_buku_rusak"
                                        placeholder="Jumlah Buku Baik" required min="1"
                                        value="{{ $b->j_buku_rusak }}" />
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>

                    <button type="submit" class="btn btn-primary ml-2 ms-2">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Update buku
                            <i class="bi bi-pencil-square ms-2"></i>
                        </span>
                    </button>
                </div>

                </form>
            </div>
        </div>
    </div>
@endforeach
