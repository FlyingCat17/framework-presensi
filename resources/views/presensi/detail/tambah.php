<div class="page-container">
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-6">
                    <div>
                        <h2 class="mb-4 font-weight-bold">Presensi Siswa</h2>
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
                                            action="<?= base_url; ?>presensi/<?= $data['jadwal']->id_jadwal ?>/detail/<?= $data['presensi']->id_presensi ?>/tambah/<?= $data['siswa']->nis ?>"
                                            method="post" enctype="multipart/form-data">
                                            <div class="form-group mb-3">
                                                <h5 class="d-inline" id="nis-tambah-presensi" data-nis=""><?= $data['siswa']->nis ?></h5>
                                                <h5 class="d-inline"> - </h5>
                                                <h5 class="d-inline" id="nama-tambah-presensi" data-nama><?= $data['siswa']->nama_siswa ?></h5>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputState">Status Kehadiran</label>
                                                <select class="form-control" id="TambahKehadiran" name="kehadiran">
                                                    <option selected value="null">Pilih Status Kehadiran</option>
                                                    <option value="1">Hadir</option>
                                                    <option value="2">Izin</option>
                                                    <option value="3">Sakit</option>
                                                </select>
                                            </div>
                                            <div class="d-none" id="izin">
                                                <div class="form-group">
                                                    <label for="file">Surat / Bukti Izin</label>
                                                    <br>
                                                    <input type="file" name="file" class="file"
                                                        style="visibility: hidden; position: absolute;">
                                                    <div class="input-group my-3">
                                                        <input type="text" class="form-control" disabled
                                                            placeholder="Upload File" id="file">
                                                        <div class="input-group-append">
                                                            <button type="button"
                                                                class="browse btn btn-primary">Browse...</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-danger mr-2"
                                                    id="tutupModalTambahPresensi"
                                                    onclick="location.href='<?= base_url; ?>presensi/<?= $data['jadwal']->id_jadwal ?>/detail/<?= $data['presensi']->id_presensi ?>'">Tutup</button>
                                                <button type="submit" id="btn_save_tambah"
                                                    data-jadwal="<?php // $data['jadwal']->id_jadwal ?>"
                                                    data-idpresensi="<?php // $data['presensi']->id_presensi ?>"
                                                    class="btn btn-success font-weight-bold">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                    <img src="../../../../images/bukti_izin/3357_2_20221225_153835_9.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script src="<?php //base_url; ?>resources/views/presensi/detail/insert.js"></script> -->