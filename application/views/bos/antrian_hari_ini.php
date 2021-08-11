<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Antrian Hari Ini | PA <?php echo $this->session->userdata('nama_pa'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->load->view("_partials/css.php") ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
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
							<h1>Semua Antrian Drive Thru</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item">
									<a href="<?php echo base_url(); ?>">Home</a>
								</li>
								<li class="breadcrumb-item">Antrian</li>
								<li class="breadcrumb-item active">Antrian Hari Ini</li>
							</ol>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-sm-12" id="respon">
							
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
									<h3 class="card-title">Daftar Antrian</h3>
								</div>
								<div class="card-body">
									<table id="dt_antrian" class="table table-bordered table-hover">
										<thead>
											<tr>
												<th></th>
												<th>NO</th>
												<th>NO Perkara</th>
												<th>NO Akta Cerai</th>
												<th>Nama</th>
												<th>Pihak</th>
												<th>Pengambilan</th>
												<th>NO HP</th>
												<th>Jadwal Pengambilan</th>
												<th>Antrian</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view("_partials/footer.php") ?>
	</div>
	<!-- hapus modal -->
	<div id="hapusModal" class="modal fade">
	  <div class="modal-dialog modal-confirm">
	    <div class="modal-content">
	      <div class="modal-header flex-column">
	        <div class="icon-box">
	          <i class="material-icons">&#xE5CD;</i>
	        </div>
	        <h4 class="modal-title w-100">Apakah anda yakin?</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	      </div>
	      <div class="modal-body">
	        <p>Apakah anda ingin menghapus data ini? Data ini tidak bisa dipulihkan kembali.</p>
	      </div>
	      <div class="modal-footer justify-content-center">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
	        <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteButton">Hapus</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- jQuery -->
	<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url('asset/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
	<!-- Datatables -->
	<script src="<?php echo base_url('asset/datatables/jquery.dataTables.min.js') ?>"></script>
	<script src="<?php echo base_url('asset/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
	<script src="<?php echo base_url('asset/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
	<script src="<?php echo base_url('asset/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
	<!-- Moment -->
	<script src="<?php echo base_url('asset/moment/moment-with-locales.min.js') ?>"></script>
	<script src="//cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>
	<script>
		var dt_antrian;
		function hapusData(id)
		  {
		    $.ajax({
		      url: "<?php echo base_url('bos/antrian_hapus/') ?>"+id,
		      dataType: "text",
		      success: function(respon)
		      {
		        if(respon="1")
		        {
		          console.log("berhasil");
		          dt_antrian.ajax.reload();
		           $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'><strong>Selamat</strong> Data berhasil dihapus</div>")
		           $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
		        }
		        else
		        {
		          console.log("gagal hapus data");
		          $("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'><strong>Maaf</strong> Data gagal dihapus. Silahkan coba lagi.</div>")
		          $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
		        }
		      }
		    });
		  }
		$(document).ready(function(){
			$("#sidebar_antrian").addClass("active");
			$("#sidebar_antrian_hari_ini").addClass("active");
			moment.locale('id');
			$.fn.dataTable.moment('LL');
			dt_antrian = $("#dt_antrian").DataTable({
				dom : 'Bfrtip',
				order : [[8,'desc']],
				ajax : {
					url : '<?php echo base_url('bos/data_antrian_hari_ini'); ?>',
					dataSrc : "",
				},
				columns : [
				{data : "id"},
				{data : null, sortable: false, render: function(data,type,row,meta){
					return meta.row + meta.settings._iDisplayStart + 1;
				}},
				{data : "no_perkara"},
				{data : "no_ac"},
				{data : "nama"},
				{data : "pihak"},
				{data : null, sortable: false, render:function(data,type,row,meta){
					ret = (row['ac']=="1") ? "Akta Cerai" : "";
					ret += (row['ac']=="1" && row['salinan']=="1") ? "<br/> dan <br/>" : "";
					ret += (row['salinan']=="1") ? "Salinan" : "";
					return ret;
				}},
				{data : "no_hp"},
				{data : "jadwal"},
				{data : "antrian"},
				{data : null, sortable: false, render:function(data,type,row,meta){
					return "<a href='<?php echo base_url('bos/antrian_ubah/') ?>"+row['id']+"' class='btn btn-warning'><i class='fas fa-edit'></i>Ubah</a><a href='#' class='btn btn-danger deleteButton'><i class='fas fa-trash'></i>Hapus</a>";
				}},
				],
				columnDefs : [
				{
					targets : [0,3],
					visible : false,
				},
				{
					targets : [10],
					orderable : false,
				},
				{
					targets : 8,
					data: "jadwal",
					render : function(data,type,row,meta){
						var dateObj = new Date(data);
						var momentObj = moment(dateObj);
						return momentObj.format('LL');
					}
				}
				],
				responsive : true,
				autoWidth: false,
			});

			$("#dt_antrian tbody").on('click', 'tr .deleteButton', function(e){
			  e.preventDefault();
			  // var currentRow = $(this).closest("tr");
			  var currentRow = $(this).closest('li').length ? $(this).closest('li') : $(this).closest('tr');
			  var data = $("#dt_antrian").DataTable().row(currentRow).data();
			  
			  $('#hapusModal').modal('show');
			  $('#hapusModal').find('.modal-body').html("<p>Apakah anda ingin menghapus data "+data['nama']+"? Data ini tidak bisa dipulihkan kembali.");
			  $('#hapusModal').find('#deleteButton').attr("onclick", "hapusData("+data['id']+")");
			});
		});
	</script>
</body>
</html>