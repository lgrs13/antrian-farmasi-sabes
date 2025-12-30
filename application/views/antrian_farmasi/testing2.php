<audio id="audio" autoplay controls src="" type="audio/mpeg"></audio>
<!-- <audio id="audio" autoplay controls src="http://localhost/antrian-farmasi/assets/sound/antrianNonRacik20240229e00172.mp3" type="audio/mpeg"></audio> -->
<script type="text/javascript">
    // document.getElementById('audio').addEventListener("ended", function() {
    //     this.src = "http://localhost/antrian-farmasi/assets/sound/antrianNonRacik20240229e00172.mp3?nocache=" + new Date().getTime();
    //     this.play();
    // });

    var sounds = new Array(new Audio("http://localhost/antrian-farmasi/assets/sound/notif.mp3"), new Audio("http://localhost/antrian-farmasi/assets/sound/antrianNonRacik20240229e00172.mp3"));
    var i = -1;
    playSnd();

    function playSnd() {
        i++;
        if (i == sounds.length) return;
        sounds[i].addEventListener('ended', playSnd);
        sounds[i].play();
    }
</script>