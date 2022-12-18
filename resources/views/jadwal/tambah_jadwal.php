<div class="page-container">
    <div class="main-content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="mb-4 font-weight-bold">Tambah Jadwal</h3>
                                </div>
                                <div>
                                    <p class="text-right">Tahun Ajaran</p>
                                    <h5 class="text-right">
                                        <?= $data['tahun_ajaran']->tahun_ajaran ?>
                                    </h5>
                                </div>
                            </div>
                            <?php
                            use Utils\Flasher;

                            Flasher::flash();
                            ?>
                            <form action="<?= base_url; ?>jadwal/tambah" method="post">
                                <div class="form-group">
                                    <label for="inputAddress">Kelas</label>
                                    <select id="inputState" class="form-control" name="get_kelas">
                                        <option selected value="null">Pilih Kelas</option>
                                        <?php
                                        foreach ($data['kelas'] as $kelas):
                                        ?>
                                        <option value="<?= $kelas['id_kelas_ajaran'] ?>">
                                            <?= $kelas['nama_kelas'] ?>
                                        </option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Mata Pelajaran</label>
                                    <select class="form-control" id="inputState" name="get_mapel">
                                        <option value="null" selected>Pilih Mata Pelajaran</option>
                                        <?php foreach ($data['mapel'] as $mapel):
                                        ?>
                                        <option value="<?= $mapel['id_mapel'] ?>">
                                            <?= $mapel['nama_mapel'] ?>
                                        </option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Guru Pengampu</label>
                                    <select class="form-control" id="inputState" name="get_guru">
                                        <option value="null" selected>Pilih Guru</option>
                                        <?php foreach ($data['guru'] as $guru):
                                        ?>
                                        <option value="<?= $guru['nuptk'] ?>">
                                            <?= $guru['nama_guru'] ?>
                                        </option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Hari</label>
                                    <select class="form-control" id="inputState" name="get_hari">
                                        <option value="null" selected>Pilih Hari</option>
                                        <option value="1">Senin</option>
                                        <option value="2">Selasa</option>
                                        <option value="3">Rabu</option>
                                        <option value="4">Kamis</option>
                                        <option value="5">Jumat</option>
                                        <option value="6">Sabtu</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <label for="jam_awal">Jam Awal</label>
                                            <input type="text" class="form-control" id="jam_awal" placeholder="07:00"
                                                name="get_jam_awal">
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <label for="jam_akhir">Jam Akhir</label>
                                            <input type="text" class="form-control" id="jam_akhir" placeholder="09:00"
                                                name="get_jam_akhir">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jamke">Jam-ke</label>
                                    <input type="text" class="form-control" id="jamke" placeholder="2"
                                        name="get_jam_ke">
                                </div>
                                <div class="form-group clearfix">
                                    <button type="submit" class="btn btn-success float-right" name="simpan_jadwal">
                                        Simpan
                                    </button>
                                    <a href="<?= base_url; ?>jadwal" class="btn btn-danger float-right mx-2">
                                        Kembali </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>