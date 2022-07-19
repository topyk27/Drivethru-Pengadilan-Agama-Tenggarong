var now = new Date();
var tahun = now.getFullYear();
var bulan = now.getMonth()+1;
moment.locale('id');
var nama_bulan = moment().format('MMMM');		
if(token=="false")
{
    location.replace(base_url+'aktivasi');
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
                location.replace(base_url+'aktivasi');
            }
        }
        catch(err)
        {
            location.replace(base_url+'aktivasi');
        }
        $(".loader2").hide();
    },
    error: function(err)
    {
        $.ajax({
            url: base_url+'asset/mine/token/token.json',
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
                        location.replace(base_url+'aktivasi');
                    }
                }
                catch(err)
                {
                    location.replace(base_url+'aktivasi');
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
        url: base_url+'pengambilan/statistik',
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