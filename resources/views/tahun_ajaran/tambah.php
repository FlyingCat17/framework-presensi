<div class="page-container">
    <div class="main-content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-7">
                    <div>
                        <h2 class="mb-4 font-weight-bold">Tambah Tahun Ajaran Baru</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <p class="mb-3">Masukkan Tahun Ajaran</p>
                                        <?php

                                        use Utils\Flasher;

                                        Flasher::flash();
                                        ?>
                                        <form action="<?= base_url; ?>tahun_ajaran/tambah" method="post">
                                            <div class="form-group">

                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="text" name="new_tahun_ajaran" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="2019/2020">
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" onclick="location.href='<?= base_url; ?>tahun_ajaran';" class="btn btn-danger mr-2">Kembali</button>
                                                    <button type="submit" name="submit_insert" class="btn btn-success">Simpan</button>
                                                </div>
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