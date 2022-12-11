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
                                        <input type="text" style="width: 100%;" class="form-control" id="formGroupExampleInput" placeholder="Cari Guru (User ID/NUPTK/Nama Guru">
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-12 my-2">
                                    <button class="btn btn-success" style="width: 100%;">
                                        <i class="anticon anticon-search" style="width: 100%;"></i>
                                    </button>
                                </div>
                                <div class="col-lg-1 col-md-12 my-2">
                                    <button type="button" class="btn btn-primary tampilTambahGuru" data-toggle="modal" style="width: 100%;" data-target="#exampleModal">
                                        <i class="anticon anticon-plus" style="width: 100%;"></i>
                                    </button>
                                </div>
                            </div>
                            <?php Flasher::flash(); ?>

                            <div class="mt-2">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 20px;">No</th>
                                                <th scope="col" style="width: 130px;">NUPTK / NIS</th>
                                                <th scope="col">Nama Guru</th>
                                                <th scope="col" style="width: 100px;">Status Kepegawaian</th>
                                                <th scope="col" style="width: 150px; text-align: center;">Ubah / Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php foreach ($data['guru'] as $row) : ?>
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
                                                    <td><?= $no ?></td>
                                                    <td><?= $row['nuptk']; ?></td>
                                                    <td><?= $row['nama_guru']; ?></td>
                                                    <td><?= $row['status_kepegawaian']; ?></td>
                                                    <td><button type="button" class="btn btn-warning tampilUbahGuru" data-nuptk="<?= $row['nuptk'] ?>" data-toggle="modal" data-target="#exampleModal">
                                                            <i class="anticon anticon-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger tampilHapusGuru" data-nuptk="<?= $row['nuptk'] ?>" data-nama="<?= $row['nama_guru'] ?>" data-toggle="modal" data-target="#modal-hapus-guru">
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
            <!-- Tambah Guru Modal -->
            <div class="modal fade" id="exampleModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="<?= base_url; ?>guru/tambah_guru" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Guru</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <i class="anticon anticon-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="anticon anticon-idcard" style="font-size: 20px;"></i></span>
                                    </div>
                                    <input type="text" name="nuptk" id="nuptk" class="form-control" placeholder="NIP / NUPTK" aria-label="NIS" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="anticon anticon-user" style="font-size: 20px;"></i></span>
                                    </div>
                                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Guru" aria-label="Nama Guru" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="material-icons" style="font-size: 20px;">location_city</i></span>
                                    </div>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Tempat Lahir" aria-label="Tempat Lahir" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="anticon anticon-calendar" style="font-size: 20px;"></i></span>
                                    </div>
                                    <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control datepicker-input" placeholder="Tanggal Lahir" required>
                                </div>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="anticon anticon-home" style="font-size: 20px;"></i></span>
                                    </div>
                                    <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat Guru" aria-label="Alamat Guru" aria-describedby="basic-addon1" required>
                                </div>

                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="anticon anticon-contacts" style="font-size: 20px;"></i></span>
                                    </div>
                                    <input type="text" name="telepon" id="telepon" class="form-control" placeholder="Telepon/HP Guru" aria-label="Telepon/HP Siswa" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="material-icons" style="font-size: 20px;">label</i></span>
                                    </div>
                                    <input type="text" name="status" id="status" class="form-control" placeholder="Status Kepegawaian" aria-label="Status Kepegawaian" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger text-white mr-2" data-dismiss="modal">Tutup</button>
                                <button type="submit" name="tambah" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hapus Guru Modal -->
            <div class="modal fade" id="modal-hapus-guru">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
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

    $(document).ready(function() {
        $('.tampilTambahGuru').on('click', function() {
            $('.modal-title').html("Tambah Guru");
            $('.modal-content form').attr('action', 'http://localhost/presensi-smanplus/guru/tambah_guru');
            $('#nuptk').val("");
            $('#nama').val("");
            $('#tempat_lahir').val("");
            $('#tgl_lahir').val("");
            $('#alamat').val("");
            $('#telepon').val("");
            $('#alamat').val("");
            $('#status').val("");
        });
        $('.tampilUbahGuru').on('click', function() {

            // console.log(nuptk);
            $('.modal-title').html("Ubah Guru");
            $('.modal-content form').attr('action', 'http://localhost/presensi-smanplus/guru/ubah_guru');
            const id = $(this).data('nuptk');
            $.ajax({

                url: 'http://localhost/presensi-smanplus/guru/get_nuptk',
                data: {
                    nuptk: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    $('#nuptk').val(data.nuptk);
                    $('#nama').val(data.nama_guru);
                    $('#tempat_lahir').val(data.tempat_lahir);
                    $('#tgl_lahir').val(data.tgl_lahir);
                    $('#tgl_lahir').html(data.tgl_lahir);
                    $('#alamat').val(data.alamat);
                    $('#telepon').val(data.notelp_guru);
                    $('#alamat').val(data.alamat_guru);
                    $('#status').val(data.status_kepegawaian);
                }
            });
        });
        $('.tampilHapusGuru').on('click', function() {
            const nuptk_hapus = $(this).data('nuptk');
            const nama_hapus = $(this).data('nama');
            // console.log(nuptk_hapus);
            // console.log(nama_hapus);
            $('#text-nuptk-hapus').html(nuptk_hapus);
            $('#text-nama-hapus').html(nama_hapus);
            $('#get-nuptk-hapus').val(nuptk_hapus);
        });
    });
</script>