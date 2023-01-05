<div class="page-container">
    <div class="main-content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="mb-4 font-weight-bold">Ubah Jadwal</h3>
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
                            <form
                                action="<?= base_url; ?>jadwal/kelas/<?= $data['check_kelas']->id_kelas_ajaran ?>/ubah/<?= $data['jadwal']->id_jadwal ?>"
                                method="post">
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <input type="text" class="form-control"
                                        value="<?= $data['check_kelas']->nama_kelas ?>" disabled>
                                    <input type="hidden" name="get_kelas"
                                        value="<?= $data['check_kelas']->id_kelas_ajaran ?>">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Mata Pelajaran</label>
                                    <select class="form-control" id="inputState" name="get_mapel">
                                        <option value="null" selected>Pilih Mata Pelajaran</option>
                                        <?php foreach ($data['mapel'] as $mapel):
                                        ?>
                                        <option value="<?= $mapel['id_mapel'] ?>"
                                            <?=($data['jadwal']->id_mapel==$mapel['id_mapel']) ? 'selected' : '' ?>><?=
                                                $mapel['nama_mapel'] ?>
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
                                        <option value="<?= $guru['nuptk'] ?>"
                                            <?=($data['jadwal']->nuptk==$guru['nuptk']) ? 'selected' : '' ?>><?=
                                                $guru['nama_guru'] ?>
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
                                        <option value="1" <?=($data['jadwal']->hari==1) ? 'selected' : '' ?>>Senin
                                        </option>
                                        <option value="2" <?=($data['jadwal']->hari==2) ? 'selected' : '' ?>>Selasa
                                        </option>
                                        <option value="3" <?=($data['jadwal']->hari==3) ? 'selected' : '' ?>>Rabu
                                        </option>
                                        <option value="4" <?=($data['jadwal']->hari==4) ? 'selected' : '' ?>>Kamis
                                        </option>
                                        <option value="5" <?=($data['jadwal']->hari==5) ? 'selected' : '' ?>>Jumat
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <label for="jam_awal">Jam Awal</label>
                                            <input type="text" class="form-control" id="jam_awal" placeholder="07:00"
                                                name="get_jam_awal" value="<?= $data['jadwal']->jam_awal ?>">
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <label for="jam_akhir">Jam Akhir</label>
                                            <input type="text" class="form-control" id="jam_akhir" placeholder="09:00"
                                                name="get_jam_akhir" value="<?= $data['jadwal']->jam_akhir ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jamke">Jam-ke</label>
                                    <input type="text" class="form-control" id="jamke" placeholder="2" name="get_jam_ke"
                                        value="<?= $data['jadwal']->jam_ke ?>">
                                    <input type="hidden" name="id_jadwal" value="<?= $data['jadwal']->id_jadwal ?>">
                                </div>
                                <div class="form-group clearfix">
                                    <button type="submit" class="btn btn-success float-right" name="simpan_jadwal">
                                        Simpan
                                    </button>
                                    <a href="<?= base_url; ?>jadwal/kelas/<?= $data['jadwal']->id_kelas_ajaran ?>"
                                        class="btn btn-danger float-right mx-2">
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