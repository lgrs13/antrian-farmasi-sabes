<!-- scripts -->
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/js/jquery.gritter.min.js"></script>
<!-- ace scripts -->
<script src="<?= base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?= base_url(); ?>assets/js/ace.min.js"></script>

<script type="text/javascript">
    var arrSound = [];
    var isPlayingSounds = false;
    var i = -1;
    var counter = 0;

    function renderTime() {
        var currentTime = new Date();
        var h = currentTime.getHours();
        var m = currentTime.getMinutes();
        var s = currentTime.getSeconds();

        if (h == 0) {
            h = 24;
        }
        if (h < 10) {
            h = "0" + h;
        }
        if (m < 10) {
            m = "0" + m;
        }
        if (s < 10) {
            s = "0" + s;
        }
        $('#clockdisplay').html(h + ":" + m + ":" + s + "");
        setTimeout('renderTime()', 1000);
    }


    function setIntervalPemanggilanAntrian() {

        setTimeout(() => {

            setInterval(() => {

                counter++;
                if (!statusRunning && !isPlayingSounds)
                    if (counter >= 1800)
                        refreshPage(); // refresh halaman apabila sudah 30 menit
                    else
                        initPemanggilanAntrianSound();
            }, 1000); // di-loop 1s
        }, 10000); // delay awal 10s
    }


    function refreshPage() {

        counter = 0;
        location.reload();
    }


    function initPemanggilanAntrianSound() {

        var lantaiPoli = $('#lantai-poli').val();
        $.ajax({
            url: "<?= base_url('Antrian_farmasi/antrianBelumTerpanggil'); ?>",
            method: "POST",
            dataType: "JSON",
            success: function(response) {

                if (response.status == 1) {
                    console.log('masuk ' + new Date() + " " + response.data.nonracik.panggil);
                    var currentTime = new Date();

                    statusRunning = true;
                    isPlayingSounds = true;

                    $('#antrian_nrck_pasien').html(response.data.nonracik.nm_pasien_lbl);
                    $('#antrian_nrck_poli').html(response.data.nonracik.nm_poli);

                    $('#antrian_rck_pasien').html(response.data.racik.nm_pasien_lbl);
                    $('#antrian_rck_poli').html(response.data.racik.nm_poli);


                    let nonracik = response.data.nonracikArr;
                    var incp = 0;
                    nonracik.forEach(function(itemNRacik) {
                        incp++;

                        $("#card-poli-" + incp + " div").eq(0).html(itemNRacik.nm_pasien_lbl);
                        $("#card-poli-" + incp + " div").eq(2).html(itemNRacik.nm_poli);
                    });
                    
                    if (response.data.nonracik.panggil == 0 || response.data.nonracik.panggil_ulang == 'ya') {
                        arrSound.push(new Audio('<?= base_url("assets/sound/notif.mp3"); ?>'));
                        arrSound.push(new Audio('http://localhost/antrian-farmasi/assets/sound/antrianNonRacik' + response.data.nonracik.no_resep.toLowerCase() + ".mp3"));
                        // arrSound.push(new Audio('<?= base_url(); ?>' + "assets/sound/antrianNonRacik" + response.data.nonracik.no_resep.toLowerCase() + ".mp3" + ''));

                        console.log("Nama Pasien Non Racik : " + response.data.nonracik.nm_pasien + " (" + currentTime + ")");
                    }


                    let racik = response.data.racikArr;
                    var icp = 2;
                    racik.forEach(function(itemRacik) {
                        icp++;

                        $("#card-poli-" + icp + " div").eq(0).html(itemRacik.nm_pasien_lbl);
                        $("#card-poli-" + icp + " div").eq(2).html(itemRacik.nm_poli);
                    });

                    if (response.data.racik.panggil == 0 || response.data.racik.panggil_ulang == 'ya') {
                        arrSound.push(new Audio('<?= base_url("assets/sound/notif.mp3"); ?>'));
                        arrSound.push(new Audio('http://localhost/antrian-farmasi/assets/sound/antrianRacik' + response.data.racik.no_resep.toLowerCase() + ".mp3"));
                        // arrSound.push(new Audio('<?= base_url(); ?>' + "assets/sound/antrianRacik" + response.data.racik.no_resep.toLowerCase() + ".mp3" + ''));

                        console.log("Nama Pasien Racik : " + response.data.racik.nm_pasien + " (" + currentTime + ")");
                    }

                    playSound();
                }

                statusRunning = false;
            },
            error: function(xhr, status, error) {

                console.log('initPemanggilanAntrianSound ERROR');
                console.log(xhr.status);
                console.log(xhr.responseText);
            }
        });
    }


    function playSound() {
        i++;
        if (i == arrSound.length) {
            isPlayingSounds = false;
            i = -1;
            arrSound = [];
            return;
        }

        arrSound[i].addEventListener('ended', playSound);
        arrSound[i].play();
        // console.log(arrSound);
        // console.log('false');
        // return false;

        return;
    }



    $(document).ready(function() {

        renderTime();
        initPemanggilanAntrianSound();
        setIntervalPemanggilanAntrian();
    });
</script>