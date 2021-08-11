<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<a href="<?php echo base_url(); ?>" class="brand-link">
		<img src="<?php echo base_url('asset/img/logo.png'); ?>" alt="PA <?php echo $this->session->userdata('nama_pa'); ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">PA <?php echo $this->session->userdata('nama_pa'); ?></span>
	</a>
	<div class="sidebar">
		<?php $this->load->view("_partials/sidebar.php") ?>
	</div>
</aside>