<div class="page-container">
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container">
            <div>
                <h1 class="mb-4 font-weight-bold">Hasil Pencarian Guru : <?= $data['keyword'] ?></h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= base_url; ?>guru/cari" method="get">
                                <div class="input-affix mb-4">
                                    <i class="prefix-icon anticon anticon-search"></i>
                                    <input type="text" class="form-control mr-3" name="keyword"
                                        placeholder="NUPTK / Nama Guru">
                                    <button class="btn btn-icon btn-success" type="submit">
                                        <i class="anticon anticon-search"></i>
                                    </button>
                                </div>
                            </form>

                            <button type="button" class="btn btn-danger mb-2"
                                onclick="location.href = '<?= base_url; ?>guru';">
                                <i class="fas fa-reply mr-1"></i>
                                Kembali
                            </button>
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
                                                <th scope="col" style="width: 130px;">NUPTK / NIP</th>
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

                                    <?=(empty($data['guru']) ? '<p class="text-center">Tidak ada data</p>' : '') ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="data-table_info" role="status" aria-live="polite">
                                        Showing <?= $data['halaman_aktif'] ?> to <?= $data['halaman_akhir'] ?> of <?= $data['jumlah_data'] ?> entries</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="data-table_paginate">
                                        <ul class="pagination">
                                            <?php
                                            $jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
                                            $start_number = ($data['halaman_aktif'] > $jumlah_number) ? $data['halaman_aktif'] - $jumlah_number : 1; // Untuk awal link number
                                            $end_number = ($data['halaman_aktif'] < ($data['jumlah_halaman'] - $jumlah_number)) ? $data['halaman_aktif'] + $jumlah_number : $data['jumlah_halaman']; // Untuk akhir link number
                                            for ($i = $start_number; $i <= $end_number; $i++) {
                                                $link_active = ($data['halaman_aktif'] == $i) ? 'active' : '';
                                                ?>
                                                <li class="paginate_button page-item <?= $link_active; ?>">
                                                    <a href="<?= base_url; ?>siswa/page/<?= $i; ?>"
                                                        aria-controls="data-table" data-dt-idx="1" tabindex="0"
                                                        class="page-link">
                                                        <?= $i; ?>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                            <!-- <div class="col-sm-12 col-md-12">
                                    <div class="d-flex justify-content-center">
                                        <div class="dataTables_paginate paging_simple_numbers" id="data-table_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item previous disabled" id="data-table_previous"><a href="#" aria-controls="data-table" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                                <li class="paginate_button page-item active"><a href="#" aria-controls="data-table" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="data-table" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="data-table" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="data-table" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="data-table" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="data-table" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                                <li class="paginate_button page-item next" id="data-table_next"><a href="#" aria-controls="data-table" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> -->
                                    </div>
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