<div class="main-content">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-5 col-sm-12">
                <h4 style="margin-top: 6rem; margin-left: 10px;">Ganti Password</h4>
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url; ?>profil/admin/ubah/password" method="post">
                            <div class="form-group">
                                <label for="password_lama">Masukkan Password Lama</label>
                                <input type="password" name="password_lama" class="form-control" id="password_lama">
                            </div>
                            <div class="form-group">
                                <label for="password_baru">Masukkan Password Baru</label>
                                <input type="password" name="password_baru" class="form-control" id="password_baru">
                            </div>
                            <div class="form-group">
                                <label for="konfirmasi_password">Konfirmasi Password Baru</label>
                                <input type="password" name="konfirmasi_password" class="form-control"
                                    id="konfirmasi_password">
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-end">
                                    <a href="<?= base_url; ?>profil/admin" class="btn btn-danger mr-3">Kembali</a>
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>