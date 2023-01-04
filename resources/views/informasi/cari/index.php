<div class="page-container">
    <div class="main-content">
        <div class="container">
            <h3 class="font-weight-bold mb-3">Hasil Pencarian : <?=$data['keyword']?></h3>
            <div class="card">
                <div class="card-body">
                    <?php
                    use Utils\Flasher;

                    Flasher::flash();
                    ?>
                    <form action="<?= base_url; ?>informasi/cari" method="get">
                        <div class="input-affix">
                            <input type="text" class="form-control mr-1" name="keyword" placeholder="Cari judul...">
                            <button type="submit"
                                class="btn btn-success btn-icon d-flex d-inline justify-content-center align-items-center">
                                <i class="material-icons">search</i>
                            </button>
                        </div>
                    </form>
                    <a href="<?= base_url; ?>informasi" class="btn btn-danger mt-3">Kembali</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="row">
                        <?php
                        if (!empty($data['informasi'])) {
                            foreach ($data['informasi'] as $informasi) {
                                ?>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class=""
                                            style=" height: 150px; border-top-left-radius: 7px; border-top-right-radius: 7px; 
                                                                                                                            background-image: url('<?=($informasi['thumbnail'] != null ? base_url . 'images/informasi/thumb/' . $informasi['thumbnail'] : base_url . 'images/informasi/thumb/no_images.png') ?>'); background-position: center center; background-repeat: no-repeat; overflow: hidden;">
                                        </div>
                                        <div class="card-body">
                                                <p><span><i class="material-icons font-size-14">calendar_month</i></span> <?= $informasi['tanggal']?></p>
                                            <div class="title mb-2" style="height: 70px; overflow: hidden; text-overflow: ...;">
                                                <h4 class="m-t-10 font-weight-bold">
                                                    <?= htmlspecialchars_decode($informasi['judul_informasi']) ?>
                                                </h4>
                                            </div>
                                            <div class="content"
                                                style="height: 100px; overflow: hidden; text-overflow: ellipsis;">
                                                <p><?= htmlspecialchars_decode($informasi['isi_informasi']) ?></p>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <a href="<?= base_url ?>informasi/detail/<?= $informasi['id_informasi'] ?>"
                                                        class="btn btn-primary btn-tone w-100 mt-3">Baca
                                                        Selengkapnya</a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <a href="<?= base_url;?>informasi/ubah/<?= $informasi['id_informasi']?>" class="btn btn-warning w-100 mt-3">Ubah</a>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <button class="btn btn-danger w-100 mt-3" data-toggle="modal" data-target="#exampleModalCenter<?= $informasi['id_informasi']?>">Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="<?= base_url;?>informasi/hapus/<?= $informasi['id_informasi']?>" method="post">
                                    <div class="modal fade" id="exampleModalCenter<?= $informasi['id_informasi']?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Yakin ingin menghapus data informasi akademik ini?</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <i class="anticon anticon-close"></i>
                                                    </button>
                                                </div>
                                            <div class="modal-body">
                                                <h6>Judul : <?= $informasi['judul_informasi']?></h6>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>

            <div class="row my-2">
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
                                    <a href="<?= base_url; ?>informasi/cari?q=<?= $data['keyword']?>&page=<?= $i; ?>" aria-controls="data-table"
                                        data-dt-idx="1" tabindex="0" class="page-link">
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
