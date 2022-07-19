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
        $.ajax({
            url: base_url+'pengambilan/cek_data_perkara',
            method: "POST",
            data: {nmr_perkara: nmr_perkara, perkara: jenis_perkara},
            dataType: 'json',
            beforeSend: function(){                
            },
            success: function(data)
            {                
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