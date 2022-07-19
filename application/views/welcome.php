<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Drive Thru | PA <?php echo empty($ttd->nama_pa) ? "false" : $ttd->nama_pa; ?></title>
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
						<div class="col-12">
							<h1>Selamat Datang di Drive Thru Pengadilan Agama <?php echo empty($ttd->nama_pa) ? "false" : $ttd->nama_pa; ?></h1>
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
									<h3 class="card-title" id="title_statistik">Statistik Pengambilan Drive Thru</h3>
								</div>
								<div class="card-body">
									<div class="chart">
										<canvas id="barChart" style="min-height: 250px; max-height: 250px; max-width: 100%"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view("_partials/footer.php") ?>
		<?php $this->load->view("_partials/loader.php") ?>
	</div>
	<!-- jQuery -->
	<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
	<!-- ChartJS -->
	<script src="<?php echo base_url('asset/chart.js/Chart.min.js') ?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url('asset/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
	<!-- Moment -->
	<script src="<?php echo base_url('asset/moment/moment-with-locales.min.js') ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>
	<script>
		const base_url = "<?php echo base_url(); ?>";		
		var token = "<?php echo empty($ttd->token) ? "false" : $ttd->token; ?>";
		var nama_pa = "<?php echo empty($ttd->nama_pa) ? "false" : $ttd->nama_pa; ?>";
		var nama_pa_pendek = "<?php echo empty($ttd->nama_pa_pendek) ? "false" : $ttd->nama_pa_pendek; ?>";
	</script>
	<script src="<?php echo base_url('asset/mine/js/welcome.min.js'); ?>"></script>
</body>
</html>