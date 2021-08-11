<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bantuan</title>
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
						<div class="col-6">
							<h1>Silahkan baca petunjuk di bawah ini</h1>
						</div>
						<div class="col-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item">
									<a href="<?php echo base_url(); ?>">Home</a>
								</li>
								<li class="breadcrumb-item active">Bantuan</li>
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
									<h3 class="card-title">Cara mengambil antrian Drive Thru</h3>
								</div>
								<div class="card-body">
									<ol>
										<li>Silahkan pilih menu <a href="<?php echo base_url('pengambilan'); ?>">ambil antrian</a></li>
										<li>Masukkan data yang diminta
											<ul>
												<li>Nomor perkara</li>
												<li>Pihak penggugat atau tergugat</li>
												<li>Nama lengkap sesuai nama yang ada di surat panggilan sidang</li>
												<li>Nomor Handphone</li>
												<li>Tanggal Pengambilan</li>
											</ul>
										</li>
										<li>Harap dibaca juga persyaratan untuk pengambilan produk</li>
										<li>Kemudian pilih tombol ambil antrian</li>
										<li>Setelah berhasil mengambil nomor antrian, silahkan pilih tombol cetak antrian</li>
										<li>Data antrian akan tersimpan di ponsel dan bisa ditunjukkan kepada petugas ketika mengambil produk</li>
									</ol>
								</div>
								<div class="card-header">
									<h3 class="card-title">Lupa jadwal pengambilan</h3>
								</div>
								<div class="card-body">
									<ol>
										<li>Silahkan pilih menu <a href="<?php echo base_url('pengambilan/cetak'); ?>">cetak antrian</a></li>
										<li>Masukkan data yang diminta
											<ul>
												<li>Nomor perkara</li>
												<li>Nomor Handphone</li>
											</ul>
										</li>
										<li>Kemudian pilih tombol cetak antrian</li>
										<li>Data antrian akan tersimpan di ponsel dan bisa ditunjukkan kepada petugas ketika mengambil produk</li>
									</ol>
								</div>
								<div class="card-header">
									<h3 class="card-title">Untuk selengkapnya silahkan tonton video berikut</h3>
								</div>
								<div class="card-body">
									<div class="embed-responsive embed-responsive-16by9">
										<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/rcWnaydRulo" frameborder="0" allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view("_partials/footer.php") ?>
	</div>
	<!-- jQuery -->
	<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url('asset/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>
	<script>
		$(document).ready(function(){
			$("#sidebar_bantuan").addClass("active");
		});
	</script>
</body>
</html>