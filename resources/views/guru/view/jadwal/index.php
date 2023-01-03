<?php
use App\Config\Session;
use App\Models\Jadwal;

?>
<div class="page-container">
    <div class="main-content">
        <div class="container">
            <h3 class="mb-3">Daftar Jadwal - <strong>
                    <?= $data['hari'] ?>
                </strong></h3>
            <a href="<?= base_url; ?>g/jadwal" class="btn btn-danger mb-3"><span><i class="anticon anticon-left mr-2"
                        style="margin-left: -5px;"></i></span>Pilih Hari</a>
            <?php
            if (!empty($data['kelas'])) {
                foreach ($data['kelas'] as $kelas) {
                    $jadwal = Jadwal::where('tb_jadwal.nuptk', Session::get('user'))
                        ->where('tb_tahun_ajaran.id_tahun_ajaran', $kelas['id_tahun_ajaran'])
                        ->where('tb_jadwal.id_kelas_ajaran', $kelas['id_kelas_ajaran'])
                        ->where('tb_jadwal.hari', $data['k_hari'])
                        ->join('tb_kelas_ajaran', 'tb_kelas_ajaran.id_kelas_ajaran', 'tb_jadwal.id_kelas_ajaran')
                        ->join('tb_mapel', 'tb_mapel.id_mapel', 'tb_jadwal.id_mapel')
                        ->join('tb_tahun_ajaran', 'tb_tahun_ajaran.id_tahun_ajaran', 'tb_kelas_ajaran.id_tahun_ajaran')
                        ->orderBy('tb_jadwal.jam_awal', 'asc')
                        ->select('*, DATE_FORMAT(tb_jadwal.jam_awal, \'%H:%i\') as jam_awal_convert, DATE_FORMAT(tb_jadwal.jam_akhir, \'%H:%i\') as jam_akhir_convert')
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
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="width: 50px;">No</th>
                                                    <th scope="col" style="width: 350px;">Mata Pelajaran</th>
                                                    <th scope="col">Pukul</th>
                                                    <th scope="col">Buka Presensi</th>
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
                                                                <?= $listJadwal['nama_mapel'] ?>
                                                            </td>
                                                            <td>
                                                                <?= $listJadwal['jam_awal_convert'] ?> - <?= $listJadwal['jam_akhir_convert'] ?>
                                                            </td>
                                                            <td>
                                                                <a href="<?= base_url; ?>presensi/<?= $listJadwal['id_jadwal'] ?>"
                                                                    class="btn btn-icon btn-primary d-flex justify-content-center align-items-center">
                                                                    <i class="anticon anticon-bars"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $no++;
                                                    }
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                    if (empty($jadwal)) {
                                        echo '<p class="text-center">Tidak Ada Jadwal</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '';
            }
            ?>
        </div>
    </div>
</div>