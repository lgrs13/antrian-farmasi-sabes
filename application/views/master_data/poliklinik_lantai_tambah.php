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
                                    <form action="<?= base_url(); ?>Master_data/tambah_klinik_lantai" method="POST">
                                        <div class="form-group">
                                            <label for="">Klinik : </label>
                                            <select name="kd_poli" id="kd_poli">
                                                <?php
                                                foreach ($data['list_poli'] as $value) {
                                                    ?>
                                                    <option value="<?= $value->kd_poli; ?>"><?= $value->nm_poli; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Dokter : </label>
                                            <select name="kd_dokter" id="kd_dokter">
                                                <?php
                                                foreach ($data['list_dokter'] as $value) {
                                                    ?>
                                                    <option value="<?= $value->kd_dokter; ?>"><?= $value->nm_dokter; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Lantai : </label>
                                            <input type="number" id="lantai" name="lantai" >
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