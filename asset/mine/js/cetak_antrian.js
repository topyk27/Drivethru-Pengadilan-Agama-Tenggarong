$(document).ready(function(){
    var element = $("#container01")[0];
    html2canvas(element).then(function(canvas) {
        //  document.body.appendChild(canvas);
        // // Export the canvas to its data URI representation
        // var base64image = canvas.toDataURL("image/png");

        // // Open the image in a new window
        // // window.open(base64image , "_blank");
        // window.open(base64image);
        var a = document.createElement('a');
        // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
        a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");;
        var nama_file = no_perkara;
        nama_file = nama_file.replace("/","_");
        a.download = nama_file+'.jpg';
        a.click();
        setTimeout(function(){
          location.replace(base_url);
        },10000);
    });
});