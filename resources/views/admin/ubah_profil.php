<div class="main-content">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-5 col-sm-12">
                <h4 style="margin-top: 6rem; margin-left: 10px;">Ubah Profil Saya</h4>
                <div class="card">
                    <div class="card-body">
                        <?php
                        use Utils\Flasher;

                        Flasher::flash();
                        ?>
                        <form action="<?= base_url; ?>profil/admin/ubah" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control w-100"
                                    value="<?= $data['admin']->nama_admin ?>">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea id="alamat" class="form-control w-100"
                                    name="alamat"><?= $data['admin']->alamat ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="notelp">No Telepon</label>
                                <input type="text" id="notelp" name="notelp" class="form-control w-100"
                                    value="<?= $data['admin']->notelp ?>">
                            </div>
                            <label for="inputGroupFile04">Foto Profil</label>
                            <div class="input-group mb-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="foto" id="inputGroupFile04"
                                        aria-describedby="inputGroupFileAddon04">
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                </div>
                            </div>
                            <p style="margin-top: -20px;">*format foto : jpg / jpeg / png, Ukuran maks. 2 MB</p>
                            <div class="mt-5 d-flex justify-content-end">
                                <a href="<?= base_url ?>profil/admin" class="btn btn-danger btn-tone mr-3">Kembali</a>
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>