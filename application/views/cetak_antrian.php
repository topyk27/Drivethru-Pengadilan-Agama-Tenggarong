<!DOCTYPE html>
<html>
<head>
  <title>Cetak</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
  <!-- Font Awesome -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/fontawesome-free/css/all.min.css') ?>">

  <!-- Theme style -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/dist/css/adminlte.min.css') ?>">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/mine/css/cetak_antrian.css') ?>">
  <link href="https://fonts.googleapis.com/css?family=Heebo:700,700italic,400,400italic,900,900italic" rel="stylesheet" type="text/css">
</head>
<body class="is-ready">
  <div id="wrapper">
    <div id="main">
      <div class="inner">
        <div id="container01" class="container columns">
          <div class="wrapper">
            <div class="inner">
              <div class="full" style="display: none;">
                <div id="image01" class="image full" data-position="top">
                  <img src="<?php echo base_url('asset/img/logo_patgr.png'); ?>">
                </div>
              </div>
              <div class="content">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col"  id="text02" colspan="2" style="text-align: center;">Antrian<br>Drive Thru</th>
                    </tr>
                  </thead>
                  <tbody id="text01">
                    <tr>
                      <td>NO. Antrian</td>
                      <td><?php echo $this->session->userdata('antrian'); ?></td>
                    </tr>
                    <tr>
                      <td>NO. Perkara</td>
                      <td><?php echo $this->session->userdata('no_perkara'); ?></td>
                    </tr>
                    <tr>
                      <td>Nama</td>
                      <td><?php echo $this->session->userdata('nama'); ?></td>
                    </tr>
                    <tr>
                      <td>Tanggal Pengambilan</td>
                      <td><?php echo $this->session->userdata('jadwal'); ?></td>
                    </tr>
                    <tr rowspan="2">
                      <td>Produk yang diambil</td>
                      <td colspan="2">
                        <?php
                        $a = ($this->session->userdata('ac')) ? "Akta Cerai" : "";
                        $a .= ($this->session->userdata('ac') && $this->session->userdata('salinan')) ? "<br/> dan <br/>" : "";
                        $a .=($this->session->userdata('salinan')) ? "Salinan Penetapan/Putusan" : "";
                        echo $a;
                        ?>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <!-- <h1 id="text02" style="text-align: center;">Antrian</h1> -->
                <!-- <div class="form-group" id="text01">
                  <dl class="row border border-danger">
                    <dt class="col-4">NO. Antrian</dt>
                    <dd class="col-8">10</dd>
                    <dt class="col-4">NO. Perkara</dt>
                    <dd class="col-8">1262/Pdt.G/2019/PA.Tgr</dd>
                    <dt class="col-4">Tanggal Pengambilan</dt>
                    <dd class="col-8">31 Desember 2020</dd>
                  </dl>
                </div> -->
                <!-- <p id="text01">
                  <strong>lorem ipsum</strong>
                </p> -->
                <!-- <ul id="icons01" class="icons">
                  <li>
                    <a href="#" class="n01" style="color:white;">
                      <i class="fas fa-globe"></i>
                    </a>
                  </li>
                </ul> -->
                <div class="row">
                  <p class="text-center" id="text01">Silahkan membawa persyaratan yang sudah ditentukan dan datang antara pukul 10.00 - 12.00</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- jQuery -->
  <script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
  <!-- html2canvas -->
  <script src="<?php echo base_url('asset/html2canvas/html2canvas.min.js') ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>
  <script>
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
          var nama_file = '<?php echo $this->session->userdata('no_perkara'); ?>';
          nama_file = nama_file.replace("/","_");
          a.download = nama_file+'.jpg';
          a.click();
          setTimeout(function(){
            location.replace('<?php echo base_url(); ?>');
          },10000);
      });
    });
  </script>
</body>
</html>