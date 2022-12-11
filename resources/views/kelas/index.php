<div class="page-container">
  <div class="main-content">
    <div class="container">
      <div>
        <h1 class="mb-4 font-weight-bold">Kelas</h1>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">

              </div>
              <?php Flasher::flash(); ?>
              <div class="row">

                <div class="col-lg-1 col-md-12 my-2">
                  <button type="button" class="btn btn-success tampilModalTambah" style="width: 100%;" data-toggle="modal" data-target="#modal-tambah-kelas">
                    <i class=" anticon anticon-plus" style="width: 100%;"></i>
                  </button>
                </div>
              </div>
              <div class="m-t-10">
                <div class="row">
                  <?php foreach ($data['kelas'] as $kelas) : ?>
                    <div class="col-md-6 col-lg-4">

                      <div class="card" style="border: 1px solid #E1E1E1;">
                        <div class="card-body">
                          <div class="d-flex justify-content-between align-items-center">
                            <div>
                              <?php
                              $id = $kelas['id_kelas'];
                              $nama = $kelas['nama_kelas'];
                              ?>
                              <p class="mb-3"><?= $kelas['nama_kelas'] ?><span>
                                  <a href="" class="tampilModalUbah" data-toggle="modal" data-target="#modal-tambah-kelas" id="btn-ubah-kelas" data-id="<?= $kelas['id_kelas']; ?>">
                                    <i class="anticon anticon-edit"></i>
                                  </a>
                                </span>
                              </p>
                              <h2 class="m-b-0">
                                <span><?= $kelas['jumlah_siswa'] ?></span>
                              </h2>
                              <p>Siswa</p>

                            </div>
                            <a href="<?= base_url; ?>kelas/detail/<?= $kelas['id_kelas'] ?>">
                              <div class="avatar avatar-icon avatar-lg avatar-white">
                                <i class="anticon anticon-form text-success"></i>
                              </div>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>

              <!-- Tambah Kelas Modal -->
              <div class="modal fade" id="modal-tambah-kelas">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="formModalLabel">Tambah Kelas</h5>
                      <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="<?= base_url; ?>kelas/tambah" method="post">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="material-icons">groups</i></span>
                          </div>
                          <input type="hidden" name="id_kelas" id="id_kelas">
                          <input type="text" class="form-control" id="txtNamaKelas" name="kelas" placeholder="Nama Kelas" aria-label="Nama Kelas" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                      <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>

              <!-- Ubah Kelas Modal -->
              <!-- <div class="modal fade" id="ubah-kelas">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Ubah Kelas</h5>
                      <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                      </button>
                    </div>
                    <form action="<?php //base_url; 
                                  ?>/kelas/update" method="POST" enctype="multipart/form-data">
                      <div class="modal-body">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="material-icons">groups</i></span>
                          </div>
                          <input type="hidden" class="form-control" id="id_kelas" name="id_kelas" value="">
                          <input type="text" class="form-control" placeholder="Nama Kelas" aria-label="Nama Kelas" aria-describedby="basic-addon1" id="nama_kelas" name="nama_kelas" value="">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                        <input type="submit" class="btn btn-success" name="submit" value="Simpan">
                      </div>
                    </form>
                  </div>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Content Wrapper END -->
  </div>
</div>

<script>
  $(document).ready(function() {


    $('.tampilModalTambah').on('click', function() {
      // console.log('CLICKED');
      $('#formModalLabel').html('Tambah Kelas');
      $('#txtNamaKelas').val("");
      $('#id_kelas').val("");
    });

    $('.tampilModalUbah').on('click', function() {
      // console.log('CLICKED');
      $('#formModalLabel').html('Ubah Kelas');
      $('.modal-body form').attr('action', '<?= base_url; ?>' + 'kelas/ubah');
      const id = $(this).data('id');
      // console.log(id);
      $.ajax({
        url: '<?= base_url; ?>' + 'kelas/getUbah',
        data: {
          id: id
        },
        method: 'post',
        dataType: 'json',
        success: function(data) {
          console.log(data);
          $('#txtNamaKelas').val(data.nama_kelas);
          $('#id_kelas').val(data.id_kelas);
        }
      });
    });
  });
</script>