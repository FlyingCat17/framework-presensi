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
                                <button type="button" onclick="location.href='<?= base_url; ?>kelas/tambah'"
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
                                                        class="btn btn-icon btn-danger tampilModalHapus"
                                                        data-toggle="modal" data-target="#hapusModal">
                                                        <i class="anticon anticon-delete"></i>
                                                    </button>
                                                </td>
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