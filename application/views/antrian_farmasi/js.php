<!-- scripts -->
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/js/jquery.gritter.min.js"></script>
<!-- ace scripts -->
<script src="<?= base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?= base_url(); ?>assets/js/ace.min.js"></script>

<script type="text/javascript">
    var countDisplayedPoli = 8;
    var loadingGetListPoli = false;
    var isPlayingSounds = false;
    var statusRunning = false;
    var waitingTimeGetListPoli = 1000;
    var arrListPoli = [];
    var arrSound = new Array();
    var i = -1;
    var counter = 0;
    var counteredukasi = 0;

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
            // getListresep();

            setInterval(() => {

                counter++;
                counteredukasi = counteredukasi == 32 ? 1 : ++counteredukasi;

                if (!statusRunning && !isPlayingSounds) {

                    if (counter >= 1800)
                        refreshPage(); // refresh halaman apabila sudah 30 menit
                    else

                        initPemanggilanAntrianSound();
                    // initEdukasi(counteredukasi);
                }
            }, 2000); // di-loop 5s
        }, 20000); // delay awal 20s

        setInterval(() => {
            getListresep();
        }, 20000); // delay awal 20s
    }

    function putAntrianPoli(noResep, panggil_ulang) {

        console.log('putAntrian noResep: ' + noResep);
        console.log('putAntrian panggil_ulang: ' + panggil_ulang);
        $.ajax({
            url: "<?= base_url('Antrian_farmasi/put_antrian_terpanggil'); ?>",
            method: "post",
            data: {
                noResep: noResep,
                panggil_ulang: panggil_ulang
            },
            dataType: "JSON",
            error: function(xhr, status, error) {

                console.log('putAntrianPoli ERROR');
                console.log(xhr.responseText);
            }
        });
    }

    function fadeAntrianku() {
        // $(".antrianku").fadeOut();
        // $(".edukasiku").fadeIn();
    }

    function fadeEdukasiku() {
        $(".antrianku").fadeOut();
        $(".edukasiku").fadeIn();
    }

    function initEdukasi(ke = 1) {
        // fadeAntrianku();

        var img = new Image();

        $(img).load(function() {

            $('#imageku img:last-child').remove();
            $('#imageku').append($(this));

        }).attr({

            src: "/antrian-farmasi/assets/buku_saku_cara_penggunaan_obat/buku_saku_cara_penggunaan_obat_page" + ke + ".png"

        }).error(function() {
            //do something if image cannot load
        }).fadeIn();
    }

    function initPemanggilanAntrianSound() {

        // statusRunning = true;

        var lantaiPoli = $('#lantai-poli').val();
        $.ajax({
            url: "<?= base_url(); ?>Antrian_farmasi/antrianBelumTerpanggil",
            method: "GET",
            dataType: "JSON",
            success: function(response) {
console.log(response);

                if (response.status == 1) {
                    console.log("statusRunning: " + statusRunning + " - isPlayingSounds: " + isPlayingSounds);
                    console.log("response non Racik: " + response.data.nonracik);

                    if (!statusRunning && !isPlayingSounds) {
                        console.log('masuk ' + new Date());

                        $('#antrian_nrck_pasien').html(response.data.nonracik.nm_pasien_lbl);
                        $('#antrian_nrck_poli').html(response.data.nonracik.nm_poli);

                        $('#antrian_rck_pasien').html(response.data.racik.nm_pasien_lbl);
                        $('#antrian_rck_poli').html(response.data.racik.nm_poli);


                        let nonracik = response.data.nonracikArr;
                        // var incp = 0;
                        // nonracik.forEach(function(itemNRacik) {
                        //     incp++;

                        //     $("#card-poli-" + incp + " div").eq(0).html(itemNRacik.nm_pasien_lbl);
                        //     $("#card-poli-" + incp + " div").eq(2).html(itemNRacik.nm_poli);
                        // });


                        if (response.data.nonracik.panggil == 0 || response.data.nonracik.panggil_ulang == 'ya') {
                            var audioNRacik1 = new Audio('<?= base_url("assets/sound/notif.mp3"); ?>');
                            audioNRacik1.crossOrigin = "anonymous";
                            // console.log(response.data.nonracik.no_resep.toLowerCase());

                            var audioNRacik2 = new Audio('<?= base_url("assets/sound/antrianNonRacik"); ?>' + response.data.nonracik.no_resep.toLowerCase() + '.mp3');
                            // var audioNRacik2 = new Audio('http://192.168.100.80:8016/assets/sound/antrianNonRacik' + response.data.nonracik.no_resep.toLowerCase() + ".mp3")
                            audioNRacik2.crossOrigin = "anonymous";

                            arrSound.push(audioNRacik1);
                            arrSound.push(audioNRacik2);

                            console.log(response.data);

                            console.log("Nama Pasien Non Racik : " + response.data.nonracik.nm_pasien);
                            console.log('isPlayingSounds Non Racik 1');
                            putAntrianPoli(response.data.nonracik.no_resep, response.data.nonracik.panggil_ulang);
                        }


                        let racik = response.data.racikArr;
                        // var icp = 2;
                        // racik.forEach(function(itemRacik) {
                        //     icp++;

                        //     $("#card-poli-" + icp + " div").eq(0).html(itemRacik.nm_pasien_lbl);
                        //     $("#card-poli-" + icp + " div").eq(2).html(itemRacik.nm_poli);
                        // });

                        if (response.data.racik.panggil == 0 || response.data.racik.panggil_ulang == 'ya') {
                            arrSound.push(new Audio('<?= base_url("assets/sound/notif.mp3"); ?>'));
                            // var audioNRacik2 = new Audio('<?= base_url("assets/sound/antrianRacik"); ?>' + response.data.racik.no_resep.toLowerCase() + '.mp3');
                            arrSound.push(new Audio('<?= base_url("assets/sound/antrianRacik"); ?>' + response.data.racik.no_resep.toLowerCase() + '.mp3'));
                            // arrSound.push(new Audio('http://192.168.100.80:8016/assets/sound/antrianRacik' + response.data.racik.no_resep.toLowerCase() + ".mp3"));

                            console.log("Nama Pasien Racik : " + response.data.racik.nm_pasien);
                            console.log('isPlayingSounds Racik 1');
                            putAntrianPoli(response.data.racik.no_resep, response.data.racik.panggil_ulang);
                        }

                        isPlayingSounds = true;
                        playSound();
                    }
                }

                statusRunning = false;
                console.log('statusRunning 2 ' + statusRunning);
                console.log('\r\n\r\n');
            },
            error: function(xhr, status, error) {

                statusRunning = false;

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
            arrSound.length = 0;
            arrSound = new Array();
            return;
        }

        arrSound[i].addEventListener('ended', playSound);
        arrSound[i].playbackRate = 0.9;
        arrSound[i].play();
        // putAntrianPoli(idAntrian);
        return;
    }

    function refreshPage() {

        counter = 0;
        location.reload();
    }

    var $el = $(".table-responsive");

    // function anim() {

    //     var st = $el.scrollTop();
    //     var sb = $el.prop("scrollHeight") - $el.innerHeight();
    //     $el.animate({
    //         scrollTop: st < sb / 2 ? sb : 0
    //     }, 7000, anim);
        // getListresep();
    // }

    function anim() {
        $(".table-responsive table tbody tr").each(function(index) {
            if (index >= 5) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });

        var st = $el.scrollTop();
        var sb = $el.prop("scrollHeight") - $el.innerHeight();
        $el.animate({
            scrollTop: st < sb / 2 ? sb : 0
        }, 7000, anim);
    }
    anim();

    function stop() {
        $el.stop();
    }

    function getListresep() {
        $('#listResep tbody').html('');
        $.ajax({
            url: "<?= base_url('Antrian_farmasi/getListResep'); ?>",
            method: "GET",
            data: { 
            },
            dataType: "JSON",
            success: function(response) {
                console.log(response);

                var row = '';
                // if (response.status == 1) {
                //     response.data.forEach(function(item) {
                //         var Status 
                //         if (item.stts_resep === 'Sedang di Proses' || item.stts_resep === 'Belum Terlayani') {
                //             Status = 'Proses';
                //         } else if (item.stts_resep === 'Sudah Divalidasi' || item.stts_resep === 'Sudah Terlayani') {
                //             Status = 'Validasi';
                //         } else {
                //             Status = 'Selesai';
                //         }
                //         row += '<tr>';
                //         row += '<td style="font-size: 20px; font-weight: bold;">' + item.nm_pasien + '</td>';
                //         row += '<td style="font-size: 20px; font-weight: 500;">' + item.nm_poli + '</td>';
                //         row += '<td style="font-size: 20px; font-weight: 500;">' + Status + '</td>';
                //         row += '</tr>';
                //     });
                // } else {
                //     row = '<tr><td colspan="5" class="text-center">Tidak ada data resep</td></tr>';
                // }

                if (response.status == 1) {
                    response.data.forEach(function(item) {
                        if (item.stts_resep !== 'Batal') { 
                            var Status;
                            if (item.stts_resep === 'Sedang di Proses' || item.stts_resep === 'Belum Terlayani') {
                                Status = 'Proses';
                            } else if (item.stts_resep === 'Sudah Divalidasi' || item.stts_resep === 'Sudah Terlayani') {
                                Status = 'Validasi';
                            } else {
                                Status = 'Selesai';
                            }

                            row += '<tr>';
                            row += '<td style="font-size: 20px; font-weight: bold;">' + item.nm_pasien + '</td>';
                            row += '<td style="font-size: 20px; font-weight: 500;">' + item.nm_poli + '</td>';
                            row += '<td style="font-size: 20px; font-weight: 500;">' + Status + '</td>';
                            row += '</tr>';
                        }
                    });
                } else {
                    row = '<tr><td colspan="5" class="text-center">Tidak ada data resep</td></tr>';
                }
                $('#listResep tbody').html(row);

            }
        });
    }

    anim();
    $el.hover(stop, anim);

    $(document).ready(function() {

        //TODO:
        renderTime();
        setIntervalPemanggilanAntrian();
        getListresep();
    });
</script>