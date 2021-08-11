<!DOCTYPE html>
<html lang="ID">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laporan Pengambilan</title>
	<?php $this->load->view("_partials/css.php") ?>
	<style type="text/css">
		@media print{@page {size:landscape;}}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12 align-items-center">
				<div class="text-center">
					<?php $nama_pa = $this->session->userdata('nama_pa'); ?>
					<h3 class="text-uppercase">laporan pengambilan produk melalui layanan drive thru<br>pada pengadilan agama <?php echo $nama_pa; ?><br>bulan <?php echo $bulan; ?> tahun <?php echo $tahun; ?></h3>
				</div>
				<div class="panel-body">
					<table id="dt_laporan" class="table table-bordered table-hover">
						<thead>
							<tr class="text-center">
								<th>NO</th>
								<th>Perkara</th>
								<th>Nama</th>
								<th>Pihak</th>
								<th>Pengambilan</th>
								<th>Nomor Akta Cerai</th>
								<th>Nomor HP</th>
								<th>Tanggal</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$no = 1;
								$jumlah_ac = 0;
								$jumlah_putusan = 0;
								$jumlah_penetapan = 0;
								function tgl_indo($tanggal)
								{
									$bulan = array (
										1 =>   'Januari',
										'Februari',
										'Maret',
										'April',
										'Mei',
										'Juni',
										'Juli',
										'Agustus',
										'September',
										'Oktober',
										'November',
										'Desember'
									);
									$pecahkan = explode('-', $tanggal);
									return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
								}
								foreach($laporan as $key=>$val) :
							 ?>
							 <tr>
							 	<th scope="row" class="text-center"><?php echo $no; ?></th>
							 	<td><?php echo $val->no_perkara; ?></td>
							 	<td><?php echo $val->nama; ?></td>
							 	<td class="text-capitalize"><?php echo $val->pihak; ?></td>
							 	<td>
							 		<?php
								 		if($val->ac==1 && $val->salinan==1)
								 		{
								 			echo "Akta Cerai<br />Salinan Putusan";
								 			$jumlah_ac++;
								 			$jumlah_putusan++;
								 		}
								 		else if($val->ac==1)
								 		{
								 			echo "Akta Cerai";
								 			$jumlah_ac++;
								 		}
								 		else if(strpos($val->no_perkara, "Pdt.G"))
								 		{
								 			echo "Salinan Putusan";
								 			$jumlah_putusan++;
								 		}
								 		else
								 		{
								 			echo "Salinan Penetapan";
								 			$jumlah_penetapan++;
								 		}
							 		 ?>
						 		</td>
						 		<td><?php echo $val->no_ac; ?></td>
						 		<td><?php echo $val->no_hp; ?></td>
						 		<td style="white-space: nowrap; width: 1%;"><?php echo $val->jadwal; ?></td>
							 </tr>
								<?php $no++; endforeach; ?>
						</tbody>
						<tfoot>
							
						</tfoot>
					</table>
					<table class="table table-bordered table-hover">
						<tbody>
							<tr>
								<td class="text-right" style="width: 20%;">
									Jumlah Pengambilan :
								</td>
								<td class="text-left" style="width: 80%;">
									<?php echo $no; ?>
								</td>
							</tr>
							<tr>
								<td class="text-right">
									Akta Cerai :
								</td>
								<td class="text-left">
									<?php echo $jumlah_ac; ?>
								</td>
							</tr>
							<tr>
								<td class="text-right">
									Salinan Putusan :
								</td>
								<td class="text-left">
									<?php echo $jumlah_putusan; ?>
								</td>
							</tr>
							<tr>
								<td class="text-right">
									Salinan Penetapan :
								</td>
								<td class="text-left">
									<?php echo $jumlah_penetapan; ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row">
			<table class="table table-borderless">
				<tbody>
					<tr>
						<td style="width: 20%;"></td>
						<td style="width: 30%;">Mengetahui,<br><?php echo $ttd->ketua_sebagai; ?>,<br><br><br><br><?php echo $ttd->ketua; ?><br>NIP. <?php echo $ttd->ketua_nip; ?></td>
						<td style="width: 20%;"></td>
						<td style="width: 30%;"><span class="text-capitalize"><?php echo $nama_pa; ?></span>, <?php echo $now; ?><br><?php echo $ttd->panitera_sebagai; ?>,<br><br><br><br><?php echo $ttd->panitera; ?><br>NIP. <?php echo $ttd->panitera_nip; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<!-- jQuery -->
	<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url('asset/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
	
</body>
</html>