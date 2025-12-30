<style>
  .marquee-container {
    width: 500px;
    overflow: hidden;
    /* border: 1px solid #ccc; */
  }
  .marquee {
    color: red;
    font-size: 40px;
    display: inline-block;
    white-space: nowrap;
    animation: marqueeMove 10s linear infinite;
    animation-name: marqueeMove, blink;
    animation-duration: 18s, 1s;
    animation-timing-function: linear, step-start;
    animation-iteration-count: infinite, infinite;
  }

  @keyframes marqueeMove {
    from {
      transform: translateX(100%);
    }
    to {
      transform: translateX(-100%);
    }
  }

  @keyframes blink {
    50% {
      opacity: 100;
    }
  }
</style>

<body class="no-skin">

    <div class="navbar" class="navbar navbar-default navbar-collapse h-navbar navbar-fixed-top">
        <div class="navbar-container" id="navbar-container">
            <div class="navbar-header pull-left">
                <a style="margin-right:-7px" class="navbar-brand pull-left">
                    <img src="<?= base_url(); ?>assets/images/rsud/3_icon.png" style="width: 110px">
                </a>
                <a class="navbar-brand" style="margin-top: 7%;" href="<?= base_url(); ?>Pilih_lantai/clear_selected_lantai">
                    <span style="font-size: 30px;">ANTRIAN FARMASI</span>
                </a>
                <!-- <a class="navbar-brand" style="margin-top: 3%;" href="">
                    <span  style="font-size: 20px;  max-width: 100%;">Silakan scan barcode di meja petugas untuk cek status obat Anda</span>
                </a> -->
            </div>

            <div class="navbar-header d-flex justify-content-center align-items-center" style="margin-left: 4%;">
                <div class="navbar-brand marquee-container" style="margin-top: 4%;" href="">
                    <div class="marquee">Silakan scan barcode di meja petugas untuk cek status obat Anda <span style="color: #f06e6eff;">| Waktu tunggu Obat Racik 60 menit | Waktu tunggu obat Non racik 30 menit</span></div>
                </div>
                <img src="<?= base_url(); ?>assets/images/rsud/barcode_header.jpg" style="margin: 7px 5px; width: 80px">
            </div>

            <div class="navbar-header pull-right">
                <a class="navbar-brand" style="margin-top: 10px">
                    <span style="font-size: 42px" id="clockdisplay"></span>
                    <br>
                    <br>
                    <span style="font-size:20px"><?= $data['day_name']; ?>, <?= $data['date_now'] ?></span>
                </a>
            </div>
        </div>
    </div>


    <div class="main-container antrianku" id="main-container">
        <div class="main-content">
            <div class="main-content-inner">
                <div class="page-content">
                    <input type="hidden" value="<?= $data['lantai']; ?>" id="lantai-poli" />
                    <div class="row" style="margin-top: 5px;">
                        <div class="col-lg-6 col-md-6 col-xs-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <button class="btn btn-app-antrian" style="margin-bottom: 5px; background-color: #234974;">
                                                <div style="font-size:35px;font-weight:200">OBAT NON RACIK</div>
                                            </button>
                                            <br>
                                            <button class="btn btn-app-antrian" style="margin-bottom: 5px;background-color: #234974; white-space:normal; word-wrap: break-word;height:180px;font-weight:500" id="antrian_nrck_pasien">-</button>
                                            <br>
                                            <button class="btn btn-app-antrian" style="background-color: #234974; white-space:normal; word-wrap: break-word;height:70px;font-weight:500;" id="antrian_nrck_poli">-</button>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="card" style="margin-top: 10px;">
                                        <div class="card-body"></div>
                                        <button class="btn btn-app-antrian" style="margin-bottom: 5px; background-color: #234974;">
                                            <div style="font-size:35px;font-weight:200">OBAT RACIK</div>
                                        </button>
                                        <br>
                                        <button class="btn btn-app-antrian" style="margin-bottom: 5px; background-color: #234974; white-space:normal; word-wrap: break-word;height:180px;font-weight:500" id="antrian_rck_pasien">-</button>
                                        <br>
                                        <button class="btn btn-app-antrian" style=" background-color: #234974; white-space:normal; word-wrap: break-word;height:70px;font-weight:500;" id="antrian_rck_poli">-</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-xs-6">
                            <button class="btn btn-app-antrian" style="margin-bottom: 5px; background-color: #359D9e;">
                                <div style="font-size:25px;">Daftar Antrian Farmasi</div>
                            </button>
                            <div id="listResep">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Nama Poli</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <!-- <div class="row" style="margin-top: 10px;">
                        <div class="col-xs-12">
                            <div class="row center" style="display: flex;flex-wrap: wrap;">
                                <div class="col-lg-3 col-md-3 col-lg-3">
                                    <button id="card-poli-1" class="btn btn-app-antrian-2" style="background-color: #359D9e;white-space:normal;word-wrap:break-word;height:200px">
                                        <div style="font-weight:600" id="card-poli-1-nmpoli">-</div>
                                        <div style="border-bottom:1px solid #fff"></div>
                                        <div style="font-weight:600" id="card-poli-1-nmpoli">-</div>
                                    </button>
                                </div>
                                <div class="col-lg-3 col-md-3 col-lg-3">
                                    <button id="card-poli-2" class="btn btn-app-antrian-2" style="background-color: #359D9e;white-space:normal;word-wrap:break-word;height:200px">
                                        <div style="font-weight:600" id="card-poli-2-noreg">-</div>
                                        <div style="border-bottom:1px solid #fff"></div>
                                        <div style="font-weight:600" id="card-poli-2-nmpoli">-</div>
                                    </button>
                                </div>
                                <div class="col-lg-3 col-md-3 col-lg-3">
                                    <button id="card-poli-3" class="btn btn-app-antrian-2" style="background-color: #359D9e;white-space:normal;word-wrap:break-word;height:200px">
                                        <div style="font-size:38px;font-weight:600" id="card-poli-3-noreg">-</div>
                                        <div style="border-bottom:1px solid #fff"></div>
                                        <div style="font-weight:600" id="card-poli-3-nmpoli">-</div>
                                    </button>
                                </div>
                                <div class="col-lg-3 col-md-3 col-lg-3">
                                    <button id="card-poli-4" class="btn btn-app-antrian-2" style="background-color: #359D9e;white-space:normal;word-wrap:break-word;height:200px">
                                        <div style="font-size:38px;font-weight:600" id="card-poli-4-noreg">-</div>
                                        <div style="border-bottom:1px solid #fff"></div>
                                        <div style="font-weight:600" id="card-poli-4-nmpoli">-</div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div> -->
        </div>
    </div>
    </div>
    </div>


    <div class="second-container edukasiku" id="second-container">
        <div class="main-content">
            <div class="main-content-inner">
                <div class="page-content">
                    <input type="hidden" value="<?= $data['lantai']; ?>" id="lantai-poli" />
                    <div class="row" style="margin-top: 5px;">
                        <div class="col-xs-12">
                            <div id="imageku"></div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-xs-12">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div style="margin-top:10%;">
        <audio controls autoplay>
            <source src="" type="audio/mp3">
            </source>
        </audio>
    </div>

    <?php $this->load->view('partials/js_import.php'); ?>
</body>