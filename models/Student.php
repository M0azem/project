<?php
require_once "../core/Model.php";

class Student extends Model {

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM Student WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM Student");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   public function create($name, $email, $password) {
    $stmt = $this->db->prepare("INSERT INTO Student (name, email, password) VALUES (?, ?, ?)");
    return $stmt->execute([$name, $email, $password]);
}

public function emailExists($email) {
    $stmt = $this->db->prepare("SELECT * FROM Student WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->rowCount() > 0;
}
}