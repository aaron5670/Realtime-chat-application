<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Home extends CI_Controller {

	/**
	 * Home constructor.
	 */
	public function __construct() {
		parent::__construct();

		//Basic site data
		$data = array(
			'site_title' => 'Realtime Web Application',
		);

		//Load <head>
		$this->load->view( 'templates/head' );
		//Load <nav>
		$this->parser->parse( 'templates/navigation', $data );
	}

	public function index() {
		$this->load->view( 'templates/header' );
		$this->load->view( 'pages/home' );
		$this->load->view( 'templates/footer' );
	}

	public function message() {
		$options = array(
			'cluster' => 'eu',
			'useTLS'  => true
		);

		$pusher = new Pusher\Pusher(
			'AUTH_KEY',
			'SECRET_KEY',
			'APP_ID',
			$options
		);

		// Check the receive message
		if ( isset( $_POST['message'] ) && ! empty( $_POST['message'] ) && $this->ion_auth->logged_in() ) {
			$data = $_POST['message'];
			// Return the received message
			if ( $pusher->trigger( 'test_channel', 'my_event', $data ) ) {
				echo 'success';
			} else {
				echo 'error';
			}
		}
	}

}
