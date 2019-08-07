<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require __DIR__ . '/vendor/autoload.php';

//Require pusher config
$pusher  = require __DIR__ . '/config.php';
$options = array(
	'cluster' => 'eu',
	'useTLS'  => true
);

//Pusher API config from config.php
$pusher = new Pusher\Pusher( $pusher['auth_key'], $pusher['secret'], $pusher['app_id'], $options );

// Check the receive message
if ( isset( $_POST['message'] ) && ! empty( $_POST['message'] ) ) {
	$data = $_POST['message'];

	// Return the received message
	if ( $pusher->trigger( 'test_channel', 'my_event', $data ) ) {
		echo 'success';
	} else {
		echo 'error';
	}
}
