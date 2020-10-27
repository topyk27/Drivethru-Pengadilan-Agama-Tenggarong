<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Drive Thru | PA Tenggarong</title>
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
											<label for="no_perkara">Nomor Perkara ( Contoh : 695/Pdt.G/2020/PA.Tgr )</label>
											<input type="text" name="no_perkara" class="form-control <?php echo form_error('no_perkara') ? 'is-invalid' : '' ?>" value="<?php echo set_value('no_perkara'); ?>" placeholder="695/Pdt.G/2020/PA.Tgr" required>
											<div class="invalid-feedback">
												<?php echo form_error('no_perkara'); ?>
											</div>
										</div>

										<div class="form-group">
											<label style="margin-right: 10px;">Pihak</label>
											<div class="form-check form-check-inline">
												<input type="radio" name="pihak" class="form-check-input <?php echo form_error('pihak') ? 'is-invalid' : '' ?>" value="penggugat" <?php echo set_radio('pihak', 'penggugat'); ?>>
												<label class="form-check-label" for="pihak">Penggugat</label>
											</div>
											<div class="form-check form-check-inline">
												<input type="radio" name="pihak" class="form-check-input <?php echo form_error('pihak') ? 'is-invalid' : '' ?>" value="tergugat" <?php echo set_radio('pihak', 'tergugat'); ?>>
												<label class="form-check-label" for="pihak">Tergugat</label>
											</div>
											<div class="invalid-feedback">
												<?php echo form_error('pihak'); ?>
											</div>
										</div>

										<div class="form-group">
											<label for="nama">Nama Lengkap ( Contoh : Ismi Haulainil Fitri binti Abdul Wa'it )</label>
											<input type="text" name="nama" class="form-control <?php echo form_error('nama') ? 'is-invalid' : '' ?>" value="<?php echo set_value('nama'); ?>" placeholder="Nama lengkap" required>
											<div class="invalid-feedback">
												<?php echo form_error('nama'); ?>
											</div>
										</div>

										<div class="form-group">
											<label for="no_hp">Nomor HP</label>
											<input type="text" name="no_hp" class="form-control <?php echo form_error('no_hp') ? 'is-invalid' : '' ?>" value="<?php echo set_value('no_hp'); ?>" placeholder="081234567890" required>
											<div class="invalid-feedback">
												<?php echo form_error('no_hp'); ?>
											</div>
										</div>

										<div class="form-group" style="display: none;">
											<label for="no_ac">Nomor Akta Cerai</label>
											<input type="text" name="no_ac" class="form-control <?php echo form_error('no_ac') ? 'is-invalid' : '' ?>" value="<?php echo set_value('no_ac'); ?>" required readonly="readonly" disabled>
											<div class="invalid-feedback">
												<?php echo form_error('no_ac'); ?>
											</div>
										</div>

										<div class="form-group">
											<label for="jadwal">Tanggal Pengambilan</label>
											<input type="date" name="jadwal" class="form-control col-sm-3 <?php echo form_error('jadwal') ? 'is-invalid' : '' ?>" value="<?php echo set_value('jadwal', date('Y-m-d')); ?>" required>
											<div class="invalid-feedback">
												<?php echo form_error('jadwal'); ?>
											</div>
										</div>

										<div class="form-group">
											<p class="lead">Untuk persyaratan pengambilan produk Pengadilan Agama Tenggarong, silahkan anda menyiapkan :</p>
											<ul class="list-group">
												<li class="list-group-item d-flex justify-content-between align-items-center">
													Fotokopi KTP
													<span class="badge badge-primary badge-pill">1 Lembar</span>
												</li>
											</ul>
										</div>

										<div class="form-group">
											<p class="lead">Untuk pengambilan menggunakan surat kuasa, silahkan anda menyiapkan :</p>
											<ul class="list-group">
												<li class="list-group-item d-flex justify-content-between align-items-center">
													Surat kuasa bermaterai 6000 dan sudah bertanda tangan
													<span class="badge badge-primary badge-pill">Asli</span>
												</li>
												<li class="list-group-item d-flex justify-content-between align-items-center">
													Fotokopi KTP pemberi kuasa
													<span class="badge badge-primary badge-pill">1 Lembar</span>
												</li>
												<li class="list-group-item d-flex justify-content-between align-items-center">
													Fotokopi KTP penerima kuasa
													<span class="badge badge-primary badge-pill">1 Lembar</span>
												</li>
											</ul>
										</div>

										<div class="form-group">
											<p class="lead">Biaya pengambilan produk Pengadilan Agama Tenggarong :</p>
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

												<dt class="col-sm-3">
													Legalisir
												</dt>
												<dd class="col-sm-9">
													Rp. 10.000 / lembar
												</dd>
											</dl>
										</div>
									</div>
									<div class="card-footer">
										<button type="submit" class="btn btn-primary btn-lg btn-block">Ambil Antrian</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view("_partials/footer.php") ?>
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
	        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
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
	<script type="text/javascript">
		if($('.invalid-feedback').is(':visible'))
		{
			$("#responSimbol").text('close');
			$("#modal_titel").text('Kesalahan');
			$("#modal_body").text('Ada yang salah, silahkan periksa formulir yang anda isi.');
			$("#modal_footer").show();
			$("#modal_footer").text('Periksa');
			$('#modal').modal('show');
		}
		$(document).ready(function(){
			$("#sidebar_pengambilan").addClass("active");
		});
	</script>

</body>
</html>