<div class="page-container">
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-6">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h2 class="font-weight-bold">Tambah Kelas</h2>
                        </div>
                        <div>
                            <h5 class="text-right">Tahun Ajaran</h5>
                            <h5 class="text-right">
                                <?= $data['tahun_ajar']->tahun_ajaran ?>
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <?php
                                        use Utils\Flasher;

                                        Flasher::flash();
                                        ?>
                                        <form
                                            action="<?= base_url; ?>kelas/bagi/tambah/<?= $data['tahun_ajar']->id_tahun_ajaran ?>"
                                            method="post">
                                            <div class="form-group">
                                                <label for="kelas">Pilih Kelas</label>
                                                <select class="form-control" name="nama_kelas" id="kelas">
                                                    <option value="null">Kelas</option>
                                                    <?php foreach ($data['kelas'] as $kelas): ?>
                                                    <option value="<?= $kelas['id_kelas'] ?>">
                                                        <?= $kelas['nama_kelas'] ?>
                                                    </option>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="d-flex justify-content-end align-items-start">
                                                <button type="button" onclick="location.href='<?= base_url; ?>kelas/bagi'"
                                                    class="btn btn-danger mr-3">Kembali</button>
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>