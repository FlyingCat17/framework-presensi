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
												<th scope="col" style="width: 150px; text-align: center;">Ubah / Hapus
												</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											if (!empty($data['data_siswa'])) {
												foreach ($data['data_siswa'] as $siswa) : ?>
													<tr>
														<th scope="row">
															<?= $no ?>
														</th>
														<td>
															<?= $siswa['nis']; ?>
														</td>
														<td>
															<?= $siswa['nama_siswa']; ?>
														</td>
														<td>
															<?= $siswa['jenis_kelamin']; ?>
														</td>
														<td>
															<button type="button" data-nis="<?= $siswa['nis'] ?>" class="btn btn-icon btn-warning" id="btn-ubah-siswa" onclick="location.href='<?= base_url; ?>siswa/ubah/<?= $siswa['nis'] ?>'">
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
								<div class="col-sm-12 col-md-5">
									<div class="dataTables_info" id="data-table_info" role="status" aria-live="polite">Showing <?= $data['halaman_aktif'] ?> to <?= $data['halaman_akhir'] ?> of <?= $data['jumlah_data'] ?> entries</div>
								</div>
								<div class="col-sm-12 col-md-7">
									<div class="dataTables_paginate paging_simple_numbers" id="data-table_paginate">
										<ul class="pagination">
											<?php
											$jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
											$start_number = ($data['halaman_aktif'] > $jumlah_number) ? $data['halaman_aktif'] - $jumlah_number : 1; // Untuk awal link number
											$end_number = ($data['halaman_aktif'] < ($data['jumlah_halaman'] - $jumlah_number)) ? $data['halaman_aktif'] + $jumlah_number : $data['jumlah_halaman']; // Untuk akhir link number
											for ($i = $start_number; $i <= $end_number; $i++) {
												$link_active = ($data['halaman_aktif'] == $i) ? 'active' : '';
											?>
												<li class="paginate_button page-item <?= $link_active; ?>">
													<a href="<?= base_url; ?>siswa/page/<?= $i; ?>" aria-controls="data-table" data-dt-idx="1" tabindex="0" class="page-link"><?= $i; ?></a>
												</li>
											<?php
											}
											?>
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
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Content Wrapper END -->
				<!-- Hapus Siswa Modal -->
				<div class="modal fade" id="model_hapus_siswa">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<form action="<?= base_url; ?>siswa/delete/" method="post">
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
									<button type="submit" name="submit_hapus" class="btn btn-danger">Hapus</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Hapus Siswa Modal -->
			</div>
		</div>

		<script>
			$('.datepicker-input').datepicker({
				format: 'yyyy-mm-dd'
			});


			$(document).ready(function() {
				$('.tampilModalHapus').on('click', function() {
					$('.modal-content form').attr('action', '<?= base_url; ?>siswa/hapus/' + $(this).data('nis'));
					$('#post_nis_siswa').val($(this).data('nis'));
					$('#nis_siswa_hapus').html($(this).data('nis'));
					$('#nama_siswa_hapus').html($(this).data('nama'));
				});
			});
		</script>