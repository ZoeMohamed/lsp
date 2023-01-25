<style>
    .choices__inner {
        background-color: white;
        border: 1px solid #dce7f1;
        padding: .225rem .2rem;
        font-size: 16px;
    }
</style>
<div class="modal fade modal-lg" id="form-pesan-admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">
                    Kirim Pesan
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form form-vertical" action="{{ route('admin.kirim_pesan') }}" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="first-name-vertical">Penerima</label>
                                    <select id="pesan"
                                        class="choices form-select @error('penerima_id') is-invalid @enderror"
                                        name="penerima_id">

                                        <option disabled selected value="">--Pilih Opsi--</option>
                                        {{-- @dd($list_penerima) --}}
                                        @foreach ($list_penerima as $penerima)
                                            <option value="{{ $penerima->id }}">
                                                {{ $penerima->username }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="text" class="form-control" name="judul" placeholder="Judul" />
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label>Isi</label>
                                    <textarea class="form-control" rows="3" name="isi"></textarea>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label>Tanggal Kirim</label>
                                    <input type="date" class="form-control" name="tanggal_kirim" readonly required
                                        value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" />
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

                <button type="submit" class="btn btn-primary ml-2 ms-2" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Kirim Pesan
                        <i class="bi bi-send-fill me-2"></i>
                    </span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
