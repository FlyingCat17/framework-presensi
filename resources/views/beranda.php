            <div class="page-container">
              <div class="main-content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                          <h1 class="mb-0 font-weight-bold text-default mt-3">Selamat Datang, <?= $_SESSION['session_name'] ?>!</h1>
                        </div>
                      </div>
                      <div style="margin-top: 40px;">
                        <div class="row">
                          <div class="col-md-6 col-lg-3">
                            <div class="card bg-white">
                              <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                  <div>
                                    <p class="m-b-0 text-default">Jumlah Kelas</p>
                                    <h2 class="m-b-0 text-default">
                                      <span>
                                        <?php
                                        //echo $data['presensi'][0];
                                        echo 20;
                                        ?>
                                      </span>
                                    </h2>
                                  </div>
                                  <div class="avatar avatar-icon avatar-lg" style="background-color: #49CF19; border-radius: 10px;">
                                    <i class="anticon anticon-user text-light"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-3">
                            <div class="card bg-white">
                              <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                  <div>
                                    <p class="m-b-0 text-default">Jumlah Siswa</p>
                                    <h2 class="m-b-0 text-default">
                                      <span>
                                        <?php
                                        //echo $data['presensi'][1];
                                        echo 20;
                                        ?>
                                      </span>
                                    </h2>
                                  </div>
                                  <div class="avatar avatar-icon avatar-lg" style="background: #57CAEB; border-radius: 10px;">
                                    <i class="anticon anticon-user text-light""></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class=" col-md-6 col-lg-3">
                                      <div class="card bg-white">
                                        <div class="card-body">
                                          <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                              <p class="m-b-0 text-default">Jumlah Guru</p>
                                              <h2 class="m-b-0 text-default">
                                                <span>
                                                  <?php
                                                  //echo $data['presensi'][2];
                                                  echo 20
                                                  ?>
                                                </span>
                                              </h2>
                                            </div>
                                            <div class="avatar avatar-icon avatar-lg" style="background: #FDC90F; border-radius: 10px;">
                                              <i class="anticon anticon-user text-light"></i>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-lg-3">
                                    <div class="card bg-white">
                                      <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                          <div>
                                            <p class="m-b-0 text-default">Jumlah Mapel</p>
                                            <h2 class="m-b-0 text-default">
                                              <span>
                                                <?php
                                                //echo $data['presensi'][3];
                                                echo 20;
                                                ?>
                                              </span>
                                            </h2>
                                          </div>
                                          <div class="avatar avatar-icon avatar-lg" style="background: #FF4949; border-radius: 10px;">
                                            <i class="anticon anticon-user text-light"></i>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="card">
                                <div class="card-body">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <h4 class="mb-0">Informasi Akademik</h4>
                                    </div>
                                  </div>
                                  <?php //foreach ($data['informasi'] as $informasi) : 
                                  ?>
                                  <div class="card">
                                    <div class="card-body">
                                      <div class="row">
                                        <div class="col-md-4">
                                          <img class="img-fluid" src="<?php //base_url 
                                                                      ?>/assets/img/others/img-2.jpg" alt="">
                                        </div>
                                        <div class="col-md-8">
                                          <h4 class="m-b-10"><?php //$informasi['judul'] 
                                                              ?></h4>

                                          <p class="m-b-20"><?php //$informasi['konten'] 
                                                            ?></p>
                                          <div class="text-right">
                                            <!-- <a class="btn btn-hover font-weight-semibold" href="#">
                                        <span>Lihat Selengkapnya</span>
                                      </a> -->
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <?php //endforeach; 
                                  ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>