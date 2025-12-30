<body class="hold-transition sidebar-collapse">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Master Data Klinik Lantai</h3>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url(); ?>Master_data/edit_klinik_lantai" method="POST">
                                        <div class="form-group">
                                            <label for="">Klinik : </label>
                                            <input type="text" value="<?= $data['kd_poli']; ?>" id="kd_poli" name="kd_poli" readonly>
                                            <input type="text" value="<?= $data['nm_poli']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Dokter : </label>
                                            <input type="text" value="<?= $data['kd_dokter']; ?>" id="kd_dokter" name="kd_dokter" readonly>
                                            <input type="text" value="<?= $data['nm_dokter']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Lantai : </label>
                                            <input type="number" value="<?= $data['lantai']; ?>" id="lantai" name="lantai" >
                                        </div>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="<?= base_url()."Master_data/klinik_lantai"; ?>">Kembali</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php $this->load->view('partials/js_import.php'); ?>
</body>