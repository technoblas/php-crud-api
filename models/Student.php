<?php

require_once 'Model.php';
require_once 'ModelInterface.php';

class Student extends Model implements ModelInterface
{
    public $id;
    public $student_number;
    public $first_name;
    public $last_name;
    public $section_id;
    public $created_at;
    public $updated_at;

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $query = 'SELECT students.id, students.student_number, students.first_name, students.last_name,
                students.section_id, students.created_at, students.updated_at, sections.name as section_name
                FROM students
                INNER JOIN sections ON students.section_id = sections.id
                ORDER BY students.last_name';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function find($id)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        
        $query = 'SELECT students.id, students.student_number, students.first_name, students.last_name,
                students.section_id, students.created_at, students.updated_at, sections.name as section_name
                FROM students
                INNER JOIN sections ON students.section_id = sections.id
                WHERE students.id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function create()
    {
        $query = 'INSERT INTO students (student_number, first_name, last_name, section_id, created_at) 
                    VALUES (:student_number, :first_name, :last_name, :section_id, :created_at)';

        $stmt = $this->conn->prepare($query);

        // create adHoc query to check if student number is unique

        $student_number = filter_var($this->student_number, FILTER_SANITIZE_STRING);
        $first_name = filter_var($this->first_name, FILTER_SANITIZE_STRING);
        $last_name = filter_var($this->last_name, FILTER_SANITIZE_STRING);
        $section_id = filter_var($this->section_id, FILTER_SANITIZE_NUMBER_INT);
        $created_at = date('Y-m-d H:i:s');

        $stmt->bindParam(':student_number', $student_number);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':section_id', $section_id);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->execute();

        return $this->conn->lastInsertId(); // $stmt->rowCount();
    }

    public function update()
    {
        $query = 'UPDATE students SET first_name = :first_name, last_name = :last_name, 
                    section_id = :section_id, updated_at = :updated_at WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
        $first_name = filter_var($this->first_name, FILTER_SANITIZE_STRING);
        $last_name = filter_var($this->last_name, FILTER_SANITIZE_STRING);
        $section_id = filter_var($this->section_id, FILTER_SANITIZE_NUMBER_INT);
        $updated_at = date('Y-m-d H:i:s');

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':section_id', $section_id);
        $stmt->bindParam(':updated_at', $updated_at);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public function destroy($id)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $query = 'DELETE FROM students where id=:id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return $stmt->rowCount();
    }

    // adHoc Query
    public function isUnique($field, $value)
    {
        $field = filter_var($field, FILTER_SANITIZE_STRING);
        $value = filter_var($value, FILTER_SANITIZE_STRING);
        
        $query = "SELECT COUNT(*) FROM students WHERE $field = :value";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':value', $value);
        $stmt->execute();

        return ($stmt->fetchColumn() > 0) ? false : true;
    }
}