<?php

require_once 'Model.php';
require_once 'ModelInterface.php';

class Section extends Model implements ModelInterface
{
    public $id;
    public $name;
    public $created_at;
    public $updated_at;

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $query = 'SELECT * FROM sections ORDER BY name';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function find($id)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM sections WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function create()
    {
        $query = 'INSERT INTO sections (name, created_at) VALUES(:name, :created_at)';

        $stmt = $this->conn->prepare($query);

        $name = filter_var($this->name, FILTER_SANITIZE_STRING);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':created_at', date('Y-m-d H:i:s'));

        return $stmt->execute();
    }

    public function update()
    {
        $query = 'UPDATE sections SET name = :name, updated_at = :updated_at WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $id = filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
        $name = filter_var($this->name, FILTER_SANITIZE_STRING);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':updated_at', date('Y-m-d H:i:s'));

        return $stmt->execute();
    }

    public function destroy($id)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $query = 'DELETE FROM sections where id=:id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}