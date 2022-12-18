<?php
$jadwal = $data['jadwal'];
?>
<div class="page-container">
    <div class="main-content">
        <div class="container">
            <h2 class="font-weight-bold mb-3">Detail Jadwal</h2>
            <div class="card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-lg-6 col-md-12 col-sm-12 p-2">
                            <div class="ml-2 mb-3">
                                <h6>Kelas</h6>
                                <h3>
                                    <?=(isset($jadwal->nama_kelas) ? $jadwal->nama_kelas : '') ?>
                                </h3>
                            </div>
                            <div class="ml-2 mb-3">
                                <h6>Mata Pelajaran</h6>
                                <h3>
                                    <?=(isset($jadwal->nama_mapel) ? $jadwal->nama_mapel : '') ?>
                                </h3>
                            </div>
                            <div class="ml-2">
                                <h6>Guru Pengampu</h6>
                                <h3>
                                    <?=(isset($jadwal->nama_guru) ? $jadwal->nama_guru : '') ?>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 p-2">
                            <div class="ml-2 mb-3">
                                <h6>Hari</h6>
                                <h3>
                                    <?php
                                    switch ($jadwal->hari) {
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
                                        default:
                                            echo '';
                                            break;
                                    }
                                    ?>
                                </h3>
                            </div>
                            <div class="ml-2 mb-3">
                                <h6>Pukul</h6>
                                <h3 class="d-inline">
                                    <?=(isset($jadwal->jam_awal) ? $jadwal->jam_awal : '') ?>
                                </h3>
                                <h3 class="d-inline"> - </h3>
                                <h3 class="d-inline">
                                    <?=(isset($jadwal->jam_akhir) ? $jadwal->jam_akhir : '') ?>
                                </h3>
                            </div>
                            <div class="ml-2 mb-3">
                                <h6>Jam-ke</h6>
                                <h3>
                                    <?=(isset($jadwal->jam_ke) ? $jadwal->jam_ke : '') ?>
                                </h3>
                            </div>
                            <div class="d-flex justify-content-end mr-2">
                                <button type="button" class="btn btn-danger mr-3"
                                    onclick="location.href='<?= base_url ?>jadwal'">Kembali</button>
                                <button type="button" class="btn btn-warning">Ubah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>