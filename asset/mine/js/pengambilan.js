$(document).ready(function(){
    $("#sidebar_antrian").addClass("active");
    $("#sidebar_pengambilan").addClass("active");
    $("#btn_ambil").hide();
    $("#row_perkara").hide();
    $("select[name=jenis_perkara]").on('change', function(){
        $("#row_perkara").show();
        $("input[name=perkara]").val(this.value);
        $("#sembunyikan").hide();
        $("#row_pihak").hide();
        $("#btn_ambil").hide();
        $("select[name='pihak']").prop("selectedIndex",0);
    });
    var nama_pihak = [];
    $("#btn_cek_perkara").click(function(){
        $("#sembunyikan").hide();
        $("select[name='pihak']").prop("selectedIndex", 0);
        var no = $("input[name='no_perkara']").val().trim();
        var tahun = $("input[name='no_perkara_tahun']").val().trim();
        var jenis_perkara = $("input[name=perkara]").val().trim();
        var nmr_perkara = no+jenis_perkara+tahun+"/"+nama_pa_pendek;
        // console.log(nmr_perkara);
        
        var perkara = jenis_perkara=="/Pdt.G/" ? "gugatan" : "permohonan";
        $.ajax({
            url: base_url+'pengambilan/cek_data_perkara',
            method: "POST",
            data: {nmr_perkara: nmr_perkara, perkara: perkara},
            dataType: 'json',
            success: function(data)
            {
                
                if(data == "kosong")
                {
                    alert("Nomor perkara tidak ditemukan, silahkan periksa kembali nomor perkara anda");
                }
                // ini untuk notif ac belum terbit
                // work jangan dihapus
                else if(data == "belum putus")
                {
                    // alert("Akta cerai belum terbit");
                    // $("#pengambilan_ac").attr("disabled", true);
                    alert("Perkara belum diputus");
                }
                // end work
                else
                {
                    $("#row_pihak").show();
                    nama_pihak = [data[0]["p"],data[0]["t"]];
                    // console.log(data[0]);
                    // $("input[name='no_ac']").val(data[0]["nomor_akta_cerai"]);
                    
                    if(data[0]["nomor_akta_cerai"] === undefined || data[0]["nomor_akta_cerai"] === null)
                    {
                        // console.log("memang undefined");
                        $("#pengambilan_ac").attr("disabled", true);
                        $("#text_ac_belum_terbit").show();
                    }
                    else
                    {
                        // console.log("defined kok");
                        $("#pengambilan_ac").attr("disabled", false);
                        $("#text_ac_belum_terbit").hide();
                        $("input[name='no_ac']").val(data[0]["nomor_akta_cerai"]);
                    }
                    if(perkara == "gugatan")
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
            }
        });
    });

    $("select[name='pihak']").on('change', function(){
        if(this.value == "penggugat")
        {
            $("input[name='nama']").val(nama_pihak[0]);
            $("#sembunyikan").show();
            $("#btn_ambil").show();
        }
        else if(this.value == "tergugat")
        {
            $("input[name='nama']").val(nama_pihak[1]);
            $("#sembunyikan").show();
            $("#btn_ambil").show();
        }
        else
        {
            $("input[name='nama']").val("");
            $("#sembunyikan").hide();
            $("#btn_ambil").hide();
        }
    });

    // if($('.invalid-feedback').is(':visible'))
    if($('.invalid-feedback').children().length > 0)
    {
        $("#responSimbol").text('close');
        $("#modal_titel").text('Kesalahan');
        $("#modal_body").text('Ada yang salah, silahkan periksa formulir yang anda isi.');
        $("#modal_footer").show();
        $("#modal_footer").text('Periksa');
        $("#modal_footer_cetak").hide();
        $('#modal').modal('show');
        $("#row_perkara").show();
        $("#sembunyikan").show();
        $("#row_pihak").show();
        $("#btn_ambil").show();
        $("#btn_cek_perkara").trigger('click');
    }
    $("#no_perkara").on('input', function(){
        $("#row_pihak").hide();
        $("#sembunyikan").hide();
    });
    $("input[name='no_perkara_tahun']").on('input', function(){
        $("#row_pihak").hide();
        $("#sembunyikan").hide();
    });
});