<div class="page-container">
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="mb-0 font-weight-bold text-default mt-3">Selamat Datang, <?= $data['guru']->nama_guru ?>!</h1>
                        </div>
                    </div>
                    <div style="margin-top: 40px;">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="card bg-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <p class="m-b-0 text-default">Jumlah Kelas yang diampu</p>
                                                <h2 class="m-b-0 text-default">
                                                    <span>
                                                        <?=(isset($data['kelas']) ? $data['kelas'] : '0') ?>
                                                    </span>
                                                </h2>
                                            </div>
                                            <div class="avatar avatar-icon avatar-lg"
                                                style="background-color: #49CF19; border-radius: 10px;">
                                                <i class="anticon anticon-user text-light"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6 col-lg-6">
                                <div class="card bg-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <p class="m-b-0 text-default">Jumlah Mapel Yang Diampu</p>
                                                <h2 class="m-b-0 text-default">
                                                    <span>
                                                        <?=(isset($data['mapel']) ? $data['mapel'] : '0') ?>
                                                    </span>
                                                </h2>
                                            </div>
                                            <div class="avatar avatar-icon avatar-lg"
                                                style="background: #FF4949; border-radius: 10px;">
                                                <i class="anticon anticon-user text-light"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>