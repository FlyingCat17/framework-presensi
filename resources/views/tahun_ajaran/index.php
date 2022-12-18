<div class="page-container">
    <div class="main-content">
        <div class="container">
            <div>
                <h1 class="mb-4 font-weight-bold">Tahun Ajaran</h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php

                            use Utils\Flasher;

                            Flasher::flash(); ?>
                            <!-- <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                <span>Tahun Ajaran</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">2020/2021</a>
                                                <a class="dropdown-item" href="#">2021/2022</a>
                                                <a class="dropdown-item" href="#">2022/2023</a>
                                            </div>
                                        </div> -->
                            <button class="btn btn-success tambah-tahun-ajaran"
                                onclick="location.href='<?= base_url; ?>tahun_ajaran/tambah';"><span><i
                                        class="anticon anticon-plus" style="margin-left: -5px;"></i></span>
                                Tambah</button>
                            <div class="m-t-10">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 10%;">No</th>
                                                <th scope="col" style="width: 10%;">ID</th>
                                                <th scope="col" style="width: 30%;">Tahun Ajaran</th>
                                                <th scope="col">Status</th>
                                                <th scope="col" style="width: 40%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            if (!empty($data['tahun_ajaran'])) {
                                                foreach ($data['tahun_ajaran'] as $ajaran): ?>
                                            <tr>

                                                <th scope="row">
                                                    <?= $no ?>
                                                </th>
                                                <td>
                                                    <?= $ajaran['id_tahun_ajaran']; ?>
                                                </td>
                                                <td>
                                                    <?= $ajaran['tahun_ajaran']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($ajaran['isActive'] != 1) {
                                                        echo '<span class="badge badge-danger">Tidak Aktif</span>';
                                                    } else {
                                                        echo '<span class="badge badge-success">Aktif</span>';
                                                    }

                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($ajaran['isActive'] != 1) {
                                                        echo '<button type="button" data-id="' . $ajaran['id_tahun_ajaran'] . '" data-tahun="' . $ajaran['tahun_ajaran'] . '" class="btn btn-success w-40 btnActive my-2" data-toggle="modal" data-target="#modal_aktif" 
                                                                style="width: 120px;
                                                                overflow: hidden;
                                                                white-space: nowrap;
                                                                text-overflow: ellipsis;">
                                                                Aktifkan
                                                            </button>';
                                                    } else {
                                                        echo '<button type="disable" class="btn btn-success w-40 disabled text-success" style="cursor: not-allowed; width: 120px;
                                                        overflow: hidden;
                                                        white-space: nowrap;
                                                        text-overflow: ellipsis;" disabled>Teraktifkan</button>';
                                                    }
                                                    ?>
                                                    <button type="button" class="btn btn-warning"
                                                        onclick="location.href='<?= base_url; ?>tahun_ajaran/ubah/<?= $ajaran['id_tahun_ajaran'] ?>';"
                                                        name="active" data-id="<?= $ajaran['id_tahun_ajaran'] ?>">
                                                        <i class="anticon anticon-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger tampilModalHapus"
                                                        data-id="<?= $ajaran['id_tahun_ajaran'] ?>" data-toggle="modal"
                                                        data-target="#modal-hapus">
                                                        <i class="anticon anticon-delete"></i>
                                                    </button>
                                                </td>

                                            </tr>
                                            <?php $no++;
                                                endforeach;
                                            } else {
                                                echo '<div class="alert alert-warning">
                                                Data Tahun Ajaran <strong>Kosong</strong>! <a href="#" data-toggle="modal" data-target="#modal-tambah-ubah">Klik di sini untuk menambahkan</a>
                                            </div>';
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>





                            <!-- Ubah Kelas Modal -->
                            <!-- <div class="modal fade" id="ubah-kelas">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Ubah Kelas</h5>
                      <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                      </button>
                    </div>
                    <form action="<?php //base_url; 
                    ?>/kelas/update" method="POST" enctype="multipart/form-data">
                      <div class="modal-body">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="material-icons">groups</i></span>
                          </div>
                          <input type="hidden" class="form-control" id="id_kelas" name="id_kelas" value="">
                          <input type="text" class="form-control" placeholder="Nama Kelas" aria-label="Nama Kelas" aria-describedby="basic-addon1" id="nama_kelas" name="nama_kelas" value="">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                        <input type="submit" class="btn btn-success" name="submit" value="Simpan">
                      </div>
                    </form>
                  </div>
                </div>
              </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modal_aktif">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Aktifkan Tahun Ajaran</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <form action="<?= base_url; ?>tahun_ajaran/setActive" method="post">
                        <div class="modal-body">
                            <p>Aktifkan Tahun Ajaran ini?</p>
                            <input type="hidden" id="get_id_tahun_modal" name="id_tahun" value="">
                            <p class="d-inline" id="id_tahun_modal"></p><span> - </span>
                            <p class="d-inline" id="tahun_ajaran"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="submit_active" class="btn btn-success">Ya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Hapus -->
        <div class="modal fade" id="modal-hapus">
            <div class="modal-dialog">
                <div class="modal-content modal-hapus">
                    <form action="<?= base_url; ?>" method="post" id="hapus-tahun">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-hapus">Hapus Tahun Ajaran</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <i class="anticon anticon-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Yakin ingin menghapus Tahun Ajaran ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default text-danger"
                                data-dismiss="modal">Tutup</button>
                            <button type="submit" name="submit_hapus" class="btn btn-danger">Hapus</button>
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
        $('.tambah-tahun-ajaran').on('click', function () {
            $('#modal-tambah-ubah-label').html("Tambah Tahun Ajaran");
            $('.modal-content form').attr('action', '<?= base_url; ?>' + 'tahun_ajaran/insert');
            $('#txt_tahun_ajaran').val("");
        });
        $('.btn-ubah-tahun-ajaran').on('click', function () {
            $('#modal-tambah-ubah-label').html("Ubah Tahun Ajaran");
            $('.modal-content form').attr('action', '<?= base_url; ?>' + 'tahun_ajaran/update');
            const id = $(this).data('id');
            $.ajax({
                url: '<?= base_url; ?>' + 'tahun_ajaran/getTahunAjaranbyId',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    $('#txt_tahun_ajaran').val(data.tahun_ajaran);
                    $('#id_tahun_ajaran').val(data.id_tahun_ajaran);
                }
            });
        });

        $('.tampilModalHapus').on('click', function () {
            $('#hapus-tahun').attr('action', '<?= base_url; ?>tahun_ajaran/hapus/' + $(this).data('id'));
        });

        $('.btnActive').on('click', function () {
            const id = $(this).data('id');
            const tahun = $(this).data('tahun');
            $('#get_id_tahun_modal').val(id);
            $('#id_tahun_modal').html(id);
            $('#tahun_ajaran').html(tahun);
            // console.log(id);
        });

    });
</script>