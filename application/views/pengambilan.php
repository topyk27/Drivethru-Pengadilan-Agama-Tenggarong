<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Drive Thru | PA <?php echo $this->session->userdata('nama_pa'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->load->view("_partials/css.php") ?>
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<?php $this->load->view("_partials/navbar.php") ?>
		<?php $this->load->view("_partials/sidebar_container.php") ?>
		<div class="content-wrapper">
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Ambil Antrian</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item">
									<a href="<?php echo base_url(); ?>">Home</a>
								</li>
								<li class="breadcrumb-item">Antrian</li>
								<li class="breadcrumb-item active">Ambil Antrian</li>
							</ol>
						</div>
					</div>
				</div>
			</section>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Silahkan isi formulir di bawah ini</h3>
								</div>
								<form role="form" method="post">
									<div class="card-body">
										<div class="form-group">
											<label for="jenis_perkara">Jenis Perkara</label>
											<select class="form-control <?php echo form_error('jenis_perkara') ? 'is-invalid' : '' ?>" name="jenis_perkara">
												<option>Pilih Jenis Perkara</option>
												<option value="/Pdt.G/" <?php echo set_select('jenis_perkara', '/Pdt.G/'); ?>>Gugatan</option>
												<option value="/Pdt.P/" <?php echo set_select('jenis_perkara', '/Pdt.P/'); ?>>Permohonan</option>
											</select>
										</div>

										<div class="form-row" id="row_perkara">
											<div class="col-md-5">
												<label for="no_perkara">Nomor Perkara</label>
												<input type="text" class="form-control <?php echo form_error('no_perkara') ? 'is-invalid' : '' ?>" name="no_perkara" value="<?php echo set_value('no_perkara'); ?>" placeholder="1262" required="" id="no_perkara">
												<div class="invalid-feedback">
												  <?php echo form_error('no_perkara') ?>
												</div>
											</div>
											<div class="col-md-1 mt-auto">
												<input type="text" name="perkara" class="form-control" readonly="" value="<?php echo set_value('jenis_perkara') ?>">
											</div>
											<div class="col-md-5">
												<label for="no_perkara_tahun">Tahun</label>
												<input type="text" class="form-control <?php echo form_error('no_perkara_tahun') ? 'is-invalid' : '' ?>" name="no_perkara_tahun" value="<?php echo set_value('no_perkara_tahun'); ?>" placeholder="2019" required="">
												<div class="invalid-feedback">
												  <?php echo form_error('no_perkara_tahun') ?>
												</div>
											</div>
											<div class="col-auto mt-auto">
												<button type="button" class="btn btn-success" id="btn_cek_perkara">Check</button>
											</div>
										</div>

										<div class="form-group" id="row_pihak" style="display: none;">
											<label for="pihak">Pihak</label>
											<select class="form-control <?php echo form_error('pihak') ? 'is-invalid' : '' ?>" name="pihak">
												<option>Pilih Pihak</option>
												<option value="penggugat" <?php echo set_select('pihak', 'penggugat'); ?>>Penggugat</option>
												<option value="tergugat" <?php echo set_select('pihak', 'tergugat'); ?>>Tergugat</option>
											</select>
											<div class="invalid-feedback">
												<?php echo form_error('pihak'); ?>
											</div>
										</div>

										<div id="sembunyikan" style="display: none;">
											<div class="form-group">
												<label for="nama">Nama</label>
												<input type="text" class="form-control <?php echo form_error('nama') ? 'is-invalid':'' ?>" name="nama" value="<?php echo set_value('nama'); ?>" placeholder="Nama Lengkap" required readonly>
												<div class="invalid-feedback">
												  <?php echo form_error('nama') ?>
												</div>
											</div>

											<div class="form-group" style="display: none;">
												<label for="no_ac">Nomor Akta Cerai</label>
												<input type="text" class="form-control <?php echo form_error('no_ac') ? 'is-invalid':'' ?>" name="no_ac" value="<?php echo set_value('no_ac'); ?>" required readonly>
											</div>

											<div class="form-group">
												<label for="no_hp">Nomor HP</label>
												<input type="text" class="form-control <?php echo form_error('no_hp') ? 'is-invalid':'' ?>" name="no_hp" value="<?php echo set_value('no_hp'); ?>" placeholder="Nomor HP" required>
												<div class="invalid-feedback">
												  <?php echo form_error('no_hp') ?>
												</div>
											</div>

											<div class="form-group">
												<label for="pengambilan[]">Produk yang ingin diambil</label>
												<div class="form-check">
													<input class="form-check-input" type="checkbox" name="pengambilan[]" id="pengambilan_ac" value="ac">
													<label class="form-check-label" for="pengambilan_ac">Akta Cerai</label>
													<span class="text-danger" id="text_ac_belum_terbit" style="display: none;"> belum terbit</span>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="checkbox" name="pengambilan[]" id="pengambilan_salinan" value="salinan">
													<label class="form-check-label" for="pengambilan_salinan">Salinan Putusan / Penetapan</label>
												</div>
												<div class="invalid-feedback d-block">
													<?php echo form_error('pengambilan[]'); ?>
												</div>
											</div>

											<div class="form-group">
												<label for="jadwal">Tanggal Pengambilan</label>
												<input type="date" name="jadwal" class="form-control col-sm-3 <?php echo form_error('jadwal') ? 'is-invalid' : '' ?>" value="<?php echo set_value('jadwal', date('Y-m-d')); ?>" required>
												<div class="invalid-feedback">
													<?php echo form_error('jadwal'); ?>
												</div>
											</div>
										</div>

										<div class="form-group">
											<p class="lead">Untuk persyaratan pengambilan produk Pengadilan Agama <?php echo $this->session->userdata('nama_pa'); ?>, silahkan anda menyiapkan :</p>
											<ul class="list-group">
												<li class="list-group-item d-flex justify-content-between align-items-center">
													Fotokopi KTP atau SIM
													<span class="badge badge-primary badge-pill">1 Lembar</span>
												</li>
											</ul>
											<p class="lead bg-info mt-3 pl-3">Pengambilan produk akta cerai tidak bisa diwakilkan, harus yang bersangkutan untuk mengambil.</p>
										</div>

										<div class="form-group">
											<p class="lead">Biaya pengambilan produk Pengadilan Agama <?php echo $this->session->userdata('nama_pa'); ?> :</p>
											<dl class="row">
												<dt class="col-sm-3">
													Akta Cerai
												</dt>
												<dd class="col-sm-9">
													Rp. 10.000
												</dd>

												<dt class="col-sm-3">
													Salinan Putusan / Penetapan
												</dt>
												<dd class="col-sm-9">
													Rp. 500 / lembar
												</dd>
												
											</dl>
										</div>

										<div class="form-group">
											<p class="lead">Silahkan datang pukul 10.00 membawa persyaratan yang sudah ditentukan dan diharapkan untuk membawa uang pas.
											Dimohon untuk memasukkan nomor handphone yang dapat dihubungi. Terima Kasih. </p>
										</div>
									</div>
									<div class="card-footer">
										<button id="btn_ambil" type="submit" class="btn btn-primary btn-lg btn-block">Ambil Antrian</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view("_partials/footer.php") ?>
		<?php $this->load->view("_partials/numpang.php") ?>
		<?php $this->load->view("_partials/loader.php") ?>
	</div>
	<!-- modal -->
	<div id="modal" class="modal fade" data-backdrop="static">
	  <div class="modal-dialog modal-dialog-centered modal-confirm modal-sm">
	    <div class="modal-content">
	      <div class="modal-header flex-column">
	        <div class="icon-box">
	          <i class="material-icons" id="responSimbol"></i>
	        </div>
	        <h4 class="modal-title w-100" id="modal_titel"></h4>
	      </div>
	      <div class="modal-body">
	        <p id="modal_body"></p>
	      </div>
	      <div class="modal-footer justify-content-center">
	      	<a href="<?php echo base_url('pengambilan/cetak_antrian') ?>" id="modal_footer_cetak" class="btn btn-primary btn-lg btn-block" style="color: #fff; display: none;">Cetak Antrian</a>
	        <button id="modal_footer" type="button" class="btn btn-primary btn-lg btn-block" data-dismiss="modal" style="display: none;"></button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- jQuery -->
	<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url('asset/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>

	<!-- flashdata -->
	<?php 
			// print_r($this->session->flashdata('respon'));
			if($this->session->flashdata('respon')!= null)
			{
				if($this->session->flashdata('respon') == 1)
				{
	?>
					<script type="text/javascript">
						$("#responSimbol").text('done');
						$("#modal_titel").text('NO Antrian anda <?php echo $this->session->flashdata('antrian'); ?> ');
						// $("#modal_body").text('Silahkan datang pada tanggal '+ <?php echo $this->session->flashdata('jadwal'); ?> + ' pukul 10.00 - 12.00 dan membawa persyaratan yang sudah ditentukan');
						$("#modal_body").text('Silahkan datang pada tanggal <?php echo $this->session->flashdata('jadwal'); ?> pukul 10.00 - 12.00 dan membawa persyaratan yang sudah ditentukan');
						$("#modal_footer_cetak").show();
						$("#modal_footer").hide();
						$('#modal').modal('show');
					</script>
	<?php
				}
				else
				{
	?>
					<script type="text/javascript">
						$("#responSimbol").text('close');
						$("#modal_titel").text("Kesalahan");
						$("#modal-body").text("Ada yang salah, silahkan periksa koneksi internet anda.");
						$("#modal_footer_cetak").hide();
						$("#modal_footer").text('Tutup');
						$("#modal_footer").show();
						$('#modal').modal('show');
					</script>
	<?php
				}
			}
	?>
	<?php $this->load->view("_partials/token.php"); ?>	
	<script src="<?php echo base_url('asset/mine/js/pengambilan.min.js'); ?>"></script>

</body>
</html>