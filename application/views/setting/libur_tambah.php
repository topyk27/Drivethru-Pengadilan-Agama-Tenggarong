<!DOCTYPE html>
<html lang="ID">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Setting - Libur - Tambah</title>
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
							<h1>Libur</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
								<li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
								<li class="breadcrumb-item"><a href="<?php echo base_url('setting/libur'); ?>">Libur</a></li>
								<li class="breadcrumb-item active">Tambah</li>
							</ol>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-sm-12" id="respon"></div>
					</div>
				</div>
			</section>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Tambah Data</h3>
								</div>
								<form role="form" method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" name="tanggal" id="tanggal" class="form-control col-sm-3 <?php echo form_error('tanggal') ? 'is-invalid' : '' ?>" value="<?php echo set_value('tanggal', date("Y-m-d")); ?>" required>
                                            <div class="invalid-feedback">
                                                <?php echo form_error('tanggal'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="libur">Libur</label>
                                            <input type="text" name="libur" id="libur" class="form-control <?php echo form_error('libur') ? 'is-invalid' : '' ?>" value="<?php echo set_value('libur'); ?>" required placeholder="Apabila hari libur lebih dari satu, silahkan gunakan kata hubung seperti pelajaran Bahasa Indonesia yang baik dan benar">
                                            <div class="invalid-feedback">
                                                <?php echo form_error('libur'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button id="btn_simpan" type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="<?php echo base_url('setting/libur'); ?>" class="btn btn-danger">Batal</a>
                                    </div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view("_partials/footer.php") ?>
		<aside class="control-sidebar control-sidebar-dark"></aside>
	</div>

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
	<script type="text/javascript">        
		$(document).ready(function(){			
			$("#sidebar_setting").addClass("active");
			$("#sidebar_setting_libur").addClass("active");			
		});
	</script>
</body>
</html>