<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="<?php echo base_url(); ?>" class="nav-link">Home</a>
		</li>
		<li class="nav-item dropdown">
			<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Antrian</a>
			<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
				<li>
					<a href="<?php echo base_url("pengambilan"); ?>" class="dropdown-item">
					Ambil Antrian
					</a>
				</li>
				<li>
					<a href="<?php echo base_url("pengambilan/cetak"); ?>" class="dropdown-item">
					Cetak Antrian
					</a>
				</li>
				<?php if($this->session->userdata('drivethru_login')): ?>
					<li>
						<a href="<?php echo base_url('bos/antrian_hari_ini') ?>" class="dropdown-item">
						Antrian Hari Ini
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('bos/semua_antrian') ?>" class="dropdown-item">
						Semua Antrian
						</a>
					</li>
				<?php endif; ?>
			</ul>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="<?php echo base_url('bantuan') ?>" class="nav-link">Bantuan</a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="javascript:Tawk_API.toggle();" class="nav-link">Chat</a>
		</li>
	<?php if($this->session->userdata('drivethru_login')): ?>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="<?php echo base_url('laporan/pengambilan') ?>" class="nav-link">Laporan</a>
		</li>
		<li class="nav-item dropdown">
			<a href="#" id="dropdownSubMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Pengaturan</a>
			<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
				<li>
					<a href="<?php echo base_url('setting/sistem'); ?>" class="dropdown-item">Sistem</a>
				</li>
				<li>
					<a href="<?php echo base_url('setting/blacklist'); ?>" class="dropdown-item">Blacklist</a>
				</li>
				<li>
					<a href="<?php echo base_url('setting/libur'); ?>" class="dropdown-item">Libur</a>
				</li>
			</ul>
		</li>
	<?php endif; ?>
	</ul>
<?php if($this->session->userdata('drivethru_login')): ?>
	<ul class="navbar-nav ml-auto">
		<li class="nav-item d-none d-sm-inline-block">
			<a href="#" id="btn-logout" class="nav-link">
				<span><?php echo $this->session->userdata('drivethru_nama'); ?> <i class="fas fa-sign-out-alt"></i></span>
			</a>
		</li>
	</ul>
	<div id="modal-logout" class="modal fade" tabindex="-1" role="dialog" data-backdrop="false">
		<div class="modal-dialog modal-dialog-centered modal-confirm">
			<div class="modal-content">
				<div class="modal-header flex-column">
					<div class="icon-box">
						<i class="material-icons">exit_to_app</i>
					</div>
					<h4 class="modal-title w-100">Sign Out</h4>
				</div>
				<div class="modal-body">
					<p>Apakah anda ingin keluar?</p>
				</div>
				<div class="modal-footer justify-content-center">
					<div class="row">
						<div class="col-6">
							<a href="<?php echo base_url('bos/logout'); ?>" class="btn btn-success btn-block" style="color:#FFF;">Keluar</a>
						</div>
						<div class="col-6">
							<button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Batal</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		function modal_logout()
		{
			$("#modal-logout").modal('show');
		}
		document.getElementById('btn-logout').onclick=modal_logout; 
	</script>
<?php endif; ?>
</nav>