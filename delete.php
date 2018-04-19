<?php

header('Content-Type: application/json; charset=UTF-8');
include 'config/core.php';
include 'models/Student.php';

// DELETE
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	sendJsonResponse(['error' => 'Bad Request Method'], 405);
}

$id = $_POST['id'] ?? 0;

$studentModel = new Student();

$student = $studentModel->find($id);
if (!$student) {
	sendJsonResponse(['error' => 'Resource Not Found'], 404);
}

$result = $studentModel->destroy($id);

if (!$result) {
	sendJsonResponse(['error' => 'The request could not be completed'], 400);
}

sendJsonResponse(['message' => 'Resource has been deleted'], 204);