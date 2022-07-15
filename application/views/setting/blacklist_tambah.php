<!DOCTYPE html>
<html lang="ID">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Setting - Blacklist - Tambah</title>
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
											<label for="jenis_perkara">Jenis Perkara</label>
											<select name="jenis_perkara" id="jenis_perkara" class="form-control">
												<option value="0">Pilih Jenis Perkara</option>
												<option value="gugatan" <?php echo set_select('jenis_perkara', 'gugatan'); ?>>Gugatan</option>
												<option value="permohonan" <?php echo set_select('jenis_perkara', 'permohonan'); ?>>Permohonan</option>
											</select>
										</div>
										<div class="form-row" style="display: none;" id="row_perkara">
											<div class="col-md-5">
												<label for="no_urut">Nomor Perkara</label>
												<input type="text" class="form-control <?php echo form_error('no_urut') ? 'is-invalid' : '' ?>" name="no_urut" value="<?php echo set_value('no_urut'); ?>" placeholder="1262" required id="no_urut">
												<div class="invalid-feedback">
													<?php echo form_error('no_urut'); ?>
												</div>
											</div>
											<div class="col-md-1 mt-auto">
												<input type="text" name="perkara" class="form-control" readonly value="<?php echo set_value('jenis_perkara') ?>">
												<input type="hidden" name="no_perkara">
											</div>
											<div class="col-md-5">
												<label for="no_perkara_tahun">Tahun</label>
												<input type="text" class="form-control <?php echo form_error('no_perkara_tahun') ? 'is-invalid' : '' ?>" name="no_perkara_tahun" value="<?php echo set_value('no_perkara_tahun'); ?>" placeholder="2019" required>
												<div class="invalid-feedback">
													<?php echo form_error('no_perkara_tahun'); ?>
												</div>
											</div>
											<div class="col-auto mt-auto">
												<button type="button" class="btn btn-success" id="btn_cek_perkara">Check</button>
											</div>
										</div>
										<div class="form-group" id="row_pihak" style="display: none;">
											<label for="pihak">Pihak</label>
											<select name="pihak" id="pihak" class="form-control <?php echo form_error('pihak') ? 'is-invalid' : '' ?>">
												<option value="0">Pilih Pihak</option>
												<option value="penggugat" <?php echo set_select('pihak', 'penggugat'); ?>>Penggugat</option>
												<option value="tergugat" <?php echo set_select('pihak', 'tergugat'); ?>>Tergugat</option>
											</select>
											<div class="invalid-feedback">
												<?php echo form_error('pihak'); ?>
											</div>
										</div>
										<div id="sembunyikan" style="display: none;">
											<div class="form-group">
												<label for="nama">Nama</label>
												<input type="text" class="form-control <?php echo form_error('nama') ? 'is-invalid':'' ?>" name="nama" value="<?php echo set_value('nama'); ?>" placeholder="Nama Lengkap" required readonly>
												<div class="invalid-feedback">
													<?php echo form_error('nama'); ?>
												</div>
											</div>
											<div class="form-group">
												<label for="alasan">Alasan</label>
												<textarea name="alasan" id="alasan" rows="5" class="form-control <?php echo form_error('alasan') ? 'is-invalid':'' ?>"><?php echo set_value('alasan'); ?></textarea>
												<div class="invalid-feedback">
													<?php echo form_error('alasan'); ?>
												</div>
											</div>
										</div>
									</div>
									<div class="card-footer">
										<button id="btn_simpan" type="submit" class="btn btn-primary" style="display: none;">Simpan</button>
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
	<script>const base_url = "<?php echo base_url(); ?>";const nama_pa_pendek = "<?php echo $this->session->userdata('nama_pa_pendek'); ?>";</script>	
	<script type="text/javascript">        
		$(document).ready(function(){
			let jenis_perkara;
			$("#sidebar_setting").addClass("active");
			$("#sidebar_setting_blacklist").addClass("active");
			// $("#btn_simpan").hide();
			$("#jenis_perkara").on('change', function(){
				$("#row_pihak").hide();
				$("#sembunyikan").hide();
				$("#btn_simpan").hide();
				if(this.value != 0)
				{
					$("#row_perkara").show();
					$("input[name='perkara']").val((this.value == 'gugatan') ? '/Pdt.G/' : '/Pdt.P/');
					jenis_perkara = this.value;
				}
				else
				{
					$("#row_perkara").hide();
				}
			});
			var nama_pihak = [];
			$("#btn_cek_perkara").click(function(){
				$("#sembunyikan").hide();
				$("#pihak").prop("selectedIndex", 0);
				var no = $("#no_urut").val().trim();
				var perkara = $("input[name='perkara']").val().trim();
				var tahun = $("input[name='no_perkara_tahun']").val().trim();
				var nmr_perkara = no+perkara+tahun+'/'+nama_pa_pendek;
				console.log(nmr_perkara);
				$.ajax({
					url: base_url+'pengambilan/cek_data_perkara',
					method: "POST",
					data: {nmr_perkara: nmr_perkara, perkara: jenis_perkara},
					dataType: 'json',
					beforeSend: function(){
						console.log('beforesend');
					},
					success: function(data)
					{
						console.log(data);
						if(data == "kosong")
						{
							alert("Nomor perkara tidak ditemukan, silahkan periksa kembali nomor perkara anda");
						}
						else if(data == "belum putus")
						{
							alert("Perkara belum diputus");
						}
						else
						{
							$("input[name='no_perkara']").val(nmr_perkara);
							$("#row_pihak").show();
							nama_pihak = [data[0]["p"],data[0]["t"]];
							if(jenis_perkara == "gugatan")
							{
								$("select[name=pihak] option[value=penggugat]").text("Penggugat");
								$("select[name=pihak] option[value=tergugat]").text("Tergugat");
							}
							else
							{
								$("select[name=pihak] option[value=penggugat]").text("Pemohon");
								$("select[name=pihak] option[value=tergugat]").text("Termohon");
							}
						}
					},
					error: function(err)
					{
						console.log(err.responseText);
					}
				});
			});
			$("#pihak").on('change',function(){
				if(this.value == "penggugat")
				{
					$("input[name='nama']").val(nama_pihak[0]);
					$("#sembunyikan").show();
					$("#btn_simpan").show();
				}
				else if(this.value == "tergugat")
				{
					$("input[name='nama']").val(nama_pihak[1]);
					$("#sembunyikan").show();
					$("#btn_simpan").show();
				}
				else
				{
					$("input[name='nama']").val("");
					$("#sembunyikan").hide();
					$("#btn_simpan").hide();
				}
			});

			if($('.invalid-feedback').children().length > 0)
			{				
				$("#sembunyikan").show();
				$("#row_perkara").show();
				$("input[name='perkara']").val(($("#jenis_perkara").val() == 'gugatan') ? '/Pdt.G/' : '/Pdt.P/');
				$("#row_pihak").show();
				$("#btn_simpan").hide();
				$("#jenis_perkara").trigger('change');
				$("#btn_cek_perkara").trigger('click');
			}

			$("#no_urut").on('input', function(){
				$("#row_pihak").hide();
				$("#sembunyikan").hide();
			});
			$("input[name='no_perkara_tahun']").on('input', function(){
				$("#row_pihak").hide();
				$("#sembunyikan").hide();
			});
			
		});
	</script>
</body>
</html>