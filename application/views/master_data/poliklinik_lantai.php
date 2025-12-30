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
                                    <a href="<?= base_url(); ?>Master_data/poliklinik_lantai_tambah"><i class="fa fa-plus"></i>&nbsp;Tambah Data</a>
                                    <table class="table table-bordered table-hover" id="example">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Poli</th>
                                                <th>Nama Poli</th>
                                                <th>Kode Dokter</th>
                                                <th>Nama Dokter</th>
                                                <th>Lantai</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($data['list_data'] as $value) {
                                            ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $value->kd_poli; ?></td>
                                                    <td><?= $value->nm_poli; ?></td>
                                                    <td><?= $value->kd_dokter; ?></td>
                                                    <td><?= $value->nm_dokter; ?></td>
                                                    <td><?= $value->poli_lantai; ?></td>
                                                    <td>
                                                        <a href="<?= base_url()."Master_data/klinik_lantai_edit?kd_poli=".$value->kd_poli."&kd_dokter=".$value->kd_dokter."&lantai=".$value->poli_lantai; ?>"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                                                        <a href="<?= base_url()."Master_data/delete_klinik_lantai?kd_poli=".$value->kd_poli."&kd_dokter=".$value->kd_dokter."&lantai=".$value->poli_lantai; ?>"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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