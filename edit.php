<?php

header('Content-Type: application/json; charset=UTF-8');
include 'config/core.php';
include 'models/Student.php';

// PUT
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	sendJsonResponse(['error' => 'Bad Request Method'], 405);
}

$id = $_POST['id'] ?? 0;

$studentModel = new Student();

$student = $studentModel->find($id);
if (!$student) {
	sendJsonResponse(['error' => 'Resource Not Found'], 404);
}

$student_number = $_POST['student_number'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$section_id = $_POST['section_id'];

$studentModel->id = $id;
$studentModel->student_number = $student_number;
$studentModel->first_name = $first_name;
$studentModel->last_name = $last_name;
$studentModel->section_id = $section_id;
$result = $studentModel->update();

if (!$result) {
	sendJsonResponse(['error' => 'The request could not be completed'], 400);
}

// return to user $_POST data or re-query
sendJsonResponse(['data' => $studentModel->find($id)]);