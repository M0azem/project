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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            echo "All fields are required!";
            return;
        }


        // جرب أولاً جدول الطلاب
        $studentModel = $this->model("Student");
        $user = $studentModel->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = 'student';
            header("Location: index.php?url=views/studentDashboard");;
            exit;
        }

        // جرب جدول الشركات
        $companyModel = $this->model("Company");
        $company = $companyModel->findByEmail($email);
        if ($company && password_verify($password, $company['password'])) {
            $_SESSION['user_id'] = $company['id'];
            $_SESSION['user_name'] = $company['name'];
            $_SESSION['role'] = 'company';
            header("Location: index.php?url=views/companyDashboard");
            exit;
        }

        // إذا ما لقي أي مستخدم
        echo "Email or password is incorrect!";
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