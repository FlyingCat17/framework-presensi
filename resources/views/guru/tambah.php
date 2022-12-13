<div class="page-container">
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-6">
                    <div>
                        <h2 class="mb-4 font-weight-bold">Tambah Guru</h2>
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
                                        <p>Masukkan Identitas Guru</p>
                                        <form action="<?= base_url; ?>guru/tambah" method="post">
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="anticon anticon-idcard"
                                                            style="font-size: 20px;"></i></span>
                                                </div>
                                                <input type="text" name="nuptk" id="nuptk" class="form-control"
                                                    placeholder="NIP / NUPTK" aria-label="NIS"
                                                    aria-describedby="basic-addon1" required>
                                            </div>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="anticon anticon-user"
                                                            style="font-size: 20px;"></i></span>
                                                </div>
                                                <input type="text" name="nama" id="nama" class="form-control"
                                                    placeholder="Nama Guru" aria-label="Nama Guru"
                                                    aria-describedby="basic-addon1" required>
                                            </div>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="material-icons"
                                                            style="font-size: 20px;">location_city</i></span>
                                                </div>
                                                <input type="text" name="tempat_lahir" id="tempat_lahir"
                                                    class="form-control" placeholder="Tempat Lahir"
                                                    aria-label="Tempat Lahir" aria-describedby="basic-addon1" required>
                                            </div>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="anticon anticon-calendar"
                                                            style="font-size: 20px;"></i></span>
                                                </div>
                                                <input type="text" onkeydown="return false;" name="tgl_lahir"
                                                    id="tgl_lahir" class="form-control datepicker-input"
                                                    placeholder="Tanggal Lahir" required>
                                            </div>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="anticon anticon-home"
                                                            style="font-size: 20px;"></i></span>
                                                </div>
                                                <input type="text" name="alamat" id="alamat" class="form-control"
                                                    placeholder="Alamat Guru" aria-label="Alamat Guru"
                                                    aria-describedby="basic-addon1" required>
                                            </div>

                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="anticon anticon-contacts"
                                                            style="font-size: 20px;"></i></span>
                                                </div>
                                                <input type="text" name="telepon" id="telepon" class="form-control"
                                                    placeholder="Telepon/HP Guru" aria-label="Telepon/HP Guru"
                                                    aria-describedby="basic-addon1" required>
                                            </div>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="material-icons"
                                                            style="font-size: 20px;">label</i></span>
                                                </div>
                                                <input type="text" name="status" id="status" class="form-control"
                                                    placeholder="Status Kepegawaian" aria-label="Status Kepegawaian"
                                                    aria-describedby="basic-addon1" required>
                                            </div>
                                            <div class="d-flex justify-content-end align-items-center">
                                                <button type="button" onclick="location.href='<?= base_url; ?>guru';"
                                                    class="btn btn-danger mr-3">Tutup</button>
                                                <button class="btn btn-success">Simpan</button>
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

<script>
    $('.datepicker-input').datepicker({
        format: 'yyyy-mm-dd'
    });
</script>