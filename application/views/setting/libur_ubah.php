<!DOCTYPE html>
<html lang="ID">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Setting - Libur - Ubah</title>
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
								<li class="breadcrumb-item active">Ubah</li>
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
									<h3 class="card-title">Ubah Data</h3>
								</div>
                                <form role="form" method="POST">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" name="tanggal" id="tanggal" class="form-control col-sm-3 <?php echo form_error('tanggal') ? 'is-invalid' : '' ?>" value="<?php echo $data_libur->tanggal; ?>" required>
                                            <div class="invalid-feedback">
                                                <?php echo form_error('tanggal'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="libur">Libur</label>
                                            <input type="text" name="libur" id="libur" class="form-control <?php echo form_error('libur') ? 'is-invalid' : '' ?>" value="<?php echo $data_libur->nama; ?>" required placeholder="Apabila hari libur lebih dari satu, silahkan gunakan kata hubung seperti pelajaran Bahasa Indonesia yang baik dan benar">
                                            <div class="invalid-feedback">
                                                <?php echo form_error('libur'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
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