<?php

// show error reporting
error_reporting(E_ALL);

// set your default time-zone
date_default_timezone_set('Asia/Manila');

// send json
function sendJsonResponse($data, $status = 200)
{
	http_response_code($status);
	echo json_encode($data);
	exit;
}
