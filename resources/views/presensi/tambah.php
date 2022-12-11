<div class="page-container">
    <div class="main-content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="mb-4 font-weight-bold">Tambah Presensi</h3>
                                </div>
                                <div>
                                    <p class="text-right">ID Jadwal</p>
                                    <p class="text-right font-weight-bold" style="margin-top: -10px;"><?= $data['id_jadwal'] ?></p>
                                    <!-- <h5 class="text-right"><?= $data['tahun_ajaran']->tahun_ajaran ?></h5> -->
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <label for="">Kelas</label>
                                <input type="text" class="form-control" placeholder="Kelas" disabled="" value="<?= $data['jadwal']->nama_kelas ?>">
                            </div>
                            <div class="form-group mt-4">
                                <label for="">Mata Pelajaran</label>
                                <input type="text" class="form-control" placeholder="Mata Pelajaran" disabled="" value="<?= $data['jadwal']->nama_mapel ?>">
                            </div>
                            <div class="form-group mt-4">
                                <label for="">Guru Pengampu</label>
                                <input type="text" class="form-control" placeholder="Guru" disabled="" value="<?= $data['jadwal']->nama_guru ?>">
                            </div>
                            <div class="form-group mt-4">
                                <label for="">Hari</label>
                                <input type="text" class="form-control" placeholder="Hari" disabled="" value="<?= ($data['jadwal']->hari == 1 ? 'Senin' : ($data['jadwal']->hari == 2 ? 'Selasa' : ($data['jadwal']->hari == 3 ? 'Rabu' : ($data['jadwal']->hari == 4 ? 'Kamis' : ($data['jadwal']->hari == 5 ? 'Jumat' : ($data['jadwal']->hari == 6 ? 'Jumat' : '')))))) ?>">
                            </div>
                            <form action="<?= base_url; ?>presensi/tambah_presensi_act" method="post">
                                <div class="form-group mt-4">
                                    <h6>Mulai Presensi</h6>
                                    <div class="row mt-3 mb-3">
                                        <div class="col-lg-6 col-sm-12">
                                            <label for="date-start">Tanggal</label>
                                            <input type="text" name="date-start" class="form-control bg-white date-local" style="border: 1px solid #C9C9C9;">
                                            <input type="hidden" name="id_jadwal" value="<?= $data['id_jadwal'] ?>">
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <label for="time-start">Jam</label>
                                            <input type="text" name="time-start" value=" <?= $data['get_jam']->mulai ?>" class="form-control bg-white time-local" style="border: 1px solid #C9C9C9;">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group mt-4">
                                    <h6>Batas Presensi</h6>
                                    <div class="row mt-3 mb-3">
                                        <div class="col-lg-6 col-sm-12">
                                            <label for="date-start">Tanggal</label>
                                            <input type="text" name="date-end" class="form-control bg-white date-local" style="border: 1px solid #C9C9C9;">
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <label for="time-start">Jam</label>
                                            <input type="text" name="time-end" value=" <?= $data['get_jam']->akhir ?>" class="form-control bg-white time-local" style="border: 1px solid #C9C9C9;">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end align-items-end">
                                    <a href="#" class="btn btn-danger mt-3 mr-3">Kembali</a>
                                    <button type="submit" class="btn btn-success mt-3" name="simpan">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    config_time = {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i"
    }
    flatpickr('.time-local', config_time);
    config_date = {
        dateFormat: "Y-m-d"
    }
    flatpickr('.date-local', config_date);
</script>