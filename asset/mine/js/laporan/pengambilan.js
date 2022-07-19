var dt_laporan;
function filterData(data)
{
    $.ajax({
        type: 'POST',
        url: base_url+'laporan/data_laporan_filter',
        data: data,
        success: function(data){
            dt_laporan.clear();
            dt_laporan.rows.add(JSON.parse(data));
            dt_laporan.draw();
        }
    });
}

function cetak()
{
    bulan = $("select[name='bulan']").val();
    tahun = $("select[name='tahun']").val();
    window.open(base_url+'laporan/cetak_laporan_pengambilan/'+bulan+'/'+tahun);
}
$(document).ready(function(){
    $("#sidebar_laporan").addClass("active");
    moment.locale('id');
    $.fn.dataTable.moment('LL');
    dt_laporan = $("#dt_laporan").DataTable({
        dom : 'Bfrtip',
        order : [[1,'asc']],
        ajax : {
            url: base_url+'laporan/data_laporan_pengambilan',
            dataSrc: "",
        },
        columns : [
        {data: "id"},
        {data: null, sortable: true, render: function(data,type,row,meta){
            return meta.row + meta.settings._iDisplayStart + 1;
        }},
        {data: "no_perkara"},
        {data: "nama"},
        {data: "pihak"},
        {data: null, render: function(data,type,row,meta){
            if(row['ac']==1 && row['salinan']==1)
            {
                return "Akta Cerai<br /> Salinan Putusan";
            }
            else if(row['ac']==1)
            {
                return "Akta Cerai";
            }
            else if(row['salinan']==1 && row['no_perkara'].includes("Pdt.G"))
            {
                return "Salinan Putusan";
            }
            else
            {
                return "Salinan Penetapan";
            }
        }},
        {data: "no_ac"},
        {data: "no_hp"},
        {data: "jadwal"}
        ],
        columnDefs : [
        {
            targets: [0],
            visible: false,
        },
        {
            targets: [8],
            data: 'jadwal',
            render: function(data,type,row,meta){
                var dateObj = new Date(data);
                var momentObj = moment(dateObj);
                return momentObj.format('LL');
            }
        }
        ],
        responsive : true,
        autoWidth: false,
    });
    $("#form_filter").on('submit', function(e){
        e.preventDefault();
        data = $(this).serialize();
        filterData(data);
    });
});