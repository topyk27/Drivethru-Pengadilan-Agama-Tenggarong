<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cetak Antrian</title>
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
							<h1>Cetak Antrian</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item">
									<a href="<?php echo base_url(); ?>">Home</a>
								</li>
								<li class="breadcrumb-item">Antrian</li>
								<li class="breadcrumb-item active">Cetak Antrian</li>
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
									<h3 class="card-title">Silahkan isi data di bawah ini</h3>
								</div>
								<form role="form" method="post">
									<div class="card-body">
										<div class="form-group">
											<label for="no_perkara">Nomor Perkara ( Contoh : 695/Pdt.G/2020/<?php echo $this->session->userdata('nama_pa_pendek'); ?> )</label>
											<input type="text" name="no_perkara" class="form-control <?php echo form_error('no_perkara') ? 'is-invalid' : '' ?>" value="<?php echo set_value('no_perkara'); ?>" placeholder="695/Pdt.G/2020/<?php echo $this->session->userdata('nama_pa_pendek'); ?>" required>
											<div class="invalid-feedback">
												<?php echo form_error('no_perkara'); ?>
											</div>
										</div>

										<div class="form-group">
											<label for="no_hp">Nomor HP</label>
											<input type="text" name="no_hp" class="form-control <?php echo form_error('no_hp') ? 'is-invalid' : '' ?>" value="<?php echo set_value('no_hp'); ?>" placeholder="081234567890" required>
											<div class="invalid-feedback">
												<?php echo form_error('no_hp'); ?>
											</div>
										</div>
									</div>
									<!-- alert -->
									<div class="alert alert-success" role="alert" style="display: none;">
										<h4 class="alert-heading">Mohon maaf</h4>
										<p>Anda belum mendaftar untuk pengambilan Drive Thru.</p>
										<p>Silahkan untuk melakukan pendaftaran terlebih dahulu.</p>
										<hr>
										<a href="#" class="btn btn-primary btn-block">Klik di sini untuk mendaftar</a>
									</div>
									<!-- end alert -->
									<div class="card-footer">
										<button type="submit" class="btn btn-primary btn-lg btn-block">Cetak Antrian</button>
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
	</div>
	<!-- modal -->
	<div id="modal" class="modal fade" data-backdrop="static">
	  <div class="modal-dialog modal-dialog-centered modal-confirm modal-sm">
	    <div class="modal-content">
	      <div class="modal-header flex-column">
	        <div class="icon-box">
	          <i class="material-icons" id="responSimbol">close</i>
	        </div>
	        <h4 class="modal-title w-100" id="modal_titel">Ada yang salah</h4>
	        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
	      </div>
	      <div class="modal-body">
	        <p id="modal_body">
	        	Anda belum terdaftar, silahkan ambil antrian terlebih dahulu.
	        </p>
	      </div>
	      <div class="modal-footer justify-content-center">
	        <button id="modal_footer" type="button" class="btn btn-primary btn-lg btn-block" data-dismiss="modal">Tutup</button>
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
	<?php
		if($this->session->flashdata('respon') != null)
		{
			if($this->session->flashdata('respon') == 'kosong')
			{
	?>
				<script type="text/javascript">
					$('#modal').modal('show');
				</script>
	<?php 
			}
		}
	 ?>
	 <?php $this->load->view("_partials/token.php") ?>	
	 <script type="text/javascript">
	 	$(document).ready(function(){
	 		$("#sidebar_antrian").addClass("active");
	 		$("#sidebar_cetak").addClass("active");
	 	});
	 </script>
</body>
</html>