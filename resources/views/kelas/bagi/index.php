<div class="page-container">
    <div class="main-content">
        <div class="container">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h1 class="mb-4 font-weight-bold">Daftar Pembagian Kelas</h1>
                </div>
                <div>
                    <h5 class="text-right">Tahun Ajaran</h5>
                    <h5 class="text-right">
                        <?= $data['tahun_ajar']->tahun_ajaran ?>
                    </h5>
                </div>
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
                                    <button type="button" class="btn btn-success" style="width: 100%;"
                                        onclick="location.href='<?= base_url; ?>kelas/bagi/tambah'">
                                        <i class=" anticon anticon-plus" style="width: 100%;"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="m-t-10">
                                <div class="row">
                                    <?php foreach ($data['kelas_ajaran'] as $kelas_ajaran): ?>
                                    <div class="col-md-6 col-lg-4">

                                        <div class="card" style="border: 1px solid #E1E1E1;">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <?php
                                        $id = $kelas_ajaran['id_kelas_ajaran'];
                                        $nama = $kelas_ajaran['nama_kelas'];
                                                    ?>
                                                    <h5 class="mt-2 font-weight-bold">
                                                        <?= $nama ?>
                                                    </h5>
                                                    <div>

                                                        <a href="<?= base_url; ?>kelas/bagi/<?= $id ?>" class="mr-2"
                                                            title="Buka"><i class="far fa-folder-open"
                                                                style="font-size: 17px;"></i></a>
                                                        <a href="" class="tampilModalHapus" title="Hapus Kelas"
                                                            id="btn-ubah-kelas" data-toggle="modal"
                                                            data-target="#modal-hapus-mapel" data-id="<?= $id ?>"
                                                            data-nama="<?= $nama ?>">
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
                    <form id="hapus" action="<?= base_url; ?>kelas/bagi/hapus" method="post">
                        <div class="modal-body">
                            <h6>Yakin ingin menghapus Mata Pelajaran ini?</h6>
                            <input type="hidden" name="id_mapel" id="id_mapel" value="">
                            <p class="d-inline" id="id_mapel_hapus">id_mapel</p><span> - </span>
                            <p class="d-inline" id="nama_mapel_hapus">nama_mapel</p>
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
            $('#id_mapel_hapus').html($(this).data('id'));
            $('#nama_mapel_hapus').html($(this).data('nama'));
            $('#id_mapel').val($(this).data('id'));
            $('.modal-content form').attr('action', '<?= base_url; ?>kelas/bagi/hapus/' + $(this).data('id'));
        });
    });
</script>