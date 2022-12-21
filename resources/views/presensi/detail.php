<script src="<?= base_url; ?>app/views/presensi/detail.js"></script>
<div class="page-container">
    <div class="main-content">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="mb-4 font-weight-bold">Detail Presensi Siswa</h1>
                <p class="d-none" id="_getIdPresensi" data-idpresensi="<?= $data['presensi']->id_presensi ?>"></p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <div class="row">
                                <div class="col-lg-7 col-md-12">
                                    <div class="my-2 ml-2">
                                        <h4 class="d-inline font-weight-bold" id="_get_nama_mapel" data-nama_mapel="<?= $data['presensi']->nama_mapel ?>"><?= $data['presensi']->nama_mapel ?></h4>
                                        <h4 class="d-inline font-weight-bold"> - </h4>
                                        <h4 class="d-inline font-weight-bold" id="_get_nama_kelas" data-nama_kelas="<?= $data['presensi']->nama_kelas ?>"><?= $data['presensi']->nama_kelas ?></h4>
                                        <h4 class="mt-2"><?= $data['presensi']->nama_guru ?></h4>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-12">
                                    <div class="d-flex justify-content-between align-items-center mx-2 my-2">
                                        <div>
                                            <h5 class="">Mulai Presensi : </h5>
                                            <h5 class="">Akhir Presensi : </h5>
                                        </div>
                                        <div>
                                            <h5 class=""><?= $data['presensi']->mulai_presensi ?></h5>
                                            <h5 class=""><?= $data['presensi']->akhir_presensi ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <?php 
                                use Utils\Flasher;
                                Flasher::flash(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 2rem;">No</th>
                                            <th style="width: 7rem;">NIS</th>
                                            <th style="width: 38rem;">Nama Siswa</th>
                                            <th style="width: 5rem;">Status</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data['detail_presensi'] as $detail) : ?>
                                            <tr style="max-height: 3rem;">
                                                <td scope="row"><?= $no; ?></td>
                                                <td><?= $detail['nis'] ?></td>
                                                <td style="max-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?= $detail['nama_siswa']; ?></td>
                                                <td><?= ($detail['status_kehadiran'] == "1" ? '<span class="badge badge-success">Hadir</span>' : ($detail['status_kehadiran'] == "2" ? '<span class="badge badge-info">Izin</span>' : ($detail['status_kehadiran'] == "3" ? '<span class="badge badge-warning">Sakit</span>' : '<span class="badge badge-danger">Tidak Hadir</span> '))) ?></td>
                                                <td><?php
                                                    if ($detail['status_kehadiran'] != NULL) {
                                                    ?>
                                                        <button class="btn btn-icon btn-primary d-flex align-items-center justify-content-center">
                                                            <i class="material-icons">open_in_browser</i>
                                                        </button>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button class="btn btn-icon btn-success d-flex align-items-center justify-content-center tampilModalTambahPresensi" title="Isi Presensi Siswa" data-toggle="modal" data-target="#IsiPresensi" data-nis="<?= $detail['nis'] ?>" data-nama="<?= $detail['nama_siswa'] ?>">
                                                            <i class="material-icons">edit_note</i>
                                                        </button>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;
                                        endforeach;
                                        ?>
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
<div class="modal fade" id="IsiPresensi">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Isi Presensi Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <h5 class="d-inline" id="nis-tambah-presensi" data-nis="">E41212174</h5>
                        <h5 class="d-inline"> - </h5>
                        <h5 class="d-inline" id="nama-tambah-presensi" data-nama>Fathan Maulana</h5>
                    </div>
                    <div class="form-group">
                        <label for="inputState">Status Kehadiran</label>
                        <select class="form-control" id="TambahKehadiran">
                            <option selected value="null">Pilih Status Kehadiran</option>
                            <option value="1">Hadir</option>
                            <option value="2">Izin</option>
                            <option value="3">Sakit</option>
                        </select>
                    </div>
                    <div class="d-none" id="izin">
                        <div class="form-group">
                            <label for="customFile">Surat / Bukti Izin</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Pilih File</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default text-danger" id="tutupModalTambahPresensi" data-dismiss="modal">Tutup</button>
                    <button type="button" id="btn_save_tambah" class="btn btn-success font-weight-bold">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>