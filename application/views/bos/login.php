<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin | Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->load->view("_partials/css.php") ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- modal -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/mine/css/modal.css') ?>">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<div class="row justify-content-center align-items-center">
				<div class="col-3">
					<img src="<?php echo base_url('asset/img/logo_patgr.png'); ?>" class="brand-image img-circle elevation-3" width="75px" height="100px">
				</div>
				<div class="col-9">
					<a href="#"><b>PA</b> <?php echo $this->session->userdata('nama_pa'); ?></a>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body login-card-body">
				<p class="login-box-msg">Silahkan login</p>
				<form method="POST" role="form">
					<div class="input-group mb-3">
						<input type="text" name="username" class="form-control <?php echo form_error('username') ? 'is-invalid' : '' ?>" value="<?php echo set_value('username'); ?>" placeholder="Username">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" name="password" class="form-control <?php echo form_error('password') ? 'is-invalid' : '' ?>" value="<?php echo set_value('password'); ?>" placeholder="Password">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<!-- <div class="col-8">
							<div class="icheck-primary">
								<input type="checkbox" name="remember" id="remember">
								<label for="remember">
									Ingat Saya
								</label>
							</div>
						</div> -->
						<div class="col-12">
							<button type="submit" class="btn btn-primary btn-block">Login</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- modal -->
		<div id="modal" class="modal fade" data-backdrop="static">
			<div class="modal-dialog modal-confirm">
				<div class="modal-content">
					<div class="modal-header flex-column">
						<div class="icon-box">
							<i class="material-icons">close</i>
						</div>
						<h4 class="modal-title w-100">Ada yang salah</h4>
					</div>
					<div class="modal-body">
						<p>Username atau Password salah.</p>
					</div>
					<div class="modal-footer justify-content-center">
						<button type="button" class="btn btn-primary btn-lg btn-block" data-dismiss="modal">OK</button>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view("_partials/loader.php") ?>
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
			if($this->session->flashdata('respon') == "kosong")
			{
	?>
				<script type="text/javascript">
					$('#modal').modal('show');
				</script>
	<?php 
			}
		}
	 ?>
	 <script type="text/javascript">
	 	var token = "<?php echo empty($ttd->token) ? "false" : $ttd->token; ?>";
	 	var nama_pa = "<?php echo empty($ttd->nama_pa) ? "false" : $ttd->nama_pa; ?>";
	 	var nama_pa_pendek = "<?php echo empty($ttd->nama_pa_pendek) ? "false" : $ttd->nama_pa_pendek; ?>";
	 	if(token=="false")
	 	{
	 		location.replace("<?php echo base_url('aktivasi'); ?>");
	 	}
	 	$.ajax({
	 		url: "https://raw.githubusercontent.com/topyk27/Drivethru-Pengadilan-Agama-Tenggarong/master/asset/mine/token/token.json",
	 		method: "GET",
	 		dataType: 'json',
	 		beforeSend: function(){
	 			$(".loader2").show();
	 		},
	 		success: function(data)
	 		{
	 			try{
	 				if(nama_pa==data[nama_pa_pendek][0].nama_pa && nama_pa_pendek==data[nama_pa_pendek][0].nama_pa_pendek && token==data[nama_pa_pendek][0].token)
	 				{
	 					
	 				}
	 				else
	 				{
	 					location.replace("<?php echo base_url('aktivasi'); ?>");
	 				}
	 			}
	 			catch(err)
	 			{
	 				location.replace("<?php echo base_url('aktivasi'); ?>");
	 			}
	 			$(".loader2").hide();
	 		},
	 		error: function(err)
	 		{
	 			$.ajax({
	 				url: "<?php echo base_url('asset/mine/token/token.json'); ?>",
	 				method: "GET",
	 				dataType: 'json',
	 				success: function(lokal)
	 				{
	 					try {
	 						if(nama_pa==lokal[nama_pa_pendek][0].nama_pa && nama_pa_pendek==lokal[nama_pa_pendek][0].nama_pa_pendek && token==lokal[nama_pa_pendek][0].token)
	 						{
	 							
	 						}
	 						else
	 						{
	 							location.replace("<?php echo base_url('aktivasi'); ?>");
	 						}
	 					}
	 					catch(err)
	 					{
	 						location.replace("<?php echo base_url('aktivasi'); ?>");
	 					}
	 					$(".loader2").hide();
	 				},
	 				error: function(err)
	 				{
	 					$(".loader2").hide();
	 					alert('Gagal dapat data token, harap hubungi administrator');
	 				}
	 			});
	 		}
	 	});
	 </script>
</body>
</html>