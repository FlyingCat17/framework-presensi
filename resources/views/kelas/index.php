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
              <?php
              use Utils\Flasher;

              Flasher::flash(); ?>
              <div class="row">

                <div class="col-lg-1 col-md-12 my-2">
                  <button type="button" onclick="location.href='<?= base_url; ?>kelas/tambah'"
                    class="btn btn-success tampilModalTambah" style="width: 100%;">
                    <i class=" anticon anticon-plus" style="width: 100%;"></i>
                  </button>
                </div>
              </div>
              <div class="m-t-10 mx-2">
                <div class="row">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col" style="width: 5rem;">No</th>
                          <th scope="col" style="width: 50rem;">Nama Kelas</th>
                          <th scope="col">Ubah/Hapus</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        $no = 1;
                        if (!empty($data['kelas'])) {
                          foreach ($data['kelas'] as $kelas): ?>
                        <tr>
                          <th scope="row">
                            <?= $no ?>
                          </th>
                          <td>
                            <?= $kelas['nama_kelas']; ?>
                          </td>
                          <td>
                            <button type="button" data-nis="<?= $siswa['nis'] ?>" class="btn btn-icon btn-warning"
                              id="btn-ubah-siswa"
                              onclick="location.href='<?= base_url; ?>kelas/ubah/<?= $kelas['id_kelas'] ?>'">
                              <i class="anticon anticon-edit"></i>
                            </button>
                            <button type="button" data-nis="<?= $siswa['nis'] ?>"
                              data-nama="<?= $siswa['nama_siswa'] ?>" class="btn btn-icon btn-danger tampilModalHapus"
                              data-toggle="modal" data-target="#hapusModal">
                              <i class="anticon anticon-delete"></i>
                            </button>
                          </td>
                        </tr>
                        <?php $no++;
                          endforeach;
                        } else {
                          echo '';
                        } ?>
                      </tbody>
                  </div>
                </div>
              </div>

              <!-- Hapus Kelas Modal -->

              <div class="modal fade" id="hapusModal">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Kelas</h5>
                      <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                      </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn text-danger" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
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
  $(document).ready(function () {


    $('.tampilModalTambah').on('click', function () {
      // console.log('CLICKED');
      $('#formModalLabel').html('Tambah Kelas');
      $('#txtNamaKelas').val("");
      $('#id_kelas').val("");
    });

    $('.tampilModalUbah').on('click', function () {
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
        success: function (data) {
          console.log(data);
          $('#txtNamaKelas').val(data.nama_kelas);
          $('#id_kelas').val(data.id_kelas);
        }
      });
    });
  });
</script>