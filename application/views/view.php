<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ANTRIAN FARMASI</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Aplikasi Pemanggilan Obat Pasien Poli RSUD Tanah Abang">
  <meta name="author" content="orang SIMRS 2023">
  
  <link rel="icon" href="<?= base_url(); ?>assets/images/rsud/2_icon_256_2.png" type="image/x-icon">

  <!-- favicon -->
  <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/rsud/2_icon_256_2.png">

  <!-- bootstrap & fontawesome -->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" />

  <!-- page specific plugin styles -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/jquery.gritter.min.css" />

  <!--fonts-->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/fonts/fonts.googleapis.com.css" />

  <!--ace styles-->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/js/ace-extra.min.js" />

  <!-- custom css -->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/styleAku.css" />
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/style.css" />
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/customstyle.css" />

  <!-- basic scripts -->

  <!--[if !IE]> -->
  <!-- <script src="<?= base_url(); ?>assets/js/jquery.2.1.1.min.js"></script> -->
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <!-- <![endif]-->

  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/js/jqueryAku.js" />

  <!--[if !IE]> -->
  <script type="text/javascript">
    // window.jQuery || document.write("<script src='<?= base_url(); ?>assets/js/jquery.min.js'>" + "<" + "/script>");
  </script>
  <!-- <![endif]-->

  <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRefreshCSS-44fe83e49b63affec96918c9af88c0d80b209a862cf87ac46bc933074b8c557d.js"></script>

  <script type="text/javascript">
    if ('ontouchstart' in document.documentElement) document.write("<script src='<?= base_url(); ?>assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
  </script>
</head>
<?php
$this->load->view($view_body);
$this->load->view($js);
?>

</html>