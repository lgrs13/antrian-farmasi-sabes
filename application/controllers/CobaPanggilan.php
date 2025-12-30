<?php

use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\Client\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;

class CobaPanggilan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->helper('url');
        $this->load->helper('date_helper');
        $this->load->model('M_antrian_farmasi');
    }

    public function index()
    {
        $textToSpeechClient = new TextToSpeechClient();

        $input = new SynthesisInput();
        $input->setText('Japans national soccer team won against Colombia!');
        $voice = new VoiceSelectionParams();
        $voice->setLanguageCode('en-US');
        $audioConfig = new AudioConfig();
        $audioConfig->setAudioEncoding(AudioEncoding::MP3);

        $resp = $textToSpeechClient->synthesizeSpeech($input, $voice, $audioConfig);
        file_put_contents('test.mp3', $resp->getAudioContent());
    }
}
