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
	<script type="text/javascript">
		var now = new Date();
		var tahun = now.getFullYear();
		var bulan = now.getMonth()+1;
		moment.locale('id');
		var nama_bulan = moment().format('MMMM');

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
		

		function jumlah_hari(bulan, tahun) {
			return new Date(tahun,bulan,0).getDate();
		}
		$(document).ready(function(){
			$("#title_statistik").text("Statistik Pengambilan Drive Thru Bulan "+nama_bulan);
			$("#sidebar_home").addClass("active");
			
			$.ajax({
				url: "<?php echo base_url('pengambilan/statistik'); ?>",
				method: 'GET',
				dataType: 'json',
				success: function(data)
				{
					var hari = jumlah_hari(bulan,tahun);
					var label = [];
					var values = [];
					var ketemu = false;
					for(var i = 1; i<=hari; i++)
					{
						ketemu = false;
						for(var j in data)
						{
							if(i==data[j].tanggal)
							{
								// label.push(data[j].tanggal + ' ' + moment().format('MMMM'));
								label.push(parseInt(data[j].tanggal));
								values.push(parseInt(data[j].total));
								ketemu = true;
								break;
							}
							
						}
						if(!ketemu)
						{
							// label.push(i + ' ' + moment().format('MMMM'));
							label.push(i);
							values.push(0);
						}
					}
					// bar
					var areaChartData = {
					  labels  : label,
					  datasets: [
					    {
					      label               : 'Pengambilan',
					      backgroundColor     : 'rgba(60,141,188,0.9)',
					      borderColor         : 'rgba(60,141,188,0.8)',
					      pointRadius          : false,
					      pointColor          : '#3b8bba',
					      pointStrokeColor    : 'rgba(60,141,188,1)',
					      pointHighlightFill  : '#fff',
					      pointHighlightStroke: 'rgba(60,141,188,1)',
					      data                : values,
					    },
					    // {
					    //   label               : 'Gugatan',
					    //   backgroundColor     : 'rgba(210, 214, 222, 1)',
					    //   borderColor         : 'rgba(210, 214, 222, 1)',
					    //   pointRadius         : false,
					    //   pointColor          : 'rgba(210, 214, 222, 1)',
					    //   pointStrokeColor    : '#c1c7d1',
					    //   pointHighlightFill  : '#fff',
					    //   pointHighlightStroke: 'rgba(220,220,220,1)',
					    //   data                : [65, 59, 80, 81, 56, 55, 40],
					    // },
					  ]
					}
					var barChartCanvas = $('#barChart').get(0).getContext('2d')
					var barChartData = jQuery.extend(true, {}, areaChartData)
					var temp0 = areaChartData.datasets[0]
					// var temp1 = areaChartData.datasets[1]
					barChartData.datasets[0] = temp0
					// barChartData.datasets[1] = temp1

					var barChartOptions = {
					  responsive              : true,
					  maintainAspectRatio     : false,
					  datasetFill             : false,
					  scales : {
					  	yAxes : [{
					  	    	ticks: {
					  	    		stepSize: 1,
					  	    	}
					  	    }],
					  },
					  tooltips : {
					  	enabled : true,
					  	mode : 'single',
					  	callbacks: {
					  		title: function(tooltipItems, data){
					  			return tooltipItems[0].xLabel + ' ' + moment().format('MMMM');
					  		}
					  	}
					  }
					}

					var barChart = new Chart(barChartCanvas, {
					  type: 'bar', 
					  data: barChartData,
					  options: barChartOptions
					});
					// end bar
				}	
				});
			});
	</script>
</body>
</html>