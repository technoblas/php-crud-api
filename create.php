<?php

header('Content-Type: application/json; charset=UTF-8');
include 'config/core.php';
include 'models/Student.php';

// POST
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	sendJsonResponse(['error' => 'Bad Request Method'], 405);
}

$student_number = $_POST['student_number'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$section_id = $_POST['section_id'];

$student = new Student();

// check duplicates here
$isUnique = $student->isUnique('student_number', $student_number);
if (!$isUnique) {
	sendJsonResponse(['error' => 'Duplicate Student Number'], 400);
}

$student->student_number = $student_number;
$student->first_name = $first_name;
$student->last_name = $last_name;
$student->section_id = $section_id;
$result = $student->create();

if ((int)$result <= 0) {
	sendJsonResponse(['error' => 'The request could not be completed'], 400);
}

// return to user $_POST data or re-query
sendJsonResponse(['data' => $student->find($result)], 201);