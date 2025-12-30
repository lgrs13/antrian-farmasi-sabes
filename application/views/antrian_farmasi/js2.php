<!-- scripts -->
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/js/jquery.gritter.min.js"></script>
<!-- ace scripts -->
<script src="<?= base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?= base_url(); ?>assets/js/ace.min.js"></script>

<script type="text/javascript">
    var arrSound = new Array();
    var i = -1;

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

    function initPemanggilanAntrianSound() {

        var lantaiPoli = $('#lantai-poli').val();
        $.ajax({
            url: "<?= base_url('Antrian_farmasi/antrianBelumTerpanggil'); ?>",
            method: "POST",
            dataType: "JSON",
            success: function(response) {

                if (response.status == 1) {

                    statusRunning = true;
                    isPlayingSounds = true;

                    $('#antrian_nrck_no').html(response.data.nonracik.no_antri);
                    $('#antrian_nrck_pasien').html(response.data.nonracik.nm_pasien);
                    $('#antrian_nrck_poli').html(response.data.nonracik.nm_poli);

                    $('#antrian_rck_no').html(response.data.racik.no_antri);
                    $('#antrian_rck_pasien').html(response.data.racik.nm_pasien);
                    $('#antrian_rck_poli').html(response.data.racik.nm_poli);


                    let nonracik = response.data.nonracikArr;
                    var incp = 0;
                    nonracik.forEach(function(itemNRacik) {
                        incp++;

                        $("#card-poli-" + incp + " div").eq(0).text(itemNRacik.no_antri);
                        $("#card-poli-" + incp + " div").eq(2).text(itemNRacik.nm_pasien);
                        $("#card-poli-" + incp + " div").eq(4).text(itemNRacik.nm_poli);
                    });


                    let racik = response.data.racikArr;
                    var icp = 2;
                    racik.forEach(function(itemRacik) {
                        icp++;

                        $("#card-poli-" + icp + " div").eq(0).text(itemRacik.no_antri);
                        $("#card-poli-" + icp + " div").eq(2).text(itemRacik.nm_pasien);
                        $("#card-poli-" + icp + " div").eq(4).text(itemRacik.nm_poli);
                    });

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
            arrSound = new Array();
            return;
        }

        arrSound[i].addEventListener('ended', playSound);
        arrSound[i].play();

        return;
    }

    function soundNRacik() {
        arrSound.push(new Audio('<?= base_url("assets/sound/notif.mp3"); ?>'));
        arrSound.push(new Audio('<?= base_url("assets/sound/antrianNonRacik.mp3"); ?>'));
        arrSound.push(new Audio('<?= base_url("assets/sound/notif.mp3"); ?>'));
        arrSound.push(new Audio('<?= base_url("assets/sound/antrianRacik.mp3"); ?>'));
    }


    $(document).ready(function() {

        renderTime();
        initPemanggilanAntrianSound();
        soundNRacik();
        setIntervalPemanggilanAntrian();

        // playSound();
        // setInterval(() => {
        // }, 15000);
    });
</script>