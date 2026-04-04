<?php
require_once "../core/Model.php";

class Company extends Model {

    // تسجيل شركة جديدة
    public function create($name, $email, $password, $is_approved = 0) {
        $stmt = $this->db->prepare(
            "INSERT INTO Company (name, email, password, is_approved) VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([$name, $email, $password, $is_approved]);
    }

    // التحقق إذا الإيميل موجود
    public function emailExists($email) {
        $stmt = $this->db->prepare("SELECT * FROM company WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }

    // جلب الشركة بالإيميل (لـ login)
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM company WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // جلب كل الشركات (لـ Admin Panel)
    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM company");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ جلب كل الشركات المعلقة للموافقة
    public function getAllPending() {
        $stmt = $this->db->prepare("SELECT * FROM company WHERE is_approved = 0");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ الموافقة على شركة معينة (Admin)
    public function approve($id) {
        $stmt = $this->db->prepare("UPDATE company SET is_approved = 1 WHERE id = ?");
        return $stmt->execute([$id]);
    }
}