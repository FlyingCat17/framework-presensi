<div class="page-container">
    <div class="main-content">
        <div class="container">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h1 class="font-weight-bold d-inline">Daftar Siswa</h1>
                    <h1 class="font-weight-bold d-inline">&nbsp;<?= $data['kelas']->nama_kelas ?>
                    </h1>
                </div>
                <div>
                    <h5 class="text-right"></h5>
                    <h5 class="text-right">
                        <?php //$data['tahun_ajar']->tahun_ajaran ?>
                    </h5>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <?php
                    use Utils\Flasher;

                    Flasher::flash(); ?>
                    <div class="row">

                        <div class="col-lg-1 col-md-12 my-2">
                            <button type="button"
                                onclick="location.href='<?= base_url; ?>kelas/bagi/<?= $data['id_kelas'] ?>/tambah/page/1'"
                                class="btn btn-success tampilModalTambah" style="width: 100%;">
                                <i class=" anticon anticon-plus" style="width: 100%;"></i>
                            </button>
                        </div>
                    </div>
                    <div class="m-t-10 mx-2">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 5rem;">No</th>
                                            <th scope="col" style="width: 10rem;">NIS</th>
                                            <th scope="col" style="width: 40rem;">Nama Siswa</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $no = 1;
                                        if (!empty($data['siswa'])) {
                                            foreach ($data['siswa'] as $siswa): ?>
                                                <tr>
                                                    <th scope="row">
                                                        <!-- <input type="checkbox" value="<?php// $siswa['nis']; ?>" /> -->
                                                        <?= $no ?>

                                                    </th>
                                                    <td>
                                                        <?= $siswa['nis']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $siswa['nama_siswa']; ?>
                                                    </td>
                                                    <td>
                                                        <button type="button" data-id="<?= $kelas['id_kelas'] ?>"
                                                            data-nama="<?= $kelas['nama_kelas'] ?>"
                                                            class="btn btn-icon btn-danger tampilModalHapus" data-toggle="modal"
                                                            data-target="#exampleModalCenter<?= $siswa['nis'] ?>">
                                                            <i class="anticon anticon-delete"></i>
                                                        </button>
                                                    </td>
                                                    <form
                                                        action="<?= base_url; ?>kelas/bagi/<?= $data['id_kelas'] ?>/<?= $siswa['nis'] ?>"
                                                        method="post">
                                                        <div class="modal fade" id="exampleModalCenter<?= $siswa['nis'] ?>">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalCenterTitle">
                                                                            Yakin ingin menghapus siswa ini dari <?= $data['kelas']->nama_kelas ?>?
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal">
                                                                            <i class="anticon anticon-close"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <h6>NIS : <?= $siswa['nis'] ?></h6>
                                                                        <h6>Nama : <?= $siswa['nama_siswa'] ?></h6>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </tr>
                                                <?php $no++;
                                            endforeach;
                                        } else {
                                            echo '';
                                        } ?>
                                    </tbody>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>