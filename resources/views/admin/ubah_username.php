<div class="main-content">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-5 col-sm-12">
                <h4 style="margin-top: 6rem; margin-left: 10px;">Ganti Username</h4>
                <div class="card">
                    <div class="card-body">
                        <?php
                        use Utils\Flasher;

                        Flasher::flash();
                        ?>
                        <form action="<?= base_url; ?>profil/admin/ubah/username" method="post">
                            <div class="form-group">
                                <label for="username">Masukkan Username Baru</label>
                                <input type="text" name="username" class="form-control" id="username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="<?= base_url; ?>profil/admin" class="btn btn-danger mr-3">Kembali</a>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>