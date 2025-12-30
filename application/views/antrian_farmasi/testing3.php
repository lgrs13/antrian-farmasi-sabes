<audio controls>
    <!-- <source src="horse.ogg" type="audio/ogg"> -->
    <source src="file:///192.168.14.13/##editableshare/kumpulan-sound-antrian-farmasi/test_af1.mp3" type="audio/mp3">
    Your browser does not support the audio element.
</audio>

<script>
    var audioFile = "file:///192.168.14.13/##editableshare/kumpulan-sound-antrian-farmasi/test_af1.mp3";
    function getData(audioFile, callback) {
        var reader = new FileReader();
        reader.onload = function(event) {
            var data = event.target.result.split(','),
                decodedImageData = btoa(data[1]); // the actual conversion of data from binary to base64 format
            callback(decodedImageData);
        };
        reader.readAsDataURL(audioFile);
    }
</script>