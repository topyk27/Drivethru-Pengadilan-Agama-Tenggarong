<nav class="mt-2">
	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
		<li class="nav-item">
			<a href="<?php echo base_url(); ?>" class="nav-link" id="sidebar_home">
				<i class="nav-icon fas fa-home"></i>
				<p>Home</p>
			</a>
		</li>
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
	<?php if($this->session->userdata('login')): ?>
		<li class="nav-item has-treeview">
			<a href="#" class="nav-link" id="sidebar_antrian">
				<i class="nav-icon fas fa-calendar-week"></i>
				<p>
					Antrian
					<i class="fas fa-angle-left right"></i>
				</p>
			</a>
			<ul class="nav nav-treeview">
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
			</ul>
		</li>
	<?php endif; ?>
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
	</ul>
</nav>