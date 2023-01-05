<div class="page-container">
    <div class="main-content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-6">
                    <div>
                        <h2 class="mb-3 font-weight-bold">Tambah Jadwal Ujian</h2>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <?php
                            use Utils\Flasher;

                            Flasher::flash();

                            ?>
                            <form
                                action="<?= base_url; ?>ujian/<?= $data['jenis'] ?>/tambah/<?= $data['kelas']->id_kelas_ajaran ?>"
                                method="post">
                                <div class="form-group">
                                    <label for="jenis">Jenis Ujian</label>
                                    <input type="hidden" name="jenis_ujian" value="<?= $data['jenis'] ?>">
                                    <input type="text" class="form-control"
                                        value="<?=($data['jenis'] == '1' ? 'Ujian Tengah Semester - Ganjil' : ($data['jenis'] == '2' ? 'Ujian Akhir Semester - Ganjil' : ($data['jenis'] == '3' ? 'Ujian Tengah Semester - Genap' : ($data['jenis'] == '4' ? 'Ujian Akhir Semester - Genap' : '')))) ?>"
                                        disabled="">
                                </div>
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <input type="text" class="form-control" value="<?= $data['kelas']->nama_kelas ?>"
                                        disabled="">
                                </div>
                                <div class="form-group">
                                    <label for="">Mata Pelajaran</label>
                                    <select name="mapel" id="mapel" class="form-control">
                                        <option value="" disabled selected>Pilih Mata Pelajaran</option>
                                        <?php
                                        if (!empty($data['mapel'])) {
                                            foreach ($data['mapel'] as $mapel) {
                                                ?>
                                                <option value="<?= $mapel['id_mapel'] ?>">
                                                    <?= $mapel['nama_mapel'] ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Hari</label>
                                    <select name="hari" id="hari" class="form-control">
                                        <option value="null">Pilih Hari</option>
                                        <option value="1">Senin</option>
                                        <option value="2">Selasa</option>
                                        <option value="3">Rabu</option>
                                        <option value="4">Kamis</option>
                                        <option value="5">Jumat</option>
                                    </select>
                                </div>
                                <div class="form-group mt-4">
                                    <h6>Tanggal Ujian</h6>
                                    <div class="row mt-3 mb-3">
                                        <div class="col-lg-6 col-sm-12">
                                            <label for="date-start">Tanggal</label>
                                            <input type="text" name="date_start"
                                                class="form-control bg-white date-local"
                                                style="border: 1px solid #C9C9C9;">
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <label for="time-start">Jam</label>
                                            <input type="text" name="time_start"
                                                value=" <?= $data['jadwal']->jam_awal_convert ?>"
                                                class="form-control bg-white time-local"
                                                style="border: 1px solid #C9C9C9;">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="<?= base_url ?>ujian/<?= $data['jenis'] ?>"
                                        class="btn btn-danger mr-3">Kembali</a>
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