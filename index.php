<?php

header('Content-Type: application/json; charset=UTF-8');
include 'config/core.php';
include 'models/Student.php';

// GET
if ($_SERVER['REQUEST_METHOD'] != 'GET') {
	sendJsonResponse(['error' => 'Bad Request Method'], 405);
}

$studentModel = new Student();

$students = $studentModel->all();

sendJsonResponse(['data' => $students]);