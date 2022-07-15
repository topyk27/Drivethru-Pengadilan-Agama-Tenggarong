<nav class="mt-2">
	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
		<li class="nav-item">
			<a href="<?php echo base_url(); ?>" class="nav-link" id="sidebar_home">
				<i class="nav-icon fas fa-home"></i>
				<p>Home</p>
			</a>
		</li>
		<li class="nav-item has-treeview">
			<a href="#" class="nav-link" id="sidebar_antrian">
				<i class="nav-icon fas fa-calendar-week"></i>
				<p>Antrian <i class="fas fa-angle-left right"></i></p>
			</a>
			<ul class="nav nav-treeview">
				<li class="nav-item">
					<a href="<?php echo base_url('pengambilan'); ?>" class="nav-link" id="sidebar_pengambilan">
						<i class="nav-icon fas fa-receipt"></i>
						<p>Ambil Antrian</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('pengambilan/cetak'); ?>" class="nav-link" id="sidebar_cetak">
						<i class="nav-icon fas fa-print"></i>
						<p>Cetak Antrian</p>
					</a>
				</li>
				<?php if($this->session->userdata('drivethru_login')): ?>
					<li class="nav-item">
						<a href="<?php echo base_url('bos/antrian_hari_ini'); ?>" class="nav-link" id="sidebar_antrian_hari_ini">
							<i class="nav-icon fas fa-calendar-week"></i>
							<p>Antrian Hari Ini</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo base_url('bos/semua_antrian') ?>" class="nav-link" id="sidebar_semua_antrian">
							<i class="nav-icon fas fa-list"></i>
							<p>Semua Antrian</p>
						</a>
					</li>
				<?php endif; ?>
			</ul>
		</li>
		<li class="nav-item">
			<a href="<?php echo base_url('bantuan') ?>" class="nav-link" id="sidebar_bantuan">
				<i class="nav-icon fas fa-question-circle"></i>
				<p>Bantuan</p>
			</a>
		</li>
		<li class="nav-item">
			<a href="javascript:Tawk_API.toggle();" class="nav-link" id="sidebar_bantuan">
				<i class="nav-icon fas fa-comment-dots"></i>
				<p>Chat</p>
			</a>
		</li>
	<?php if($this->session->userdata('drivethru_login')): ?>
		<li class="nav-item">
			<a href="<?php echo base_url('laporan/pengambilan') ?>" class="nav-link" id="sidebar_laporan">
				<i class="nav-icon fas fa-file"></i>
				<p>Laporan</p>
			</a>
		</li>
		<li class="nav-item has-treeview">
			<a href="#" class="nav-link" id="sidebar_setting">
				<i class="nav-icon fas fa-cog"></i>
				<p>Pengaturan <i class="fas fa-angle-left right"></i></p>
			</a>
			<ul class="nav nav-treeview">
				<li class="nav-item">
					<a href="<?php echo base_url('setting/sistem') ?>" class="nav-link" id="sidebar_setting_sistem">
						<i class="nav-icon fas fa-rocket"></i>
						<p>Sistem</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('setting/blacklist') ?>" class="nav-link" id="sidebar_setting_blacklist">
						<i class="nav-icon fas fa-ban"></i>
						<p>Blacklist</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('setting/libur') ?>" class="nav-link" id="sidebar_setting_libur">
						<i class="nav-icon fas fa-mug-hot"></i>
						<p>Libur</p>
					</a>
				</li>
			</ul>
		</li>
		<li class="nav-item">
			<a href="#" class="nav-link" id="sidebar_logout" onclick="modal_logout()">
				<i class="nav-icon fas fa-sign-out-alt"></i>
				<p>Keluar</p>
			</a>
		</li>
	<?php endif; ?>
	</ul>
</nav>
<script type="text/javascript" src="https://uprimp.com/bnr.php?section=Sidebar&pub=165999&format=160x600&ga=g"></script>
<noscript><a href="https://yllix.com/publishers/165999" target="_blank"><img src="//ylx-aff.advertica-cdn.com/pub/160x600.png" style="border:none;margin:0;padding:0;vertical-align:baseline;" alt="ylliX - Online Advertising Network" /></a></noscript>