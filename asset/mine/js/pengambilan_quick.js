$(document).ready(function() {
    $("#sidebar_antrian").addClass("active");
    $("#sidebar_pengambilan").addClass("active");
    $("#btn_ambil").hide();
    $("#row_pihak").hide();
    $("select[name='pihak']").prop("selectedIndex",0);
    var nama_pihak = [];
    $("#sembunyikan").hide();
    
    $.ajax({
        url: base_url+'pengambilan/cek_data_perkara',
        method: "POST",
        data: {
            nmr_perkara: nmr_perkara,
            perkara: perkara
        },
        dataType: 'json',
        success: function(data) {
            
            if (data == "kosong") {
                alert("Nomor perkara tidak ditemukan, silahkan periksa kembali nomor perkara anda");
            } else if (data == "belum putus") {
                alert("Perkara belum diputus");
            } else {
                $("#row_pihak").show();
                nama_pihak = [data[0]["p"], data[0]["t"]];
                if (data[0]["nomor_akta_cerai"] === undefined || data[0]["nomor_akta_cerai"] === null) {
                    $("#pengambilan_ac").attr("disabled", true);
                    $("#text_ac_belum_terbit").show();
                } else {
                    $("#pengambilan_ac").attr("disabled", false);
                    $("#text_ac_belum_terbit").hide();
                    $("input[name='no_ac']").val(data[0]["nomor_akta_cerai"]);
                }
                // console.log(perkara);
                if (perkara == "gugatan") {
                    $("select[name=pihak] option[value=penggugat]").text("Penggugat");
                    $("select[name=pihak] option[value=tergugat]").text("Tergugat");
                } else {
                    $("select[name=pihak] option[value=penggugat]").text("Pemohon");
                    $("select[name=pihak] option[value=tergugat]").text("Termohon");
                }
            }
            if(pihak=="p")
            {
                $("select[name='pihak']").val("penggugat").change();
                $("select[name='pihak']").attr("style", "pointer-events: none;");
            }
            else
            {
                $("select[name='pihak']").val("tergugat").change();
                $("select[name='pihak']").attr("style", "pointer-events: none;");
            }
        }
    });

    $("select[name='pihak']").on('change', function() {
        if (this.value == "penggugat") {
            $("input[name='nama']").val(nama_pihak[0]);
            $("#sembunyikan").show();
            $("#btn_ambil").show();
        } else if (this.value == "tergugat") {
            $("input[name='nama']").val(nama_pihak[1]);
            $("#sembunyikan").show();
            $("#btn_ambil").show();
        } else {
            $("input[name='nama']").val("");
            $("#sembunyikan").hide();
            $("#btn_ambil").hide();
        }
    });
    if ($('.invalid-feedback').children().length > 0) {
        $("#responSimbol").text('close');
        $("#modal_titel").text('Kesalahan');
        $("#modal_body").text('Ada yang salah, silahkan periksa formulir yang anda isi.');
        $("#modal_footer").show();
        $("#modal_footer").text('Periksa');
        $("#modal_footer_cetak").hide();
        $('#modal').modal('show');
        $("#sembunyikan").show();
        $("#row_pihak").show();
        $("#btn_ambil").show();
        $("#btn_cek_perkara").trigger('click');
    }
});