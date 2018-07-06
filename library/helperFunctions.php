<?php

require_once("constants.php");
require_once("helperFunctions.php");

/**
 * A simple log function to make it easier to track what a user is doing
 * @param $l string The string to print to the log file
 */
function serv_log($l) {
	date_default_timezone_set("America/Toronto");
	$date = date('Y/m/d H:i:s', time());
	$dir = get_log_dir();
	file_put_contents($dir . 'server_log.log', $date . " --- " . $l . "\r\n", FILE_APPEND);
}

/**
 * Returns the directory where logs should be stored
 * @return array|false|string
 */
function get_log_dir() {
	return "/u1/exambank/";
}

function cleanInput($input) {

	$search = array(
		'@<script[^>]*?>.*?</script>@si',   // Strip out javascript
		'@<[/\!]*?[^<>]*?>@si',            // Strip out HTML tags
		'@<style[^>]*?>.*?</style>@siU'    // Strip style tags properly
	);

	$output = preg_replace($search, '', $input);
	return $output;
}

function sanitize($input) {
	$output = array();
	if (is_array($input)) {
		foreach($input as $var=>$val) {
			$output[$var] = sanitize($val);
		}
	}
	else {
		$output = cleanInput($input);
	}
	return $output;
}

function debug_to_console( $data ) {
	$output = $data;
	if ( is_array( $output ) )
		$output = implode( ',', $output);

	echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}