<?php use App\Models\Detail_Presensi as ModelsDetail; ?>
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
                                        <h4 class="d-inline font-weight-bold" id="_get_nama_mapel"
                                            data-nama_mapel="<?= $data['jadwal']->nama_mapel ?>"><?= $data['jadwal']->nama_mapel ?></h4>
                                        <h4 class="d-inline font-weight-bold"> - </h4>
                                        <h4 class="d-inline font-weight-bold" id="_get_nama_kelas"
                                            data-nama_kelas="<?= $data['jadwal']->nama_kelas ?>"><?= $data['jadwal']->nama_kelas ?></h4>
                                        <h4 class="mt-2"><?= $data['jadwal']->nama_guru ?></h4>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-12">
                                    <div class="d-flex justify-content-between align-items-center mx-2 my-2">
                                        <div>
                                            <h5 class="">Mulai Presensi : </h5>
                                            <h5 class="">Akhir Presensi : </h5>
                                        </div>
                                        <div>
                                            <h5 class=""><?= $data['presensi']->tgl_awal_presensi . ' - ' . $data['presensi']->jam_awal_presensi ?></h5>
                                            <h5 class=""><?= $data['presensi']->tgl_akhir_presensi . ' - ' . $data['presensi']->jam_akhir_presensi ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-2 col-md-12 d-flex justify-content-start">
                                    <button class="btn btn-danger w-80 mx-2"
                                        onclick="location.href='<?= base_url; ?>presensi/<?= $data['jadwal']->id_jadwal ?>'"><i
                                            class="anticon anticon-left mr-2"></i>Jadwal</button>
                                </div>
                                <div class="col-lg-10 col-md-12">

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
                                        foreach ($data['siswa'] as $siswa): ?>
                                        <?php
                                            $check = ModelsDetail::select('kehadiran')
                                                ->where('tb_detail_presensi.nis', $siswa['nis'])
                                                ->where('tb_detail_presensi.id_presensi', $data['presensi']->id_presensi)
                                                ->all();
                                            $kehadiran = [
                                                'nis' => $siswa['nis'],
                                                'nama' => $siswa['nama_siswa'],
                                                'kehadiran' => $check,
                                            ];
                                            if ($kehadiran['kehadiran'] != null) {
                                                $hadir = $kehadiran['kehadiran'][0]['kehadiran'];
                                                // echo json_encode($hadir);
                                                // print_r($hadir);
                                            } else {
                                                $hadir = 0;
                                            }
                                        ?>
                                        <tr style="max-height: 3rem;">
                                            <td scope="row"><?= $no; ?></td>
                                            <td><?= $siswa['nis'] ?></td>
                                            <td
                                                style="max-width: 500px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                <?= $siswa['nama_siswa']; ?></td>
                                            <td><?=($hadir == "1" ? '<span class="badge badge-success">Hadir</span>' : ($hadir == "2" ? '<span class="badge badge-info">Izin</span>' : ($hadir == "3" ? '<span class="badge badge-warning">Sakit</span>' : '<span class="badge badge-danger">Tidak Hadir</span> '))) ?></td>
                                            <td><?php
                                            if ($hadir != NULL) {
                                            ?>
                                                <button
                                                    class="btn btn-icon btn-primary d-flex align-items-center justify-content-center">
                                                    <i class="material-icons">open_in_browser</i>
                                                </button>
                                                <?php
                                            } else {
                                                ?>
                                                <button
                                                    class="btn btn-icon btn-success d-flex align-items-center justify-content-center tampilModalTambahPresensi"
                                                    title="Isi Presensi Siswa" data-toggle="modal"
                                                    data-target="#IsiPresensi" data-nis="<?= $siswa['nis'] ?>"
                                                    data-nama="<?= $siswa['nama_siswa'] ?>">
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
                                        <tr>

                                        </tr>
                                    </tbody>
                                </table>
                                <?=(empty($data['siswa']) ? '<p class="text-center">Tidak Ada Data</p>' : '') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal --->
<div class="modal fade" id="IsiPresensi">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- <form action="" method="post"> -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Isi Presensi Siswa</h5>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <h5 class="d-inline" id="nis-tambah-presensi" data-nis="">E41212174</h5>
                    <h5 class="d-inline"> - </h5>
                    <h5 class="d-inline" id="nama-tambah-presensi" data-nama>Fathan Maulana</h5>
                </div>
                <div class="form-group">
                    <label for="inputState">Status Kehadiran</label>
                    <select class="form-control" id="TambahKehadiran" name="kehadiran">
                        <option selected value="null">Pilih Status Kehadiran</option>
                        <option value="1">Hadir</option>
                        <option value="2">Izin</option>
                        <option value="3">Sakit</option>
                    </select>
                </div>
                <div class="d-none" id="izin">
                    <div class="form-group">
                        <label for="customFile">Surat / Bukti Izin</label>
                        <br>
                        <input type="file" name="file" class="file" style="visibility: hidden; position: absolute;">
                        <div class="input-group my-3">
                            <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
                            <div class="input-group-append">
                                <button type="button" class="browse btn btn-primary">Browse...</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <img src="https://via.placeholder.com/80" id="preview" class="img-thumbnail">
                        </div>
                        <!-- <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Pilih File</label>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default text-danger" id="tutupModalTambahPresensi"
                    data-dismiss="modal">Tutup</button>
                <button type="submit" id="btn_save_tambah" data-jadwal="<?= $data['jadwal']->id_jadwal ?>"
                    data-idpresensi="<?= $data['presensi']->id_presensi ?>"
                    class="btn btn-success font-weight-bold">Simpan</button>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>

<script src="<?= base_url; ?>resources/views/presensi/insertDetail.js"></script>