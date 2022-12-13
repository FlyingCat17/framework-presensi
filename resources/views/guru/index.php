<div class="page-container">
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container">
            <div>
                <h1 class="mb-4 font-weight-bold">Guru</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10 col-md-12 my-2">
                                    <div class="form-group">
                                        <input type="text" style="width: 100%;" class="form-control"
                                            id="formGroupExampleInput" placeholder="Cari Guru (User ID/NUPTK/Nama Guru">
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-12 my-2">
                                    <button class="btn btn-success" style="width: 100%;">
                                        <i class="anticon anticon-search" style="width: 100%;"></i>
                                    </button>
                                </div>
                                <div class="col-lg-1 col-md-12 my-2">
                                    <button type="button" class="btn btn-primary"
                                        onclick="location.href='<?= base_url; ?>guru/tambah'" style="width: 100%;">
                                        <i class="anticon anticon-plus" style="width: 100%;"></i>
                                    </button>
                                </div>
                            </div>
                            <?php
                            use Utils\Flasher;

                            Flasher::flash();
                            ?>

                            <div class="mt-2">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 20px;">No</th>
                                                <th scope="col" style="width: 130px;">NUPTK / NIS</th>
                                                <th scope="col">Nama Guru</th>
                                                <th scope="col" style="width: 100px;">Status Kepegawaian</th>
                                                <th scope="col" style="width: 150px; text-align: center;">Ubah / Hapus
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php foreach ($data['guru'] as $row): ?>
                                            <!-- <tr>
                                                <th scope="row">1</th>
                                                <td>1234567</td>
                                                <td>Fathan Maulana</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#btn-ubah-siswa">
                                                        <i class="anticon anticon-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#">
                                                        <i class="anticon anticon-delete"></i>
                                                    </button>
                                                </td>
                                            </tr> -->
                                            <tr>
                                                <td>
                                                    <?= $no ?>
                                                </td>
                                                <td>
                                                    <?= $row['nuptk']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['nama_guru']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['status_kepegawaian']; ?>
                                                </td>
                                                <td><button type="button" class="btn btn-warning"
                                                        data-nuptk="<?= $row['nuptk'] ?>"
                                                        onclick="location.href='<?= base_url; ?>guru/ubah/<?= $row['nuptk'] ?>'">
                                                        <i class="anticon anticon-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger tampilHapusGuru"
                                                        data-nuptk="<?= $row['nuptk'] ?>"
                                                        data-nama="<?= $row['nama_guru'] ?>" data-toggle="modal"
                                                        data-target="#modal-hapus-guru">
                                                        <i class="anticon anticon-delete"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <?php $no++;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hapus Guru Modal -->
            <div class="modal fade" id="modal-hapus-guru">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content hapusModal">
                        <form action="<?= base_url; ?>guru/hapus_guru" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Guru</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <i class="anticon anticon-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5>Yakin ingin menoaktifkan guru ini??</h5>
                                <input type="hidden" name="get-nuptk-hapus" id="get-nuptk-hapus" value="">
                                <p class="d-inline" id="text-nuptk-hapus">NUPTK</p><span> - </span>
                                <p class="d-inline" id="text-nama-hapus">Nama</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" name="button_hapus" class="btn btn-danger">Hapus</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- Hapus Guru Modal -->
        </div>
        <!-- Content Wrapper END -->
    </div>
</div>

<script>
    $('.datepicker-input').datepicker({
        format: 'yyyy-mm-dd'
    });

    $(document).ready(function () {
        $('.tampilHapusGuru').on('click', function () {
            const nuptk_hapus = $(this).data('nuptk');
            const nama_hapus = $(this).data('nama');
            // console.log(nuptk_hapus);
            // console.log(nama_hapus);
            $('.hapusModal form').attr('action', '<?= base_url; ?>guru/hapus/' + nuptk_hapus);
            $('#text-nuptk-hapus').html(nuptk_hapus);
            $('#text-nama-hapus').html(nama_hapus);
            $('#get-nuptk-hapus').val(nuptk_hapus);
        });
    });
</script>