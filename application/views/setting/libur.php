<!DOCTYPE html>
<html lang="ID">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Setting - Libur</title>
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
							<h1>Libur</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
								<li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
								<li class="breadcrumb-item active">Libur</li>
							</ol>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-sm-2">
							<a href="<?php echo base_url('setting/libur_tambah'); ?>" class="btn btn-block bg-gradient-primary">
							<i class="fas fa-plus"></i> Tambah
						</a>
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
									<h3 class="card-title">Data Libur</h3>
								</div>
								<div class="card-body">
                                    <table id="dt_libur" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>#</th>
                                                <th>Tanggal</th>
                                                <th>Libur</th>                                                
                                                <th>Ubah</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view("_partials/footer.php") ?>
		<aside class="control-sidebar control-sidebar-dark"></aside>
	</div>

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
    <script>const base_url = "<?php echo base_url(); ?>";</script>
	<script type="text/javascript">
        var dt_libur;
		function hapusData(id)
		{
			$.ajax({
				url: base_url+'setting/libur_hapus/'+id,
				dataType: "text",
				success: function(respon)
				{					
					if(respon=="1")
					{
						dt_libur.ajax.reload();
						$("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'><strong>Selamat</strong> Data berhasil dihapus</div>")
						$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
					}
					else
					{
						$("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'><strong>Maaf</strong> Data gagal dihapus. Silahkan coba lagi.</div>")
						$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
					}
				}
			});
		}
		$(document).ready(function(){
			$("#sidebar_setting").addClass("active");
			$("#sidebar_setting_libur").addClass("active");
            moment.locale('id');
            $.fn.dataTable.moment('LL');
            dt_libur = $("#dt_libur").DataTable({
                dom : 'Bfrtip',
                ajax : {
                    url : base_url+'setting/data_libur',
                    dataSrc : "",
                },				
				columns : [
					{data:"id"},
					{data : null, sortable: false, render: function(data,type,row,meta){
					return meta.row + meta.settings._iDisplayStart + 1;
					}},
					{data : "tanggal"},					
					{data : "nama"},					
					{data : null, sortable: false, render:function(data,type,row,meta){
						return "<a href='"+base_url+"setting/libur_ubah/"+row['id']+"' class='btn btn-warning'><i class='fas fa-edit'></i> Ubah</a>";
					}},
					{data : null, sortable: false, render: function(data,type,row,meta){
						return "<a href='#' class='btn btn-danger deleteButton'><i class='fas fa-trash'></i> Hapus</a>";
					}},
				],
				order: [[2,'desc']],
				columnDefs : [
					{
						targets: [0],
						visible: false,
					},
                    {
                        targets: 2,
                        data: "jadwal",
                        render : function(data,type,row,meta)
                        {
                            var dateObj = new Date(data);
                            var momentObj = moment(dateObj);
                            return momentObj.format('LL');
                        }
                    }					
				],
				responsive : true,
				autoWidth : false
            });
			$("#dt_libur tbody").on('click','tr .deleteButton', function(e){
				e.preventDefault();
				var currentRow = $(this).closest('li').length ? $(this).closest('li') : $(this).closest('tr');
				var data = $("#dt_libur").DataTable().row(currentRow).data();
				$('#hapusModal').modal('show');
				$('#hapusModal').find('.modal-body').html("<p>Apakah anda ingin menghapus data "+data['nama']+"? Data ini tidak bisa dipulihkan kembali.");
				$('#hapusModal').find('#deleteButton').attr("onclick", "hapusData("+data['id']+")");
			});
			<?php if($this->session->userdata('success')) : $respon = $this->session->userdata('success'); ?>
			$("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'><?php echo $respon; ?></div>")
			$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
			<?php endif; ?>
		});
	</script>
</body>
</html>