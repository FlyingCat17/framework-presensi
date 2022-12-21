<script type="text/javascript" src="<?= base_url; ?>resources/views/jadwal/index.js"></script>
<div class="page-container">
  <div class="main-content">
    <div class="container-fluid">
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
                class="btn btn-success mb-3" id="tambah_jadwal"><span><i class="anticon anticon-plus"
                    style="margin-left: -5px;"></i></span>
                Tambah</button>
              <?php
              use Utils\Flasher;

              Flasher::flash();
              ?>
              <div class="mt-4">
                <div class="table-responsive">
                  <table class="table" style="overflow: auto;">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 5px;">No</th>
                        <th scope="col">Kelas</th>
                        <th scope="col" style="">Mata Pelajaran</th>
                        <th scope="col" style="width: 250px;">Guru</th>
                        <th scope="col" style="">Hari</th>
                        <th scope="col" style="width: 30px;">Jam</th>
                        <th scope="col" style="width: 130px;">Pukul</th>
                        <th scope="col" style=""></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      $no = 1;
                      $kelas = $data['kelas']->id_kelas_ajaran;
                      if (!empty($data['jadwal'])) {
                        foreach ($data['jadwal'] as $jadwal): ?>
                      <tr>
                        <td scope="row">
                          <?= $no ?>
                        </td>
                        <td>
                          <?= $jadwal['nama_kelas'] ?>
                        </td>
                        <td>
                          <?= $jadwal['nama_mapel'] ?>
                        </td>
                        <td>
                          <?= $jadwal['nama_guru'] ?>
                        </td>
                        <td>
                          <?php
                          switch ($jadwal['hari']) {
                            case 1:
                              echo 'Senin';
                              break;
                            case 2:
                              echo 'Selasa';
                              break;
                            case 3:
                              echo 'Rabu';
                              break;
                            case 4:
                              echo 'Kamis';
                              break;
                            case 5:
                              echo 'Jumat';
                              break;
                            case 6:
                              echo 'Sabtu';
                              break;
                          }
                          ?>
                        </td>
                        <td>
                          <?= $jadwal['jam_ke'] ?>
                        </td>
                        <td>
                          <?= $jadwal['jam_awal'] ?> - <?= $jadwal['jam_akhir'] ?>
                        </td>
                        <td>
                          <button type="button" class="btn btn-success align-items-center m-1"
                            onclick="location.href='<?= base_url; ?>presensi/<?= $jadwal['id_jadwal'] ?>'"
                            data-toggle="tooltip" data-placement="top" title="Presensi"
                            data-id="<?= $jadwal['id_jadwal'] ?>" style="width: 20px;"><i class="far fa-folder-open"
                              style="font-size: 12px; margin-left: -5px;"></i></button>
                          <!-- <button class="btn btn-warning"><i class="far fa-edit"></i></button> -->
                          <button type="button"
                            onclick="location.href='<?= base_url; ?>jadwal/kelas/<?= $kelas ?>/ubah/<?= $jadwal['id_jadwal'] ?>'"
                            class="btn btn-warning edit_jadwal m-1" data-toggle="tooltip" data-placement="top"
                            title="Ubah Jadwal" style="width: 30px;" data-id="<?= $jadwal['id_jadwal'] ?>"><i
                              class="far fa-edit" style="margin-left: -5px;"></i></button>
                          <button class="btn btn-danger m-1 tampilModalHapus" data-toggle="modal"
                            data-target="#hapus_jadwal" data-id="<?= $jadwal['id_jadwal'] ?>"
                            data-kelas="<?= $jadwal['nama_kelas'] ?>"
                            data-idkelasajaran="<?= $jadwal['id_kelas_ajaran'] ?>"
                            data-guru="<?= $jadwal['nama_guru'] ?>"
                            data-jam="<?= $jadwal['jam_awal'] . ' - ' . $jadwal['jam_akhir'] ?>"
                            data-hari="<?=($jadwal['hari'] == 1 ? 'Senin' : ($jadwal['hari'] == 2 ? 'Selasa' : ($jadwal['hari'] == 3 ? 'Rabu' : ($jadwal['hari'] == 4 ? 'Kamis' : ($jadwal['hari'] == 5 ? 'Jumat' : ($jadwal['hari'] == 6 ? 'Sabtu' : '')))))) ?>"
                            data-mapel="<?= $jadwal['nama_mapel'] ?>" style="width: 30px;"><i class="far fa-trash-alt"
                              style="margin-left: -5px;"></i></button>
                        </td>
                      </tr>
                      <?php
                          $no++;
                        endforeach;
                      } else {
                        echo '';
                      }
                      ?>
                    </tbody>
                  </table>
                  <?php
                  if (empty($data['jadwal'])) {
                  ?>
                  <p class="text-center">Tidak Ada Data</p>
                  <?php
                  }
                  ?>
                </div>
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