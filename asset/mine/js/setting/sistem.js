$(document).ready(function(){
    $("#sidebar_setting").addClass("active");
    $("#sidebar_setting_sistem").addClass("active");
    $("select[name='ketua_sebagai']").val(ketua_sebagai).change();
    $("#ketua_ubah").click(function(){
        $("#div_ketua_sebagai").show();
        $("select[name='ketua']").show();
        $("#ketua_simpan").show();
        $(this).hide();
    });
    $("#ketua_simpan").click(function(){
        $.ajax({
            type: 'POST',
            url: base_url+'setting/ketua_save',
            data: {
                ketua: $("select[name='ketua']").val(),
                ketua_sebagai: $("select[name='ketua_sebagai']").val()
            },
            dataType: 'json',
            success: function(data)
            {
                if(data.respon)
                {
                    $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'>Data berhasil diubah</div>")
                    $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                    $("#div_ketua_sebagai").hide();
                    $("select[name='ketua']").hide();
                    $("#ketua_simpan").hide();
                    $("#ketua_ubah").show();
                    $("#ketua").val(data.nama);
                }
                else
                {
                    $("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'>Data gagal diubah. Silahkan coba lagi.</div>")
                    $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                }
            },
            error: function(err)
            {
                console.log(err);
                $("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'>Data gagal diubah. Periksa koneksi internet anda.</div>")
                $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
            },

        });
    });

    $("select[name='panitera_sebagai']").val(panitera_sebagai).change();
    $("#panitera_ubah").click(function(){
        $("#div_panitera_sebagai").show();
        $("select[name='panitera']").show();
        $("#panitera_simpan").show();
        $(this).hide();
    });
    $("#panitera_simpan").click(function(){
        $.ajax({
            type: 'POST',
            url: base_url+'setting/panitera_save',
            data: {
                panitera: $("select[name='panitera']").val(),
                panitera_sebagai: $("select[name='panitera_sebagai']").val()
            },
            dataType: 'json',
            success: function(data)
            {
                if(data.respon)
                {
                    $("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'>Data berhasil diubah</div>")
                    $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                    $("#div_panitera_sebagai").hide();
                    $("select[name='panitera']").hide();
                    $("#panitera_simpan").hide();
                    $("#panitera_ubah").show();
                    $("#panitera").val(data.nama);
                }
                else
                {
                    $("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'>Data gagal diubah. Silahkan coba lagi.</div>")
                    $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
                }
            },
            error: function(err)
            {
                console.log(err);
                $("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'>Data gagal diubah. Silahkan coba lagi.</div>")
                $("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
            },

        });
    });
});