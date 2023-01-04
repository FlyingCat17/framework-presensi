<div class="page-container">
    <div class="main-content">
        <div class="container">
            <h3>Ubah Informasi Akademik</h3>
            <div class="card">
                <div class="card-body">
                    <?php
                    use Utils\Flasher;

                    Flasher::flash();
                    ?>
                    <div class="row">
                        <div class="col-lg-7 col-md-12">
                            <form action="<?= base_url; ?>informasi/ubah/<?= $data['informasi']->id_informasi ?>"
                                method="post" enctype="multipart/form-data">
                                <div class="d-flex justify-content-between">
                                    <label for="judul">Judul Informasi Akademik</label>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Masukkan Judul" name="judul"
                                        id="judul"
                                        value="<?=(isset($data['judul']) ? $data['judul'] : (isset($data['informasi']) ? $data['informasi']->judul_informasi : '')) ?>">
                                </div>
                                <div class="d-flex justify-content-end">
                                    <p class="text-end">Maks : 100 karakter</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <label for="isi">Isi Informasi Akademik</label>
                                </div>
                                <div class="input-group mb-3">
                                    <textarea name="isi"
                                        id="isi"><?=(isset($data['isi']) ? $data['isi'] : (isset($data['informasi']) ? $data['informasi']->isi_informasi : '')) ?></textarea>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <label for="thumbnail">Thumbnail / Gambar Depan</label>
                                </div>
                                <div class="input-group mb-4">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="thumbnail" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <a href="<?= base_url ?>informasi" class="btn btn-danger mr-2">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

