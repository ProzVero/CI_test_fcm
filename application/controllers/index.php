<?php

class Index extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Shanghai');
	}

	public function index(){
		$this->load->view('index');
	}

    public function sendNotification()
    {
        $topic = $this->input->post('topic'); // push topic
        $message = $this->input->post('pesan');

        $this->load->library('fcm');
        $this->fcm->setTitle('Test FCM Notification');
        $this->fcm->setMessage($message);

        /**
         * set to true if the notificaton is used to invoke a function
         * in the background
         */
        $this->fcm->setIsBackground(false);

        /**
         * payload is userd to send additional data in the notification
         * This is purticularly useful for invoking functions in background
         * -----------------------------------------------------------------
         * set payload as null if no custom data is passing in the notification
         */
        $payload = array('data1' => 'Berhasil bro');
        $this->fcm->setPayload($payload);

        /**
         * Send images in the notification
         */
        //$this->fcm->setImage('https://firebase.google.com/_static/9f55fd91be/images/firebase/lockup.png');

        /**
         * Get the compiled notification data as an array
         */
        $json = $this->fcm->getPush();

        $p = $this->fcm->sendToTopic($topic, $json);

        print_r($p);
		redirect('index');
    }

}