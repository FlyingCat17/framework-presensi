<div class="page-container">
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="font-weight-bold text-center">Detail Presensi Siswa</h5>
                            <hr>
                            <div class="d-flex justify-content-center">
                                <div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="text-right" style="width: 180px;">Status</td>
                                                    <td style="width: 350px">
                                                        <?php
                                                        switch ($data['detail']->kehadiran) {
                                                            case '1':
                                                                echo '<span class=" badge badge-success">
                                                                Hadir</span>';
                                                                break;
                                                            case '2':
                                                                echo '<span class=" badge badge-info">
                                                                Izin</span>';
                                                                break;
                                                            case '3':
                                                                echo '<span class=" badge badge-warning">
                                                                Sakit</span>';
                                                                break;
                                                            default:
                                                                echo '<span class=" badge badge-danger">
                                                                Tidak Hadir</span>';
                                                                break;
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" style="width: 120px;">NIS</td>
                                                    <td style="width: 350px">
                                                        <?= $data['detail']->nis ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" style="width: 120px;">Nama Siswa</td>
                                                    <td>
                                                        <?= $data['siswa']->nama_siswa ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" style="width: 120px;">Waktu Presensi</td>
                                                    <td>
                                                        <?= $data['detail']->timestamp ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" style="width: 120px;">Koordinat</td>
                                                    <td>
                                                        <p style="margin-bottom: -4px;">
                                                            <?php
                                                            if (isset($data['detail']->koordinat)) {
                                                                echo $data['detail']->koordinat;
                                                            } else {
                                                                echo 'Koordinat Tidak Tersedia';
                                                            }
                                                            ?>
                                                        </p>
                                                        <?=(isset($data['detail']->koordinat) ? '<a href="https://www.google.com/maps/search/?api=1&query=' . $data['detail']->koordinat . '" target="_blank">Buka di Maps</a>' : '') ?>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" style="width: 120px;">
                                                        <p style="margin-bottom: -4px;">Bukti Izin</p>
                                                        <p>(Jika Izin / Sakit)</p>
                                                    </td>
                                                    <td>
                                                        <?=(isset($data['detail']->bukti_izin) ? 
                                                                '<a href="' . base_url . $data['detail']->bukti_izin . '" target="_blank"><i class="far fa-file mr-2"></i>Download (JPG/PNG/PDF)</a>' : '<p>Tidak Ada File</p>') ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-danger"
                                    onclick="location.href='<?= base_url; ?>presensi/<?= $data['detail']->id_jadwal ?>/detail/<?= $data['detail']->id_presensi ?>'">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>