<style>
    .choices__inner {
        background-color: white;
        border: 1px solid #dce7f1;
        padding: .225rem .2rem;
        font-size: 16px;
    }
</style>
<div class="modal fade modal-lg" id="form-anggota-create" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">
                    Tambah Anggota
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="form form-vertical" action="{{ route('admin.tambah_anggota') }}" method="POST"
                    autocomplete="off">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label>Kode Anggota</label>
                                    <input type="text" class="form-control" name="kode_anggota"
                                        placeholder="#Auto Generated" readonly disabled />
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>NIS</label>
                                    <input type="text" class="form-control" name="nis" placeholder="NIS"
                                        required />
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Username"
                                        required aria-autocomplete="none" />
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>Fullname</label>
                                    <input type="text" class="form-control" name="fullname" placeholder="Fullname"
                                        required />
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password"
                                        required autocomplete="new-password" />
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <input type="text" class="form-control" name="kelas" placeholder="Kelas"
                                        required />
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" rows="3" name="alamat"></textarea>
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
                    <span class="d-none d-sm-block">Tambah Anggota
                        <i class="bi bi-plus me-2"></i>
                    </span>
                </button>
            </div>

            </form>
        </div>
    </div>
</div>
