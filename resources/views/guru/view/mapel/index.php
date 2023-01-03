<div class="page-container">
    <div class="main-content">
        <div class="container">
            <h2 class="font-weight-bold mb-3">Mata Pelajaran</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="m-t-10">
                                <div class="row">
                                    <?php
                                    if (!empty($data['mapel'])) {
                                        foreach ($data['mapel'] as $mapel) {
                                            ?>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="card" style="border: 1px solid #E1E1E1;">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <span class="align-middle font-size-16 font-weight-bold">
                                                                <?= $mapel['nama_mapel'] ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            if (empty($data['mapel'])) {
                                echo '<p class="text-center">Tidak Ada Data</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>