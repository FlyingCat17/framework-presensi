<div class="page-container">
    <div class="main-content">
        <div class="container">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h1 class="mb-4 font-weight-bold">Pilih Kelas</h1>
                </div>
                <div>
                    <h5 class="text-right">Tahun Ajaran</h5>
                    <h5 class="text-right">
                        <?= $data['tahun_ajar']->tahun_ajaran ?>
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            use Utils\Flasher;

                            Flasher::flash();
                            ?>

                            <div class="m-t-10">
                                <div class="row">
                                    <?php foreach ($data['kelas_ajaran'] as $kelas_ajaran): ?>
                                    <div class="col-md-6 col-lg-4">

                                        <div class="card" style="border: 1px solid #E1E1E1;">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <?php
                                        $id = $kelas_ajaran['id_kelas_ajaran'];
                                        $nama = $kelas_ajaran['nama_kelas'];
                                                    ?>
                                                    <h5 class="mt-2 font-weight-bold">
                                                        <?= $nama ?>
                                                    </h5>
                                                    <div>
                                                        <a href="<?= base_url; ?>jadwal/kelas/<?= $id ?>"
                                                            title="Buka Jadwal" data-toggle="tooltip"
                                                            data-placement="top">
                                                            <i class="far fa-folder-open" style="font-size: 17px;">
                                                            </i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Wrapper END -->
    </div>
</div>