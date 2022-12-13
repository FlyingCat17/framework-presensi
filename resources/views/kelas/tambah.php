<div class="page-container">
  <!-- Content Wrapper START -->
  <div class="main-content">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-md-12 col-lg-6">
          <div>
            <h2 class="mb-4 font-weight-bold">Tambah Kelas</h2>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div>
                    <?php
                    use Utils\Flasher;

                    Flasher::flash();
                    ?>
                    <form action="<?= base_url; ?>kelas/tambah" method="post">
                      <div class="form-group">
                        <label for="kelas">Nama Kelas</label>
                        <input type="text" name="kelas" class="form-control" placeholder="XI MIPA 2">
                      </div>
                      <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-danger mr-3"
                          onclick="location.href='<?= base_url; ?>kelas'">Kembali</button>
                        <button type=submit class="btn btn-success">Simpan</button>
                      </div>
                    </form>
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