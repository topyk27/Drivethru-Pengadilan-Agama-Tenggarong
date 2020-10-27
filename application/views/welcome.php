<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Drive Thru | PA Tenggarong</title>
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
							<h1>Selamat Datang di Drive Thru Pengadilan Agama Tenggarong</h1>
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
		function jumlah_hari(bulan, tahun) {
			return new Date(tahun,bulan,0).getDate();
		}
		$(document).ready(function(){
			$("#title_statistik").text("Statistik Pengambilan Drive Thru Bulan "+nama_bulan);
			$("#sidebar_home").addClass("active");
			// var areaChartData = {
			//   labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
			//   datasets: [
			//     {
			//       label               : 'Permohonan',
			//       backgroundColor     : 'rgba(60,141,188,0.9)',
			//       borderColor         : 'rgba(60,141,188,0.8)',
			//       pointRadius          : false,
			//       pointColor          : '#3b8bba',
			//       pointStrokeColor    : 'rgba(60,141,188,1)',
			//       pointHighlightFill  : '#fff',
			//       pointHighlightStroke: 'rgba(60,141,188,1)',
			//       data                : [28, 48, 40, 19, 86, 27, 90]
			//     },
			//     {
			//       label               : 'Gugatan',
			//       backgroundColor     : 'rgba(210, 214, 222, 1)',
			//       borderColor         : 'rgba(210, 214, 222, 1)',
			//       pointRadius         : false,
			//       pointColor          : 'rgba(210, 214, 222, 1)',
			//       pointStrokeColor    : '#c1c7d1',
			//       pointHighlightFill  : '#fff',
			//       pointHighlightStroke: 'rgba(220,220,220,1)',
			//       data                : [65, 59, 80, 81, 56, 55, 40]
			//     },
			//   ]
			// }
			// var barChartCanvas = $('#barChart').get(0).getContext('2d')
			// var barChartData = jQuery.extend(true, {}, areaChartData)
			// var temp0 = areaChartData.datasets[0]
			// var temp1 = areaChartData.datasets[1]
			// barChartData.datasets[0] = temp1
			// barChartData.datasets[1] = temp0

			// var barChartOptions = {
			//   responsive              : true,
			//   maintainAspectRatio     : false,
			//   datasetFill             : false
			// }

			// var barChart = new Chart(barChartCanvas, {
			//   type: 'bar', 
			//   data: barChartData,
			//   options: barChartOptions
			// });
			$.ajax({
				url: '<?php echo base_url('pengambilan/statistik'); ?>',
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