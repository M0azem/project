<?php
require_once "../core/Controller.php";

class AuthController extends Controller {

    public function login() {
        $this->view("auth/login");
    }

    public function register() {
        $this->view("auth/register");
    }

public function store() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $role = $_POST['role'];

        if (empty($name) || empty($email) || empty($password) || empty($role)) {
            echo "All fields are required!";
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if ($role == 'student') {
            $studentModel = $this->model("Student");
            if ($studentModel->emailExists($email)) {
                echo "Email already exists!";
                return;
            }
            $studentModel->create($name, $email, $hashedPassword);
            header("Location: index.php?url=auth/login");
            exit;

        } elseif ($role == 'company') {
            $companyModel = $this->model("Company");
            if ($companyModel->emailExists($email)) {
                echo "Email already exists!";
                return;
            }
            // الشركات تنتظر الموافقة من Admin
            $companyModel->create($name, $email, $hashedPassword, 0);
            echo "Your account is waiting for admin approval.";
        }
    }
}
    public function check()
{
    session_start();

    $studentModel = $this->model("Student");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $email = trim($_POST['email']);
        $password = $_POST['password'];

        // تحقق بسيط
        if (empty($email) || empty($password)) {
            echo "All fields are required!";
            return;
        }

        // جلب المستخدم من قاعدة البيانات
        $user = $studentModel->findByEmail($email);

        // تحقق من الايميل وكلمة المرور
        if ($user && password_verify($password, $user['password'])) {

            // إنشاء session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            // تحويل لصفحة رئيسية (dashboard)
            header("Location: index.php?url=dashboard");
            exit;

        } else {
            echo "Email or password is incorrect!";
        }
    }
}

    public function logout() {
        session_destroy();
        header("Location: index.php?url=auth/login");
    }

    public function adminLogin()
{
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $adminModel = $this->model("Admin");
        $admin = $adminModel->findByEmail($email);

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            $_SESSION['role'] = 'admin';
            header("Location: index.php?url=admin/dashboard");
            exit;
        } else {
            echo "Email or password is incorrect!";
        }
    }
}
}