<?php

header('Content-Type: application/json; charset=UTF-8');
include 'config/core.php';
include 'models/Student.php';

// GET
if ($_SERVER['REQUEST_METHOD'] != 'GET') {
	sendJsonResponse(['error' => 'Bad Request Method'], 405);
}

$id = $_GET['id'] ?? 0;

$studentModel = new Student();

$student = $studentModel->find($id);
if (!$student) {
	sendJsonResponse(['error' => 'Resource Not Found'], 404);
}

sendJsonResponse(['data' => $student]);