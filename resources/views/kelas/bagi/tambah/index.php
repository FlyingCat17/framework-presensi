<div class="page-container">
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container">
            <div>
                <h1 class="mb-4 font-weight-bold">Daftar Siswa
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <button class="btn btn-danger"
                                onclick="location.href='<?= base_url; ?>kelas/bagi/<?= $data['kelas']->id_kelas_ajaran ?>'">Kembali</button>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 20px;">No</th>
                                            <th scope="col" style="width: 120px;">NIS</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col" style="width: 80px;">Jenis Kelamin</th>
                                            <th scope="col" style="width: 150px; text-align: left;">Pilih
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        if (!empty($data['data_siswa'])) {
                                            foreach ($data['data_siswa'] as $siswa): ?>
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
                                                        <?= $siswa['jenis_kelamin']; ?>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-icon btn-success btn_pilih" data-toggle="modal"
                                                            data-target="#modalPilih" data-nis="<?= $siswa['nis'] ?>"
                                                            data-nama="<?= $siswa['nama_siswa'] ?>">
                                                            <i class="far fa-check-square"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php $no++;
                                            endforeach;
                                        } else {
                                            echo '';
                                        } ?>
                                    </tbody>
                                </table>
                                <?php
                                if (empty($data['data_siswa'])) {
                                    echo '<p class="text-center pt-3 pb-2">Tidak Ada Data</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPilih">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= base_url; ?>kelas/bagi/<?= $data['kelas']->id_kelas_ajaran ?>/tambah" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalJudul">Tambah Siswa ke <?= $data['kelas']->nama_kelas ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="nis_siswa" id="nis_siswa_input">
                    <p class="d-inline">Yakin ingin menambahkan</p>
                    <h6 class="d-inline" id="konfirmasi_text_nis">{nis}</h6>
                    <p class="d-inline"> - </p>
                    <h6 class="d-inline" id="konfirmasi_text_nama">{nama}</h6>
                    <p class="d-inline"> ke </p>
                    <h6 class="d-inline" id="konfirmasi_text_kelas">{nama_kelas}</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="simpan_siswa" class="btn btn-success">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.btn_pilih').on('click', function () {
            // console.log('CLICK');
            var nis = $(this).data('nis');
            var nama = $(this).data('nama');
            var nama_kelas = '<?= $data['kelas']->nama_kelas ?>';
            $('#konfirmasi_text_nis').html(nis);
            $('#konfirmasi_text_nama').html(nama);
            $('#konfirmasi_text_kelas').html(nama_kelas + ' ?');
            $('#nis_siswa_input').val(nis);
        });
        // $('#simpan_siswa').on('click', function () {
        //     // console.log('CLICKKK');
        //     var nis = $('#konfirmasi_text_nis').val();
        //     var nama = $('#konfirmasi_text_nama').val();
        //     var id_kelas = '<?= $data['kelas']->id_kelas ?>'
        //     $.ajax({
        //         url: '<?= base_url; ?>kelas/bagi/<?= $data['kelas']->id_kelas_ajaran ?>/tambah',
        //         type: 'POST',
        //         data: {
        //             nis: nis,
        //             id_kelas_ajaran: id_kelas
        //         },
        //         cache: false,
        //         success: function (result) {
        //             var result = JSON.parse(result);
        //             if (result.statusCode == 200) {
        //                 alert('Berhasil');
        //             } else {
        //                 alert('GAGAL');
        //             }
        //         }
        //     });
        // });
    });
</script>