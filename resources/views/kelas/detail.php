            <div class="page-container">
            	<!-- Content Wrapper START -->
            	<div class="main-content">
            		<div class="container">
            			<div class="d-flex justify-content-between align-items-center">
            				<div>
            					<h1 class="mb-4 font-weight-bold">Daftar Siswa</h1>
            				</div>
            				<div>
            					<h1 class="mb-4 font-weight-bold">
            						<?php
            						use Utils\Flasher;
									if (!empty($data['kelas']['nama_kelas'])) {
										echo $data['kelas']['nama_kelas'];
									} else {
										echo '';
									}
									?></h1>
            				</div>
            			</div>
            			<div class="row">
            				<div class="col-md-12">
            					<div class="card">
            						<div class="card-body">

            							<div class="row">
            								<div class="col-lg-10 col-md-12 my-1">
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
            									<button type="button" class="btn btn-primary tampilModalTambah" data-toggle="modal" style="width: 100%;" data-target=".bd-example-modal-lg">
            										<i class="anticon anticon-plus" style="width: 100%;"></i>
            									</button>
            								</div>
            							</div>
            							<?php Flasher::flash() ?>
            							<div class="">
            								<div class="table-responsive">
            									<table class="table">
            										<thead>
            											<tr>
            												<th scope="col" style="width: 20px;">No</th>
            												<th scope="col" style="width: 120px;">NIS</th>
            												<th scope="col">Nama</th>
            												<th scope="col" style="width: 100px;">Jenis Kelamin</th>
            												<th scope="col" style="width: 150px; text-align: center;">Hapus</th>
            											</tr>
            										</thead>
            										<tbody>
            											<?php
														$no = 1;
														if (!empty($data['detail_kelas'])) {
															foreach ($data['detail_kelas'] as $siswa) : ?>
            													<tr>
            														<th scope="row"><?= $no ?></th>
            														<td><?= $siswa['nis']; ?></td>
            														<td><?= $siswa['nama_siswa']; ?></td>
            														<td><?= $siswa['jenis_kelamin']; ?></td>
            														<td>
            															<div class="d-flex justify-content-center align-items-center">
            																<button type="button" data-id="<?= $siswa['nis'] ?>" data-nama="<?= $siswa['nama_siswa'] ?>" class="btn btn-danger tampilModalHapus" data-toggle="modal" data-target="#model_hapus_siswa">
            																	<i class="anticon anticon-delete"></i>
            																</button>
            															</div>
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
												if (empty($data['detail_kelas'])) {
												?>
            										<div class="d-flex justify-content-center align-items-center pt-3">
            											<p>Tidak Ada Siswa</p>
            										</div>
            									<?php
												}
												?>
            								</div>
            							</div>
            							<!-- Tambah Siswa Modal -->

            							<!-- Hapus Siswa Modal -->
            							<div class="modal fade" id="model_hapus_siswa">
            								<div class="modal-dialog modal-dialog-centered">
            									<div class="modal-content">
            										<form action="<?= base_url; ?>kelas/delete_siswa" method="post">
            											<div class="modal-header">
            												<h5 class="modal-title" id="exampleModalCenterTitle">Hapus Siswa</h5>
            												<button type="button" class="close" data-dismiss="modal">
            													<i class="anticon anticon-close"></i>
            												</button>
            											</div>

            											<div class="modal-body">
            												<h6>Yakin ingin menghapus data siswa pada kelas ini?</h6>
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
            							<!-- Tambah Siswa to Kelas Modal -->

            							<div class="modal fade bd-example-modal-lg">
            								<div class="modal-dialog modal-lg modal-dialog-scrollable">
            									<div class="modal-content">
            										<div class="modal-header">
            											<h5 class="modal-title h4">Pilih Siswa</h5>
            											<button type="button" class="close" data-dismiss="modal">
            												<i class="anticon anticon-close"></i>
            											</button>
            										</div>
            										<div class="mx-4 mt-3">
            											<h5>Data Siswa<?= $_SESSION['id_kelas'] ?></h5>
            											<div class="input-group mt-3 pb-3">
            												<div class="input-group-prepend">
            													<span class="input-group-text" id="basic-addon1"><i class="material-icons" style="font-size: 20px;">search</i></span>
            												</div>
            												<input type="text" id="txt_nis" name="nis" class="form-control" placeholder="Cari NIS / Nama Siswa" aria-label="NIS" aria-describedby="basic-addon1">

            											</div>
            										</div>
            										<div class="modal-body">
            											<div class="">
            												<div class="table-responsive">
            													<table class="table">
            														<thead>
            															<tr>

            																<th scope="col" style="width: 20px;">No</th>
            																<th scope="col" style="width: 120px;">NIS</th>
            																<th scope="col">Nama</th>
            																<th scope="col" style="width: 100px;">Jenis Kelamin</th>
            																<th scope="col" style="width: 150px; text-align: center;">Pilih</th>
            															</tr>
            														</thead>

            														<tbody>
            															<?php
																		$no = 1;
																		if (!empty($data['siswa'])) {
																			foreach ($data['siswa'] as $siswa) : ?>
            																	<tr>
            																		<th scope="row"><?= $no ?></th>
            																		<td><?= $siswa['nis']; ?></td>
            																		<td><?= $siswa['nama_siswa']; ?></td>
            																		<td><?= $siswa['jenis_kelamin']; ?></td>
            																		<td>
            																			<div class="d-flex justify-content-center">
            																				<!-- <form action="kelas/update_siswa_to_kelas/<?php $siswa['nis'] ?>" method="post">
            																					<input type="hidden" name="set_id_siswa" value="<?php $siswa['nis'] ?>">
            																					<button type="submit" name="submit_set" data-id="<?php $siswa['nis'] ?>" value="<?php $siswa['nis'] ?>" class="btn btn-success tambahSiswatoKelas" id="btn-ubah-siswa">
            																						<i class="material-icons" style="font-size: 20px; padding-top: 4px;">input</i>
            																					</button>
            																				</form> -->
            																				<a href="<?= base_url; ?>kelas/update_siswa_to_kelas/<?= $siswa['nis'] ?>"><i class="material-icons text-success" style="font-size: 20px; padding-top: 4px;">input</i></a>
            																			</div>
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
																if (empty($data['siswa'])) {
																?>
            														<div class="d-flex justify-content-center align-items-center pt-3">
            															<p>Tidak Ada Siswa</p>
            														</div>
            													<?php
																}
																?>
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
            		<!-- Content Wrapper END -->
            	</div>
            </div>

            <script>
            	$(document).ready(function() {
            		$('.tampilModalTambah').on('click', function() {
            			// console.log('CLICKED');
            			$('.modal-content form').attr('action', '<?= base_url; ?>' + 'kelas/tambah_siswa');
            			$('#formModalLabel').html('Tambah Data Siswa');
            			$('#txt_nis').val("");
            			$('#txt_nama').val("");
            			$('#txt_alamat').val("");
            			// $('#radioL').prop("checked", false);
            			// $('#radioP').prop("checked", false);
            			$('#txt_telepon').val("");
            			$('#txt_tahun_masuk').val("");
            			$('#notifBawah').addClass("alert alert-primary text-center").html("Setelah berhasil menambahkan siswa, Username dan Password default nya adalah <strong>Nomor Induk Siswa</strong>");
            		});

            		$('.tambahSiswatoKelas').on('click', function() {
            			console.log($(this).val());
            		});

            		$('.tampilModalUbah').on('click', function() {
            			// console.log('CLICKED');
            			$('#formModalLabel').html('Ubah Data Siswa');
            			$('.modal-content form').attr('action', '<?= base_url; ?>' + 'kelas/update_siswa');
            			const id = $(this).data('id');
            			// console.log(id);
            			$.ajax({
            				url: '<?= base_url; ?>' + 'kelas/getUbahSiswa',
            				data: {
            					id_siswa: id
            				},
            				method: 'post',
            				dataType: 'json',
            				success: function(data) {
            					// console.log(data);
            					$('#txt_nis').val(data.nis);
            					$('#txt_nama').val(data.nama_siswa);
            					$('#txt_alamat').val(data.alamat_siswa);
            					$('#txt_telepon').val(data.notelp_siswa);
            					$('#combo_tahun_ajaran').val(data.id_tahun_ajaran);
            					$('#txt_tahun_masuk').val(data.tahun_masuk);

            					if (data.jenis_kelamin == "L") {
            						$('#gridRadios1').prop('checked', true);
            					} else if (data.jenis_kelamin == "P") {
            						$('#gridRadios2').prop('checked', true);
            					}

            					$('#notifBawah').removeClass().html("");
            				}
            			});
            		});
            		$('.tampilModalHapus').on('click', function() {
            			const nis = $(this).data('id');
            			const nama = $(this).data('nama');
            			$('#nis_siswa_hapus').html(nis);
            			$('#nama_siswa_hapus').html(nama);
            			$('#post_nis_siswa').val(nis);
            		});
            	});
            </script>