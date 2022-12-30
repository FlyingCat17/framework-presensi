<script type="text/javascript" src="<?= base_url; ?>resources/views/jadwal/index.js"></script>
<div class="page-container">
  <div class="main-content">
    <div class="container">
      <div class="mb-2 ml-3">
        <h1 class="font-weight-bold">Jadwal Kelas</h1>
        <h3>
          <?= $data['kelas']->nama_kelas ?>
        </h3>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <button type="button"
                onclick="location.href='<?= base_url; ?>jadwal/kelas/<?= $data['kelas']->id_kelas_ajaran ?>/tambah'"
                class="btn btn-success" id="tambah_jadwal"><span><i class="anticon anticon-plus"
                    style="margin-left: -5px;"></i></span>
                Tambah</button>
              <button type="button" onclick="location.href='<?= base_url; ?>jadwal/'" class="btn btn-danger"
                id="tambah_jadwal"><span><i class="anticon anticon-left" style="margin-left: -5px;"></i></i></span>
                Pilih Kelas</button>
              <?php
              use Utils\Flasher;

              Flasher::flash();
              ?>
              
            </div>
          </div>
        </div>
      </div>
      <div class="accordion" id="accordion-default">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">
              <a data-toggle="collapse" class="collapsed" href="#senin">
                <span class="font-weight-bold">Senin</span>
              </a>
            </h5>
          </div>
          <div id="senin" class="collapse" data-parent="#accordion-default">
            <div class="card-body">
              <div class="table-responsive mb-5">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" style="width: 50px;">No</th>
                      <th scope="col" style="width: 230px;">Mata Pelajaran</th>
                      <th scope="col" style="width: 300px;">Guru</th>
                      <th scope="col">Pukul</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    if (!empty($data['jadwalSenin'])) {
                      foreach ($data['jadwalSenin'] as $jadwal) {
                        ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td>
                            <?= $jadwal['nama_mapel']; ?>
                          </td>
                          <td><?= $jadwal['nama_guru']; ?></td>
                          <td>
                            <?= $jadwal['jam_awal'] ?> - <?= $jadwal['jam_akhir'] ?>
                          </td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle bg-primary text-white" data-toggle="dropdown">
                                <span>Opsi</span>
                              </button>
                              <div class="dropdown-menu">
                                <button class="dropdown-item"
                                  onclick="location.href='<?= base_url; ?>presensi/<?= $jadwal['id_jadwal'] ?>'">Buka
                                  Presensi</button>
                                <button type="button" class="dropdown-item"
                                  onclick="location.href='<?= base_url; ?>jadwal/kelas/<?= $kelas ?>/ubah/<?= $jadwal['id_jadwal'] ?>'">Ubah
                                  Jadwal</button>
                                <a class="dropdown-item tampilModalHapus text-danger" href="#hapus_jadwal"
                                  data-toggle="modal" data-target="#hapus_jadwal" data-id="<?= $jadwal['id_jadwal'] ?>"
                                  data-kelas="<?= $jadwal['nama_kelas'] ?>"
                                  data-idkelasajaran="<?= $jadwal['id_kelas_ajaran'] ?>"
                                  data-guru="<?= $jadwal['nama_guru'] ?>"
                                  data-jam="<?= $jadwal['jam_awal'] . ' - ' . $jadwal['jam_akhir'] ?>"
                                  data-hari="<?=($jadwal['hari'] == 1 ? 'Senin' : ($jadwal['hari'] == 2 ? 'Selasa' : ($jadwal['hari'] == 3 ? 'Rabu' : ($jadwal['hari'] == 4 ? 'Kamis' : ($jadwal['hari'] == 5 ? 'Jumat' : ($jadwal['hari'] == 6 ? 'Sabtu' : '')))))) ?>"
                                  data-mapel="<?= $jadwal['nama_mapel'] ?>">Hapus Jadwal</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <?php
                        $no++;
                      }
                    } else {
                      echo '';
                    }
                    ?>
                  </tbody>
                </table>
                <?=(empty($data['jadwalSenin']) ? '<p class="text-center">Tidak Ada Jadwal</p>' : '') ?>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">
              <a class="collapsed" data-toggle="collapse" href="#selasa">
                <span class="font-weight-bold">Selasa</span>
              </a>
            </h5>
          </div>
          <div id="selasa" class="collapse" data-parent="#accordion-default">
            <div class="card-body">
              <div class="table-responsive mb-5">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" style="width: 50px;">No</th>
                      <th scope="col" style="width: 230px;">Mata Pelajaran</th>
                      <th scope="col" style="width: 300px;">Guru</th>
                      <th scope="col">Pukul</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    if (!empty($data['jadwalSelasa'])) {
                      foreach ($data['jadwalSelasa'] as $jadwal) {
                        ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td>
                            <?= $jadwal['nama_mapel']; ?>
                          </td>
                          <td><?= $jadwal['nama_guru']; ?></td>
                          <td>
                            <?= $jadwal['jam_awal'] ?> - <?= $jadwal['jam_akhir'] ?>
                          </td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle bg-primary text-white" data-toggle="dropdown">
                                <span>Opsi</span>
                              </button>
                              <div class="dropdown-menu">
                                <button class="dropdown-item"
                                  onclick="location.href='<?= base_url; ?>presensi/<?= $jadwal['id_jadwal'] ?>'">Buka
                                  Presensi</button>
                                <button type="button" class="dropdown-item"
                                  onclick="location.href='<?= base_url; ?>jadwal/kelas/<?= $kelas ?>/ubah/<?= $jadwal['id_jadwal'] ?>'">Ubah
                                  Jadwal</button>
                                <a class="dropdown-item tampilModalHapus text-danger" href="#hapus_jadwal"
                                  data-toggle="modal" data-target="#hapus_jadwal" data-id="<?= $jadwal['id_jadwal'] ?>"
                                  data-kelas="<?= $jadwal['nama_kelas'] ?>"
                                  data-idkelasajaran="<?= $jadwal['id_kelas_ajaran'] ?>"
                                  data-guru="<?= $jadwal['nama_guru'] ?>"
                                  data-jam="<?= $jadwal['jam_awal'] . ' - ' . $jadwal['jam_akhir'] ?>"
                                  data-hari="<?=($jadwal['hari'] == 1 ? 'Senin' : ($jadwal['hari'] == 2 ? 'Selasa' : ($jadwal['hari'] == 3 ? 'Rabu' : ($jadwal['hari'] == 4 ? 'Kamis' : ($jadwal['hari'] == 5 ? 'Jumat' : ($jadwal['hari'] == 6 ? 'Sabtu' : '')))))) ?>"
                                  data-mapel="<?= $jadwal['nama_mapel'] ?>">Hapus Jadwal</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <?php
                        $no++;
                      }
                    } else {
                      echo '';
                    }
                    ?>
                  </tbody>
                </table>
                <?=(empty($data['jadwalSelasa']) ? '<p class="text-center">Tidak Ada Jadwal</p>' : '') ?>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">
              <a class="collapsed" data-toggle="collapse" href="#rabu">
                <span class="font-weight-bold">Rabu</span>
              </a>
            </h5>
          </div>
          <div id="rabu" class="collapse" data-parent="#accordion-default">
            <div class="card-body">
              <div class="table-responsive mb-5">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" style="width: 50px;">No</th>
                      <th scope="col" style="width: 230px;">Mata Pelajaran</th>
                      <th scope="col" style="width: 300px;">Guru</th>
                      <th scope="col">Pukul</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    if (!empty($data['jadwalRabu'])) {
                      foreach ($data['jadwalRabu'] as $jadwal) {
                        ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td>
                            <?= $jadwal['nama_mapel']; ?>
                          </td>
                          <td><?= $jadwal['nama_guru']; ?></td>
                          <td>
                            <?= $jadwal['jam_awal'] ?> - <?= $jadwal['jam_akhir'] ?>
                          </td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle bg-primary text-white" data-toggle="dropdown">
                                <span>Opsi</span>
                              </button>
                              <div class="dropdown-menu">
                                <button class="dropdown-item"
                                  onclick="location.href='<?= base_url; ?>presensi/<?= $jadwal['id_jadwal'] ?>'">Buka
                                  Presensi</button>
                                <button type="button" class="dropdown-item"
                                  onclick="location.href='<?= base_url; ?>jadwal/kelas/<?= $kelas ?>/ubah/<?= $jadwal['id_jadwal'] ?>'">Ubah
                                  Jadwal</button>
                                <a class="dropdown-item tampilModalHapus text-danger" href="#hapus_jadwal"
                                  data-toggle="modal" data-target="#hapus_jadwal" data-id="<?= $jadwal['id_jadwal'] ?>"
                                  data-kelas="<?= $jadwal['nama_kelas'] ?>"
                                  data-idkelasajaran="<?= $jadwal['id_kelas_ajaran'] ?>"
                                  data-guru="<?= $jadwal['nama_guru'] ?>"
                                  data-jam="<?= $jadwal['jam_awal'] . ' - ' . $jadwal['jam_akhir'] ?>"
                                  data-hari="<?=($jadwal['hari'] == 1 ? 'Senin' : ($jadwal['hari'] == 2 ? 'Selasa' : ($jadwal['hari'] == 3 ? 'Rabu' : ($jadwal['hari'] == 4 ? 'Kamis' : ($jadwal['hari'] == 5 ? 'Jumat' : ($jadwal['hari'] == 6 ? 'Sabtu' : '')))))) ?>"
                                  data-mapel="<?= $jadwal['nama_mapel'] ?>">Hapus Jadwal</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <?php
                        $no++;
                      }
                    } else {
                      echo '';
                    }
                    ?>
                  </tbody>
                </table>
                <?=(empty($data['jadwalRabu']) ? '<p class="text-center">Tidak Ada Jadwal</p>' : '') ?>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">
              <a class="collapsed" data-toggle="collapse" href="#kamis">
                <span class="font-weight-bold">Kamis</span>
              </a>
            </h5>
          </div>
          <div id="kamis" class="collapse" data-parent="#accordion-default">
            <div class="card-body">
              <div class="table-responsive mb-5">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" style="width: 50px;">No</th>
                      <th scope="col" style="width: 230px;">Mata Pelajaran</th>
                      <th scope="col" style="width: 300px;">Guru</th>
                      <th scope="col">Pukul</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    if (!empty($data['jadwalKamis'])) {
                      foreach ($data['jadwalKamis'] as $jadwal) {
                        ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td>
                            <?= $jadwal['nama_mapel']; ?>
                          </td>
                          <td><?= $jadwal['nama_guru']; ?></td>
                          <td>
                            <?= $jadwal['jam_awal'] ?> - <?= $jadwal['jam_akhir'] ?>
                          </td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle bg-primary text-white" data-toggle="dropdown">
                                <span>Opsi</span>
                              </button>
                              <div class="dropdown-menu">
                                <button class="dropdown-item"
                                  onclick="location.href='<?= base_url; ?>presensi/<?= $jadwal['id_jadwal'] ?>'">Buka
                                  Presensi</button>
                                <button type="button" class="dropdown-item"
                                  onclick="location.href='<?= base_url; ?>jadwal/kelas/<?= $kelas ?>/ubah/<?= $jadwal['id_jadwal'] ?>'">Ubah
                                  Jadwal</button>
                                <a class="dropdown-item tampilModalHapus text-danger" href="#hapus_jadwal"
                                  data-toggle="modal" data-target="#hapus_jadwal" data-id="<?= $jadwal['id_jadwal'] ?>"
                                  data-kelas="<?= $jadwal['nama_kelas'] ?>"
                                  data-idkelasajaran="<?= $jadwal['id_kelas_ajaran'] ?>"
                                  data-guru="<?= $jadwal['nama_guru'] ?>"
                                  data-jam="<?= $jadwal['jam_awal'] . ' - ' . $jadwal['jam_akhir'] ?>"
                                  data-hari="<?=($jadwal['hari'] == 1 ? 'Senin' : ($jadwal['hari'] == 2 ? 'Selasa' : ($jadwal['hari'] == 3 ? 'Rabu' : ($jadwal['hari'] == 4 ? 'Kamis' : ($jadwal['hari'] == 5 ? 'Jumat' : ($jadwal['hari'] == 6 ? 'Sabtu' : '')))))) ?>"
                                  data-mapel="<?= $jadwal['nama_mapel'] ?>">Hapus Jadwal</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <?php
                        $no++;
                      }
                    } else {
                      echo '';
                    }
                    ?>
                  </tbody>
                </table>
                <?=(empty($data['jadwalKamis']) ? '<p class="text-center">Tidak Ada Jadwal</p>' : '') ?>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">
              <a class="collapsed" data-toggle="collapse" href="#jumat">
                <span class="font-weight-bold">Jumat</span>
              </a>
            </h5>
          </div>
          <div id="jumat" class="collapse" data-parent="#accordion-default">
            <div class="card-body">
              <div class="table-responsive mb-5">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" style="width: 50px;">No</th>
                      <th scope="col" style="width: 230px;">Mata Pelajaran</th>
                      <th scope="col" style="width: 300px;">Guru</th>
                      <th scope="col">Pukul</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    if (!empty($data['jadwalJumat'])) {
                      foreach ($data['jadwalJumat'] as $jadwal) {
                        ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td>
                            <?= $jadwal['nama_mapel']; ?>
                          </td>
                          <td><?= $jadwal['nama_guru']; ?></td>
                          <td>
                            <?= $jadwal['jam_awal'] ?> - <?= $jadwal['jam_akhir'] ?>
                          </td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle bg-primary text-white" data-toggle="dropdown">
                                <span>Opsi</span>
                              </button>
                              <div class="dropdown-menu">
                                <button class="dropdown-item"
                                  onclick="location.href='<?= base_url; ?>presensi/<?= $jadwal['id_jadwal'] ?>'">Buka
                                  Presensi</button>
                                <button type="button" class="dropdown-item"
                                  onclick="location.href='<?= base_url; ?>jadwal/kelas/<?= $kelas ?>/ubah/<?= $jadwal['id_jadwal'] ?>'">Ubah
                                  Jadwal</button>
                                <a class="dropdown-item tampilModalHapus text-danger" href="#hapus_jadwal"
                                  data-toggle="modal" data-target="#hapus_jadwal" data-id="<?= $jadwal['id_jadwal'] ?>"
                                  data-kelas="<?= $jadwal['nama_kelas'] ?>"
                                  data-idkelasajaran="<?= $jadwal['id_kelas_ajaran'] ?>"
                                  data-guru="<?= $jadwal['nama_guru'] ?>"
                                  data-jam="<?= $jadwal['jam_awal'] . ' - ' . $jadwal['jam_akhir'] ?>"
                                  data-hari="<?=($jadwal['hari'] == 1 ? 'Senin' : ($jadwal['hari'] == 2 ? 'Selasa' : ($jadwal['hari'] == 3 ? 'Rabu' : ($jadwal['hari'] == 4 ? 'Kamis' : ($jadwal['hari'] == 5 ? 'Jumat' : ($jadwal['hari'] == 6 ? 'Sabtu' : '')))))) ?>"
                                  data-mapel="<?= $jadwal['nama_mapel'] ?>">Hapus Jadwal</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <?php
                        $no++;
                      }
                    } else {
                      echo '';
                    }
                    ?>
                  </tbody>
                </table>
                <?=(empty($data['jadwalJumat']) ? '<p class="text-center">Tidak Ada Jadwal</p>' : '') ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="hapus_jadwal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Jadwal</h5>
        <button type="button" class="close" data-dismiss="modal">
          <i class="anticon anticon-close"></i>
        </button>
      </div>
      <form action="<?= base_url; ?>" method="POST" id="form_hapus">
        <div class="modal-body">
          <div class="mb-3">
            <h6>Yakin ingin menghapus jadwal ini?</h6>
            <input type="hidden" name="hapus_id" id="hapus_id" value="">
            <p class="d-inline" id="hapus_kelas">X 1</p><span> - </span>
            <p class="d-inline" id="hapus_mapel">Bahasa Jepang</p><span> - </span>
            <p class="d-inline" id="hapus_guru">Syamsul Arifin, S.Kom, M.Cs</p>
            <div></div>
            <p class="d-inline" id="hapus_hari">Senin</p><span id="hapus_jam"> - (07:00 - 08:00)</span>
          </div>
          <div class="alert alert-danger">
            <strong>PERHATIAN! </strong>JIka menghapus jadwal ini, maka seluruh presensi yang ada pada jadwal ini akan
            otomatis terhapus!
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn text-danger" data-dismiss="modal">Tutup</button>
          <button type="submit" name="submit_hapus" class="btn btn-danger">Hapus</button>
      </form>
    </div>
  </div>
</div>
</div>