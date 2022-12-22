<div class="page-container">
    <div class="main-content">
        <div class="container">
            <div>
                <h1 class="mb-4 font-weight-bold">Daftar Mata Pelajaran</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <?php
                            use Utils\Flasher;

                            Flasher::flash();
                            ?>
                            <div class="row">

                                <div class="col-lg-1 col-md-12 my-2">
                                    <button type="button" class="btn btn-success tampilModalTambah" style="width: 100%;"
                                        onclick="location.href='<?= base_url; ?>mapel/tambah'">
                                        <i class=" anticon anticon-plus" style="width: 100%;"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="m-t-10">
                                <div class="row">
                                    <?php foreach ($data['mapel'] as $mapel): ?>
                                    <div class="col-md-6 col-lg-4">

                                        <div class="card" style="border: 1px solid #E1E1E1;">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <?php
                                        $id = $mapel['id_mapel'];
                                        $nama = $mapel['nama_mapel'];
                                                    ?>
                                                    <h5 class="mt-2 font-weight-bold">
                                                        <!-- <pre> -->
                                                        <?= $nama ?>
                                                        <!-- </pre> -->
                                                    </h5>
                                                    <div>
                                                        <a href="<?= base_url; ?>mapel/ubah/<?= $id ?>" class="mr-2"
                                                            title="Ubah Nama" id="btn-ubah-kelas"
                                                            data-nama="<?= $mapel['nama_mapel'] ?>"
                                                            data-id="<?= $mapel['id_mapel']; ?>">
                                                            <i class="anticon anticon-edit"
                                                                style="font-size: 20px;"></i>
                                                        </a>
                                                        <a href="<?= base_url; ?>mapel/ubah/<?= $id ?>"
                                                            class="tampilModalHapus" title="Hapus" id="btn-ubah-kelas"
                                                            data-nama="" data-id="<?= $mapel['id_mapel']; ?>"
                                                            data-toggle="modal" data-target="#modal-hapus-mapel">
                                                            <i class="far fa-trash-alt text-danger"
                                                                style="font-size: 17px;"></i>
                                                        </a>
                                                        <!-- <a href="" class="tampilModalHapus" data-toggle="modal" title="Hapus" data-target="#modal-hapus-mapel" id="btn-hapus" data-nama="<?= $mapel['nama_mapel'] ?>" data-id="<?= $mapel['id_mapel']; ?>">
                                                                <i class="anticon anticon-delete text-danger" style="font-size: 20px;"></i>
                                                            </a> -->

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tampil Modal Hapus -->
        <div class="modal fade" id="modal-hapus-mapel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formModalLabel">Hapus Mata Pelajaran</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <form id="hapus" action="<?= base_url; ?>mapel/hapus/" method="post">
                        <div class="modal-body">
                            <h6>Yakin ingin menghapus Mata Pelajaran ini?</h6>
                            <input type="hidden" name="id_mapel" id="id_mapel" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn text-danger" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="hapus_mapel" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Content Wrapper END -->
    </div>
</div>

<script>
    $(document).ready(function () {

        $('.tampilModalHapus').on('click', function () {
            $('#id_mapel').val($(this).data('id'));
            $('.modal-content form').attr('action', '<?= base_url; ?>mapel/hapus/' + $(this).data('id'));
        });
    });
</script>