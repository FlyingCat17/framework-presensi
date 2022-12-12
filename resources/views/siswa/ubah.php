<div class="page-container">
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-6">
                    <div>
                        <h2 class="mb-4 font-weight-bold">Ubah Siswa</h2>
                    </div>
                    <?php
                    $siswa = $data['siswa'];
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <?php

                                        use Utils\Flasher;

                                        Flasher::flash();
                                        ?>
                                        <p class="mb-3">Identitas Siswa</p>
                                        <form id="form-validate" action="<?= base_url; ?>siswa/ubah/<?= $siswa->nis; ?>" method="post">
                                            <!-- NIS -->
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="anticon anticon-idcard" style="font-size: 20px;"></i></span>
                                                </div>
                                                <input type="text" id="txt_nis" name="nis" class="form-control" placeholder="Nomor Induk Siswa" aria-label="NIS" aria-describedby="basic-addon1" value="<?= $siswa->nis; ?>">
                                            </div>
                                            <!-- NAMA -->
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="anticon anticon-user" style="font-size: 20px;"></i></span>
                                                </div>
                                                <input type="text" id="txt_nama" name="nama" class="form-control" placeholder="Nama Siswa" aria-label="Nama Siswa" aria-describedby="basic-addon1" value="<?= $siswa->nama_siswa; ?>">
                                            </div>

                                            <!-- ALAMAT -->
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="anticon anticon-home" style="font-size: 20px;"></i></span>
                                                </div>
                                                <textarea id="txt_alamat" name="alamat" class="form-control" placeholder="Alamat Siswa" aria-label="Alamat Siswa" aria-describedby="basic-addon1" rows="2"><?= $siswa->alamat_siswa; ?></textarea>
                                            </div>
                                            <!-- NO TELPON -->
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="anticon anticon-contacts" style="font-size: 20px;"></i></span>
                                                </div>
                                                <input type="text" id="txt_telepon" name="telepon" class="form-control" placeholder="Telepon/HP Siswa" aria-label="Telepon/HP Siswa" aria-describedby="basic-addon1" value="<?= $siswa->notelp_siswa; ?>">
                                            </div>
                                            <!-- JENIS KELAMIN -->
                                            <label for="radio" class="mr-3">Jenis Kelamin</label>
                                            <div class="d-flex align-items-center justify-content-center input-group mb-2 mt-1">
                                                <div class="radio mr-3">
                                                    <input type="radio" name="jk" id="gridRadios1" value="L" <?= ($siswa->jenis_kelamin == "L" ? 'checked' : '') ?>>
                                                    <label for="gridRadios1">
                                                        Laki-Laki
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <input type="radio" name="jk" id="gridRadios2" value="P" <?= ($siswa->jenis_kelamin == "P" ? 'checked' : '') ?>>
                                                    <label for="gridRadios2">
                                                        Perempuan
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- TEMPAT LAHIR -->
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="material-icons" style="font-size: 20px;">location_city</i></span>
                                                </div>
                                                <input type="text" id="txt_tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" aria-describedby="basic-addon1" value="<?= $siswa->tempat_lahir; ?>">
                                            </div>
                                            <!-- TANGGAL LAHIR -->
                                            <div class="form-group">
                                                <label>Tanggal Lahir</label>
                                                <div class="input-affix m-b-10">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="anticon anticon-contacts" style="font-size: 20px;"></i></span>
                                                    </div>
                                                    <input type="text" name="tgl_lahir" class="form-control datepicker-input pl-3" placeholder="Pick a date" value="<?= $siswa->tanggal_lahir; ?>">
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-danger text-white mr-2" onclick="location.href='<?= base_url; ?>siswa'">Tutup</button>
                                                <button type="submit" name="submit_ubah" class="btn btn-success">Simpan</button>
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
        <!-- Content Wrapper END -->
    </div>
</div>

<script>
    $(document).ready(function() {

        $('.datepicker-input').datepicker({
            format: 'yyyy-mm-dd'
        });

    });
</script>