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
                                        <h6 class="d-inline">
                                            <?= $data['jadwal']->id_jadwal ?>
                                        </h6>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="d-flex justify-content-end align-items-center">
                                        <h5 class="font-weight-bold text-right">
                                            <?= $data['jadwal']->nama_guru ?>
                                        </h5>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center">
                                        <h6 class="d-inline">
                                            <?= $data['jadwal']->nama_kelas ?>
                                        </h6>
                                        <p class="d-inline"> - </p>
                                        <h6 class="d-inline">
                                            <?= $data['jadwal']->nama_mapel ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <?php
                            use Utils\Flasher;

                            Flasher::flash();
                            ?>
                            <div class="mb-4"></div>
                            <div class="d-flex justify-content-between align-items-end">
                                <div>
                                    <button type="button" class="btn btn-success mb-3 tambah_presensi"
                                        onclick="location.href='<?= base_url; ?>presensi/<?= $data['jadwal']->id_jadwal ?>/tambah'"
                                        data-id="<?= $data['jadwal']->id_jadwal ?>"><i class="anticon anticon-plus"
                                            style="margin-left: -5px;"></i> Presensi</button>
                                    <a href="#" class="btn btn-danger mb-3"><i class="anticon anticon-file-pdf"
                                            style="margin-left: -5px;"></i> Rekap Presensi</a>
                                </div>
                                <p>Jumlah Siswa : <span>
                                        <?= $data['jumlah_siswa']->jumlah_siswa ?>
                                    </span></p>
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
                                            foreach ($data['presensi'] as $presensi): ?>
                                        <tr>
                                            <th scope="row">
                                                <?= $no ?>
                                            </th>
                                            <td>
                                                <?= $presensi['mulai_presensi_convert'] ?>
                                            </td>
                                            <td>
                                                <?= $presensi['akhir_presensi_convert'] ?>
                                            </td>
                                            <td class="text-right">
                                                <a href="<?= base_url; ?>presensi/<?= $data['jadwal']->id_jadwal ?>/detail/<?= $presensi['id_presensi'] ?>"
                                                    class="btn btn-success" data-toggle="tooltip" data-placement="top"
                                                    title="Buka Detail"><i class="fas fa-clipboard"></i></a>
                                                <!-- /{idJadwal}/ubah/{idPresensi} -->
                                                <a href="<?= base_url; ?>presensi/<?= $data['jadwal']->id_jadwal; ?>/ubah/<?= $presensi['id_presensi'] ?>"
                                                    class="btn btn-warning ubah_presensi"
                                                    data-id="<?= $presensi['id_presensi'] ?>" data-toggle="tooltip"
                                                    data-placement="top" title="Ubah Presensi"><i
                                                        class="far fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger hapusPresensi"
                                                    data-toggle="modal" data-target="#modalHapus" title="Hapus Presensi"
                                                    data-id="<?= $presensi['id_presensi'] ?>"><i
                                                        class="far fa-trash-alt"></i></button>
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
<!-- Modal -->
<div class="modal fade" id="modalHapus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Presensi</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <form action="<?= base_url; ?>" method="POST" id="form_hapus">
                <div class="modal-body">
                    <h6>Yakin ingin menghapus Presensi ini?</h6>
                    <div class="alert alert-danger">
                        <strong>PERHATIAN!</strong> <br>Setelah menghapus presensi ini, maka siswa yang sudah melakukan
                        presensi
                        ini akan otomatis terhapus!
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger" id="btn_delete" data-id="0">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.hapusPresensi').on('click', function () {
            // console.log($(this).data('id'));
            var id = $(this).data('id');
            $('#form_hapus').attr('action', '<?= base_url ?>presensi/<?= $data['jadwal']->id_jadwal ?>/hapus/' + id);
        });
    });
</script>