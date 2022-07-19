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