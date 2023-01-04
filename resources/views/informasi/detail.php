<div class="page-container">
    <div class="main-content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center my-3">
                        <h2 class="font-weight-bold">
                            <?= $data['informasi']->judul_informasi ?>
                        </h2>
                    </div>
                    <div
                        style=" height: 250px; border-top-left-radius: 7px; border-top-right-radius: 7px; 
                                                     background-image: url('<?=($data['informasi']->thumbnail != null ? base_url . 'images/informasi/thumb/' . $data['informasi']->thumbnail : base_url . 'images/informasi/thumb/no_images_lg.png') ?>'); background-position: center center; background-repeat: no-repeat; overflow: hidden;">
                    </div>
                    <div class="content mx-4 mt-5">
                        <p>
                            <?= htmlspecialchars_decode($data['informasi']->isi_informasi) ?>
                        </p>
                    </div>

                    <div class="mt-3">
                        <a href="<?= base_url; ?>informasi" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>