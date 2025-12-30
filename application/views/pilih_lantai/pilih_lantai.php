<body>
    <div class="container">
        <img src="<?= base_url(); ?>/assets/images/rsud/1_icon_transparent.png" height="100px">
        <h3>Pilih Lantai Poli</h3>
        <form action="<?= base_url(); ?>Pilih_lantai/set_selected_lantai" method="POST">
            <input type="hidden" name="<?=$data['name'];?>" value="<?=$data['hash'];?>" />
            <div class="form-group">
                <select name="lantai" style="width: 100%">
                    <option value="3">Lantai 3</option>
                    <option value="4">Lantai 4</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
        </form>
    </div>
    <?php $this->load->view('partials/js_import.php'); ?>
</body>