<?php

class CobaPanggilan2 extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('TextToSpeech');
    }

    public function index()
    {
        $this->texttospeech->setMessage("Helloworld!");

        // *optional: setting the filename is not required
        $this->texttospeech->createMessage("hello");

        // change the output language ("en-US" by default)
        $this->texttospeech->setLanguage("es-AR");

        // get the audio file url
        $this->texttospeech->getAudioFile();

        // get the HTML5 audio tag with the audio file
        // *optional: you can pass TRUE for autoplay
        $this->texttospeech->getEmbedAudio();
    }
}
