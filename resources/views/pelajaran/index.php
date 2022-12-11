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

                            <?php Flasher::flash(); ?>
                            <div class="row">

                                <div class="col-lg-1 col-md-12 my-2">
                                    <button type="button" class="btn btn-success tampilModalTambah" style="width: 100%;" data-toggle="modal" data-target="#modal-tambah-kelas">
                                        <i class=" anticon anticon-plus" style="width: 100%;"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="m-t-10">
                                <div class="row">
                                    <?php foreach ($data['mapel'] as $mapel) : ?>
                                        <div class="col-md-6 col-lg-4">

                                            <div class="card" style="border: 1px solid #E1E1E1;">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <?php
                                                        $id = $mapel['id_mapel'];
                                                        $nama = $mapel['nama_mapel'];
                                                        ?>
                                                        <h5 class="mt-2 font-weight-bold"><?= $nama ?></h5>
                                                        <div>
                                                            <a href="" class="tampilModalUbah" data-toggle="modal" title="Ubah Nama" data-target="#modal-tambah-kelas" id="btn-ubah-kelas" data-nama="<?= $mapel['nama_mapel'] ?>" data-id="<?= $mapel['id_mapel']; ?>">
                                                                <i class="anticon anticon-edit" style="font-size: 20px;"></i>
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
        <!-- Tambah Kelas Modal -->
        <div class="modal fade" id="modal-tambah-kelas">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formModalLabel">Tambah Mata Pelajaran</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <form id="ubahapus" action="<?= base_url; ?>mapel/tambah_mapel" method="post">
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="material-icons">book</i></span>
                                </div>
                                <input type="hidden" name="id_mapel" id="txtid_mapel">
                                <input type="text" class="form-control" id="txtNamaKelas" name="mapel" placeholder="Nama Mata Pelajaran" aria-label="Nama Kelas" aria-describedby="basic-addon1" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="tambah_mapel" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
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
                    <form id="hapus" action="<?= base_url; ?>mapel/hapus_mapel" method="post">
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
    $(document).ready(function() {
        $('.tampilModalTambah').on('click', function() {
            $('#formModalLabel').html("Tambah Mata Pelajaran");
            $('#txtNamaKelas').val("");
            $('.modal-content form#ubahapus').attr('action', '<?= base_url; ?>mapel/tambah_mapel');
        });
        $('.tampilModalUbah').on('click', function() {
            $('#formModalLabel').html("Ubah Mata Pelajaran");
            $('#txtNamaKelas').val($(this).data("nama"));
            $('.modal-content form#ubahapus').attr('action', '<?= base_url; ?>mapel/updateMapel');
            const id = $(this).data("id");
            $.ajax({
                url: '<?= base_url; ?>mapel/getIdMapel',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    $('#txtNamaKelas').val(data.nama_mapel);
                    $('#txtid_mapel').val(data.id_mapel);
                }
            });
        });
        $('.tampilModalHapus').on('click', function() {
            $('#id_mapel_hapus').html($(this).data('id'));
            $('#nama_mapel_hapus').html($(this).data('nama'));
            $('#id_mapel').val($(this).data('id'));
            $('.modal-content form#hapus').attr('action', '<?= base_url; ?>mapel/hapus_mapel');
        });
    });
</script>