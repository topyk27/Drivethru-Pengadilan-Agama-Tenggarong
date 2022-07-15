<!DOCTYPE html>
<html lang="ID">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Setting - Blacklist - Ubah</title>
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
							<h1>Blacklist</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
								<li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
								<li class="breadcrumb-item"><a href="<?php echo base_url('setting/blacklist'); ?>">Blacklist</a></li>
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
                                            <label for="no_perkara">Nomor Perkara</label>
                                            <input type="text" class="form-control" value="<?php echo $data_blacklist->no_perkara; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="pihak">Pihak</label>
                                            <input type="text" class="form-control" value="<?php echo $data_blacklist->pihak; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="alasan">Alasan</label>
                                            <textarea name="alasan" id="alasan" class="form-control" rows="5"><?php echo $data_blacklist->alasan; ?></textarea>
                                            <div class="text-danger">
                                                <?php echo form_error('alasan'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="<?php echo base_url('setting/blacklist'); ?>" class="btn btn-danger">Batal</a>
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
			$("#sidebar_setting_blacklist").addClass("active");
		});
	</script>
</body>
</html>