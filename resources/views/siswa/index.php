<div class="page-container">
	<!-- Content Wrapper START -->
	<div class="main-content">
		<div class="container">
			<div>
				<h1 class="mb-4 font-weight-bold">Daftar Siswa</h1>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between align-items-center">

							</div>
							<div class="row">
								<div class="col-lg-10 col-md-12 my-2 ">
									<div class="form-group">
										<input type="text" style="width: 100%;" class="form-control" id="formGroupExampleInput" placeholder="Cari Siswa">
									</div>
								</div>
								<div class="col-lg-1 col-md-12 my-2">
									<button class="btn btn-success" style="width: 100%;">
										<i class="anticon anticon-search" style="width: 100%;"></i>
									</button>
								</div>
								<div class="col-lg-1 col-md-12 my-2">
									<button type="button" class="btn btn-icon btn-primary" onclick="location.href = '<?= base_url; ?>siswa/tambah';" style="width: 100%;">
										<i class="anticon anticon-plus" style="width: 100%;"></i>
									</button>
								</div>
							</div>
							<?php

							use Utils\Flasher;

							Flasher::flash(); ?>
							<div class="">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th scope="col" style="width: 20px;">No</th>
												<th scope="col" style="width: 120px;">NIS</th>
												<th scope="col">Nama</th>
												<th scope="col" style="width: 80px;">Jenis Kelamin</th>
												<th scope="col" style="width: 150px; text-align: center;">Ubah / Hapus</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											if (!empty($data['data_siswa'])) {
												foreach ($data['data_siswa'] as $siswa) : ?>
													<tr>
														<th scope="row"><?= $no ?></th>
														<td><?= $siswa['nis']; ?></td>
														<td><?= $siswa['nama_siswa']; ?></td>
														<td><?= $siswa['jenis_kelamin']; ?></td>
														<td>
															<button type="button" data-nis="<?= $siswa['nis'] ?>" class="btn btn-icon btn-warning" id="btn-ubah-siswa">
																<i class="anticon anticon-edit"></i>
															</button>
															<button type="button" data-nis="<?= $siswa['nis'] ?>" data-nama="<?= $siswa['nama_siswa'] ?>" class="btn btn-icon btn-danger tampilModalHapus" data-toggle="modal" data-target="#model_hapus_siswa">
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
									</table>
									<?php
									if (empty($data['data_siswa'])) {
										echo '<p class="text-center pt-3 pb-2">Tidak Ada Data</p>';
									}
									?>
								</div>
							</div>
							<div class="row">
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


							<!-- Tambah Siswa Modal -->
							<div class="modal fade" id="exampleModal">
								<div class="modal-dialog">
									<div class="modal-content">
										<form action="<?= base_url; ?>siswa/tambah_siswa" method="POST">
											<div class="modal-header">
												<h5 class="modal-title" id="formModalLabel">Tambah Siswa</h5>
												<button type="button" class="close" data-dismiss="modal">
													<i class="anticon anticon-close"></i>
												</button>
											</div>
											<div class="modal-body">
												<!-- NIS -->
												<div class="input-group mb-4">
													<div class="input-group-prepend">
														<span class="input-group-text" id="basic-addon1"><i class="anticon anticon-idcard" style="font-size: 20px;"></i></span>
													</div>
													<input type="text" id="txt_nis" name="nis" class="form-control" placeholder="Nomor Induk Siswa" aria-label="NIS" aria-describedby="basic-addon1">
												</div>
												<!-- NAMA -->
												<div class="input-group mb-4">
													<div class="input-group-prepend">
														<span class="input-group-text" id="basic-addon1"><i class="anticon anticon-user" style="font-size: 20px;"></i></span>
													</div>
													<input type="text" id="txt_nama" name="nama" class="form-control" placeholder="Nama Siswa" aria-label="Nama Siswa" aria-describedby="basic-addon1">
												</div>
												<!-- ALAMAT -->
												<div class="input-group mb-4">
													<div class="input-group-prepend">
														<span class="input-group-text" id="basic-addon1"><i class="anticon anticon-home" style="font-size: 20px;"></i></span>
													</div>
													<input type="text" id="txt_alamat" name="alamat" class="form-control" placeholder="Alamat Siswa" aria-label="Alamat Siswa" aria-describedby="basic-addon1">
												</div>
												<!-- NO TELPON -->
												<div class="input-group mb-4">
													<div class="input-group-prepend">
														<span class="input-group-text" id="basic-addon1"><i class="anticon anticon-contacts" style="font-size: 20px;"></i></span>
													</div>
													<input type="text" id="txt_telepon" name="telepon" class="form-control" placeholder="Telepon/HP Siswa" aria-label="Telepon/HP Siswa" aria-describedby="basic-addon1">
												</div>
												<!-- JENIS KELAMIN -->
												<label for="radio" class="mr-3">Jenis Kelamin</label>
												<div class="d-flex align-items-center justify-content-center input-group mb-2 mt-1">
													<!-- <div class="radio mr-3">
            														<input id="radio" name="radio" type="radio" value="L" checked="">
            														<label for="radio1">Laki-Laki</label>
            													</div>
            													<div class="radio">
            														<input id="radio" name="radio" value="P" type="radio" checked="	">
            														<label for="radio2">Perempuan</label>
            													</div> -->
													<div class="radio mr-3">
														<input type="radio" name="jk" id="gridRadios1" value="L">
														<label for="gridRadios1">
															Laki-Laki
														</label>
													</div>
													<div class="radio">
														<input type="radio" name="jk" id="gridRadios2" value="P">
														<label for="gridRadios2">
															Perempuan
														</label>
													</div>
												</div>
												<!-- TEMPAT LAHIR -->
												<div class="input-group mb-4">
													<div class="input-group-prepend">
														<span class="input-group-text" id="basic-addon1"><i class="material-icons" style="font-size: 20px;">location_city</i></span>
													</div>
													<input type="text" id="txt_tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" aria-label="Telepon/HP Siswa" aria-describedby="basic-addon1">
												</div>
												<!-- TANGGAL LAHIR -->
												<div class="form-group">
													<label>Tanggal Lahir</label>
													<div class="input-affix m-b-10">
														<div class="input-group-prepend">
															<span class="input-group-text" id="basic-addon1"><i class="anticon anticon-contacts" style="font-size: 20px;"></i></span>
														</div>
														<input type="text" name="tgl_lahir" class="form-control datepicker-input pl-3" placeholder="Pick a date">
													</div>
												</div>
												<div class="alert alert-primary text-center" id="notifBawah">
													Setelah berhasil menambahkan siswa, Username dan Password default nya adalah <strong>Nomor Induk Siswa</strong>
												</div>
											</div>

											<div class="modal-footer">
												<button type="button" class="btn btn-danger text-white mr-2" data-dismiss="modal">Tutup</button>
												<button type="submit" name="submit" class="btn btn-success">Simpan</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- Tambah Siswa Modal -->

							<!-- Ubah Siswa Modal -->
							<div class="modal fade" id="modal-ubah-siswa">
								<div class="modal-dialog">
									<div class="modal-content">
										<form action="<?= base_url; ?>siswa/ubah_siswa" method="POST">
											<div class="modal-header">
												<h5 class="modal-title" id="formModalLabel">Ubah Siswa</h5>
												<button type="button" class="close" data-dismiss="modal">
													<i class="anticon anticon-close"></i>
												</button>
											</div>
											<div class="modal-body">
												<!-- NIS -->
												<div class="input-group mb-4">
													<div class="input-group-prepend">
														<span class="input-group-text" id="basic-addon1"><i class="anticon anticon-idcard" style="font-size: 20px;"></i></span>
													</div>
													<input type="text" id="nis" name="nis" class="form-control" placeholder="Nomor Induk Siswa" aria-label="NIS" aria-describedby="basic-addon1">
													<input type="hidden" name="get_nis" value="" id="get_nis">
												</div>
												<!-- NAMA -->
												<div class="input-group mb-4">
													<div class="input-group-prepend">
														<span class="input-group-text" id="basic-addon1"><i class="anticon anticon-user" style="font-size: 20px;"></i></span>
													</div>
													<input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Siswa" aria-label="Nama Siswa" aria-describedby="basic-addon1">
												</div>
												<!-- ALAMAT -->
												<div class="input-group mb-4">
													<div class="input-group-prepend">
														<span class="input-group-text" id="basic-addon1"><i class="anticon anticon-home" style="font-size: 20px;"></i></span>
													</div>
													<input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat Siswa" aria-label="Alamat Siswa" aria-describedby="basic-addon1">
												</div>
												<!-- NO TELPON -->
												<div class="input-group mb-4">
													<div class="input-group-prepend">
														<span class="input-group-text" id="basic-addon1"><i class="anticon anticon-contacts" style="font-size: 20px;"></i></span>
													</div>
													<input type="text" id="telepon" name="telepon" class="form-control" placeholder="Telepon/HP Siswa" aria-label="Telepon/HP Siswa" aria-describedby="basic-addon1">
												</div>
												<!-- JENIS KELAMIN -->
												<label for="radio" class="mr-3">Jenis Kelamin</label>
												<div class="d-flex align-items-center justify-content-center input-group mb-2 mt-1">
													<!-- <div class="radio mr-3">
            														<input id="radio" name="radio" type="radio" value="L" checked="">
            														<label for="radio1">Laki-Laki</label>
            													</div>
            													<div class="radio">
            														<input id="radio" name="radio" value="P" type="radio" checked="	">
            														<label for="radio2">Perempuan</label>
            													</div> -->
													<div class="radio mr-3">
														<input id="radio1" name="radioDemo" type="radio" value="L" checked="">
														<label for="radio1">Laki-Laki</label>
													</div>
													<div class="radio">
														<input id="radio2" name="radioDemo" type="radio" value="P" checked="">
														<label for="radio2">Perempuan</label>
													</div>
												</div>
												<!-- TEMPAT LAHIR -->
												<div class="input-group mb-4">
													<div class="input-group-prepend">
														<span class="input-group-text" id="basic-addon1"><i class="material-icons" style="font-size: 20px;">location_city</i></span>
													</div>
													<input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" aria-label="Telepon/HP Siswa" aria-describedby="basic-addon1">
												</div>
												<!-- TANGGAL LAHIR -->
												<div class="form-group">
													<label>Tanggal Lahir</label>
													<div class="input-affix m-b-10">
														<div class="input-group-prepend">
															<span class="input-group-text" id="basic-addon1"><i class="anticon anticon-contacts" style="font-size: 20px;"></i></span>
														</div>
														<input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control datepicker-input pl-3" placeholder="Pick a date" value="">
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-danger text-white mr-2" data-dismiss="modal">Tutup</button>
												<button type="submit" name="submit" class="btn btn-success">Simpan</button>
											</div>
										</form>
									</div>
								</div>
							</div>

							<!-- Hapus Siswa Modal -->
							<div class="modal fade" id="model_hapus_siswa">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<form action="<?= base_url; ?>siswa/hapusSiswa" method="post">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalCenterTitle">Hapus Siswa</h5>
												<button type="button" class="close" data-dismiss="modal">
													<i class="anticon anticon-close"></i>
												</button>
											</div>

											<div class="modal-body">
												<h6>Yakin ingin menghapus data siswa ini?</h6>
												<input type="hidden" name="nis" id="post_nis_siswa" value="">
												<p class="d-inline" id="nis_siswa_hapus"></p><span> - </span>
												<p class="d-inline" id="nama_siswa_hapus">Loremipsum</p>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default text-danger" data-dismiss="modal">Tutup</button>
												<button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- Hapus Siswa Modal -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Content Wrapper END -->
	</div>
</div>

<script>
	$('.datepicker-input').datepicker({
		format: 'yyyy-mm-dd'
	});


	$(document).ready(function() {

		$('.tampilModalUbah').on('click', function() {
			const nis = $(this).data('nis');
			console.log(nis);
			$.ajax({
				url: '<?= base_url; ?>' + 'siswa/getDatabyId',
				data: {
					id: nis,
				},
				method: 'post',
				dataType: 'json',
				success: function(data) {
					console.log(data);
					$('#nis').val(data.nis);
					$('#get_nis').val(data.nis);
					$('#nama').val(data.nama_siswa);
					$('#alamat').val(data.alamat_siswa);
					$('#telepon').val(data.notelp_siswa);
					$('#tempat_lahir').val(data.tempat_lahir);
					$('#tgl_lahir').val(data.tgl_lahir);
					if (data.jenis_kelamin == "L") {
						$('#radio1').prop('checked', 'true');
					} else {
						$('#radio2').prop('checked', 'true');
					}
				}
			});
		});
		$('.tampilModalHapus').on('click', function() {
			$('#post_nis_siswa').val($(this).data('nis'));
			$('#nis_siswa_hapus').html($(this).data('nis'));
			$('#nama_siswa_hapus').html($(this).data('nama'));
		});
	});
</script>