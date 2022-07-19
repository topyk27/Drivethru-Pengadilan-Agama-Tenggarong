var dt_antrian;
function hapusData(id)
{
$.ajax({
    url: base_url+'bos/antrian_hapus/'+id,
    dataType: "text",
    success: function(respon)
    {
    if(respon=="1")
    {        
        dt_antrian.ajax.reload();
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
    $("#sidebar_antrian").addClass("active");
    $("#sidebar_antrian_hari_ini").addClass("active");
    moment.locale('id');
    $.fn.dataTable.moment('LL');
    dt_antrian = $("#dt_antrian").DataTable({
        dom : 'Bfrtip',
        order : [[8,'desc']],
        ajax : {
            url : base_url+'bos/data_antrian_hari_ini',
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
            // return "<a href='<?php echo base_url('bos/antrian_ubah/') ?>"+row['id']+"' class='btn btn-warning'><i class='fas fa-edit'></i>Ubah</a><a href='#' class='btn btn-danger deleteButton'><i class='fas fa-trash'></i>Hapus</a>";
            return "<a href='"+base_url+"bos/antrian_ubah/"+row['id']+"' class='btn btn-warning'><i class='fas fa-edit'></i>Ubah</a><a href='#' class='btn btn-danger deleteButton'><i class='fas fa-trash'></i>Hapus</a>";
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