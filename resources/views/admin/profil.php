<div class="main-content">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-5 col-sm-12">
                <div class="card" style="margin-top: 6rem;">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <div class="avatar d-flex justify-content-center align-items-center mt-3"
                                style="width: 150px; height:150px">
                                <?php
                                if ($data['admin']->foto_profile != null) {
                                    ?>
                                    <img src="<?= base_url ?>images/profile/<?= $data['admin']->foto_profile ?>"
                                        style="object-fit: cover;">
                                    <?php
                                } else {
                                    ?>
                                    <img src="https://i.pinimg.com/564x/15/0f/a8/150fa8800b0a0d5633abc1d1c4db3d87.jpg"
                                        alt="">
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <h2 class="text-center mt-4"><?= $data['admin']->nama_admin ?></h2>
                        <p class="text-opacity font-size-15 text-center" style="margin-top: 1rem;">
                            @<?= $data['admin']->username ?>
                        </p>
                        <p class="text-dark text-center" style="margin-top: -7px;">
                            <?= ucwords($data['admin']->jabatan) ?>
                        </p>
                        <hr
                            style="top: 20px; border: none; height: 1px; opacity: 70%; width: 20rem; background: darkgray;">
                        <div class="mx-5">

                            <div class="my-4">
                                <div class="d-flex">
                                    <i class="material-icons font-size-20 mr-3">call</i>
                                    <p style="margin-top: -2px;">
                                        <?= $data['admin']->notelp ?>
                                    </p>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex">
                                    <i class="material-icons font-size-20 mr-3" style="padding-top: 2px;">home</i>
                                    <p><?= $data['admin']->alamat ?></p>
                                </div>
                            </div>
                            <?php
                            if ($data['admin']->isRoot == '1') {
                                ?>
                                <div class="mb-4">
                                    <div class="d-flex">
                                        <i class="fas fa-key font-size-15 mr-3" style="padding-top: 4px;"></i>
                                        <p style="margin-left: 5px;">
                                            Anda Adalah Admin Root
                                        </p>
                                    </div>
                                </div>
                                <?php
                            } else {
                                ?>

                                <?php
                            }
                            ?>
                        </div>
                        <div class="d-flex justify-content-center my-3">
                            <a href="admin/ubah" class="btn btn-primary btn-tone w-90">
                                Ubah Profil Saya
                            </a>
                        </div>
                        <div class="d-flex justify-content-center my-3">
                            <button class="btn btn-dark btn-tone w-90">
                                Ubah Username
                            </button>
                        </div>
                        <div class="d-flex justify-content-center my-3">
                            <button class="btn btn-dark btn-tone w-90">
                                Ubah Kata Sandi
                            </button>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-danger w-90" onclick="location.href='<?= base_url; ?>dashboard'">
                                Kembali
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>