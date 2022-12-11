<div class="page-container">
    <div class="main-content">
        <div class="container-fluid">
            <h1 class="mb-4 font-weight-bold">Presensi</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-lg-8 col-sm-12">
                                    <div class="d-flex justify-content-start align-items-start">

                                        <h6 class="d-inline">ID Jadwal : </h6>
                                        <h6 class="d-inline"><?= $data['id_jadwal'] ?></h6>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="d-flex justify-content-end align-items-center">
                                        <h5 class="font-weight-bold text-right"><?= $data['jadwal']->nama_guru ?></h5>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center">
                                        <h6 class="d-inline"><?= $data['jadwal']->nama_kelas ?></h6>
                                        <p class="d-inline"> - </p>
                                        <h6 class="d-inline"><?= $data['jadwal']->nama_mapel ?></h6>
                                    </div>
                                </div>
                            </div>
                            <?php Flasher::flash(); ?>
                            <div class="mb-4"></div>
                            <div class="d-flex justify-content-between align-items-end">
                                <div>
                                    <a href="<?= base_url ?>" class="btn btn-success mb-3 tambah_presensi" data-id="<?= $data['id_jadwal'] ?>"><i class="anticon anticon-plus" style="margin-left: -5px;"></i> Presensi</a>
                                    <a href="#" class="btn btn-danger mb-3"><i class="anticon anticon-file-pdf" style="margin-left: -5px;"></i> Rekap Presensi</a>
                                </div>
                                <p>Jumlah Siswa : <span><?= $data['kelas']->jumlah_siswa ?></span></p>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 50px;">No</th>
                                            <th scope="col">Mulai Presensi</th>
                                            <th scope="col">Akhir Presensi</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        if (!empty($data['presensi'])) {
                                            foreach ($data['presensi'] as $presensi) : ?>
                                                <tr>
                                                    <th scope="row"><?= $no ?></th>
                                                    <td><?= $presensi['mulai_presensi'] ?></td>
                                                    <td><?= $presensi['akhir_presensi'] ?></td>
                                                    <td class="text-right">
                                                        <a href="<?= base_url; ?>presensi/detail_presensi/<?= $presensi['id_presensi'] ?>" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Buka Detail"><i class="fas fa-clipboard"></i></a>
                                                        <a href="<?= base_url; ?>presensi/update_presensi/<?= $presensi['id_presensi'] ?>" class="btn btn-warning ubah_presensi" data-id="<?= $presensi['id_presensi'] ?>" data-toggle="tooltip" data-placement="top" title="Ubah Presensi"><i class="far fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus Presensi"><i class="far fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                        <?php $no++;
                                            endforeach;
                                        } else {
                                            echo '';
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.tambah_presensi').on('click', function() {
            // console.log('OKE');
            $(this).attr('href', '<?= base_url; ?>presensi/tambah_presensi/<?= $data['id_jadwal'] ?>');
        });
    });
</script>