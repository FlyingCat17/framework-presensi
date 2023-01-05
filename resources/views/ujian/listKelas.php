<?php
use App\Models\Ujian;

?>

<div class="page-container">
    <div class="main-content">
        <div class="container">
            <h3 class="font-weight-bold">
                Jadwal
                <?php
                switch ($data['jenis']) {
                    case '1':
                        echo 'Ujian Tengah Semester Ganjil';
                        break;
                    case '2':
                        echo 'Ujian Akhir Semester Ganjil';
                        break;
                    case '3':
                        echo 'Ujian Tengah Semester Genap';
                        break;
                    case '4':
                        echo 'Ujian Akhir Semester Genap';
                        break;
                }
                ?>
            </h3>
            <a href="<?= base_url;?>ujian" class="btn btn-danger mb-2"><span><i class="anticon anticon-left mr-2"></i></span>Jenis Ujian</a>
            <?php
            use Utils\Flasher;

            Flasher::flash();
            ?>
            <?php
            if (!empty($data['kelas'])) {
                foreach ($data['kelas'] as $kelas) {
                    $jadwal = Ujian::where('tb_ujian.id_kelas_ajaran', $kelas['id_kelas_ajaran'])
                        ->where('tb_ujian.jenis_ujian', $data['jenis'])
                        ->select('*, DATE_FORMAT(tb_ujian.date_ujian, \'%d %M %Y\') AS tanggal, DATE_FORMAT(tb_ujian.date_ujian, \'%H:%i\') AS jam')
                        ->join('tb_mapel', 'tb_mapel.id_mapel', 'tb_ujian.id_mapel')
                        ->all();
                    ?>
                    <div class="accordion borderless" id="accordion-borderless<?= $kelas['id_kelas_ajaran'] ?>">
                        <div class="card">
                            <div class="card-header" role="tab">
                                <h5 class="card-title">
                                    <a class="collapsed" data-toggle="collapse"
                                        href="#collapse<?= $kelas['id_kelas_ajaran'] ?>Borderless">
                                        <span>
                                            <?= $kelas['nama_kelas'] ?>
                                        </span>
                                    </a>
                                </h5>
                            </div>
                            <div id="collapse<?= $kelas['id_kelas_ajaran'] ?>Borderless" class="collapse"
                                data-parent="#accordion-borderless<?= $kelas['id_kelas_ajaran'] ?>">
                                <div class="card-body">
                                    <a href="<?= base_url ?>ujian/<?= $data['jenis'] ?>/tambah/<?= $kelas['id_kelas_ajaran'] ?>"
                                        class="btn btn-primary btn-icon d-flex justify-content-center align-items-center my-1 ml-2">
                                        <i class="material-icons">add</i>
                                    </a>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="width: 50px;">No</th>
                                                    <th scope="col" style="width: 150px;">Hari</th>
                                                    <th scope="col">Tanggal Ujian</th>
                                                    <th scope="col">Mata Pelajaran</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                if (!empty($jadwal)) {
                                                    foreach ($jadwal as $listJadwal) {
                                                        ?>
                                                        <tr>
                                                            <th scope="row"><?= $no; ?></th>
                                                            <td>
                                                                <?= $listJadwal['hari'] == 1 ? 'Senin' : ($listJadwal['hari'] == 2 ? 'Selasa' : ($listJadwal['hari'] == 3 ? 'Rabu' : ($listJadwal['hari'] == 4 ? 'Kamis' : ($listJadwal['hari'] == 5 ? 'Jumat' : '')))) ?>
                                                            </td>
                                                            <td>
                                                                <?= $listJadwal['tanggal'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $listJadwal['nama_mapel'] ?>
                                                            </td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button class="btn btn-primary dropdown-toggle"
                                                                        data-toggle="dropdown">
                                                                        <span>Aksi</span>
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item"
                                                                            href="<?= base_url; ?>ujian/<?= $data['jenis'] ?>/ubah/<?= $listJadwal['id_ujian'] ?>">Ubah
                                                                            Jadwal</a>
                                                                        <button type="button" data-toggle="modal"
                                                                            data-target="#exampleModalCenter<?= $kelas['ujian'] ?>"
                                                                            class="dropdown-item text-danger" href="#">Hapus
                                                                            Jadwal</button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <!-- Modal -->
                                                        </tr>
                                                        <form action="<?= base_url; ?>ujian/<?= $data['jenis']?>/hapus/<?= $listJadwal['id_ujian'] ?>"
                                                            method="post">
                                                            <div class="modal fade" id="exampleModalCenter<?= $kelas['id_ujian'] ?>">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Yakin ingin
                                                                                menghapus jadwal ujian ini?
                                                                            </h5>
                                                                            <button type="button" class="close" data-dismiss="modal">
                                                                                <i class="anticon anticon-close"></i>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p class="d-inline">Kelas : </p>
                                                                            <h6 class="d-inline">
                                                                                <?= $kelas['nama_kelas'] ?>
                                                                            </h6>
                                                                            <br>
                                                                            <p class="d-inline">Mata Pelajaran : </p>
                                                                            <h6 class="d-inline"><?= $listJadwal['nama_mapel'] ?></h6>
                                                                            <br>
                                                                            <p class="d-inline">Tanggal Ujian : </p>
                                                                            <h6 class="d-inline">
                                                                                <?= $listJadwal['tanggal'] ?> - <?= $listJadwal['jam'] ?>
                                                                            </h6>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default"
                                                                                data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <?php
                                                        $no++;
                                                    }
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>