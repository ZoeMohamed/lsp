<style>
    .choices__inner {
        background-color: white;
        border: 1px solid #dce7f1;
        padding: .225rem .2rem;
        font-size: 16px;
    }
</style>

@foreach ($anggotas as $a)
    <div class="modal fade modal-lg" id="form-anggota-update{{ $a->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">
                        Edit Anggota
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form form-vertical" action="{{ route('admin.update_anggota', $a->id) }}" method="POST"
                        autocomplete="off">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label>Kode Anggota</label>
                                        <input type="text" class="form-control" name="kode_anggota"
                                            placeholder="#Auto Generated" readonly disabled
                                            value="{{ $a->kode }}" />
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label>NIS</label>
                                        <input type="text" class="form-control" name="nis" placeholder="NIS"
                                            value="{{ $a->nis }}" required />
                                    </div>
                                </div>


                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username"
                                            placeholder="Username" required value="{{ $a->username }}" />
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label>Fullname</label>
                                        <input type="text" class="form-control" name="fullname"
                                            placeholder="Fullname" required value="{{ $a->fullname }}" />
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Password" required autocomplete="new-password" />
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label>Kelas</label>
                                        <input type="text" class="form-control" name="kelas" placeholder="Kelas"
                                            required value="{{ $a->kelas }}" />
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea class="form-control" rows="3" name="alamat">{{ $a->alamat }}
                                        </textarea>
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
                        <span class="d-none d-sm-block">Update Anggota
                            <i class="bi bi-pencil-square ms-2"></i>
                        </span>
                    </button>
                </div>

                </form>
            </div>
        </div>
    </div>
@endforeach
