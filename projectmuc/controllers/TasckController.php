<?php

// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "your_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// البيانات
$title = $_POST['title'];
$description = $_POST['description'];
$difficulty_id = $_POST['difficulty_id'];

// ================== رفع الصورة ==================
$image_name = "";
if (!empty($_FILES['image']['name'])) {
    $image_name = time() . "_" . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $image_name);
}

// ================== رفع الملف ==================
$file_name = "";
if (!empty($_FILES['file']['name'])) {
    $file_name = time() . "_" . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], "uploads/files/" . $file_name);
}

// ================== حفظ في DB ==================
$sql = "INSERT INTO assignments (title, description, difficulty_id, image, file)
        VALUES ('$title', '$description', '$difficulty_id', '$image_name', '$file_name')";

if ($conn->query($sql) === TRUE) {
    echo "Task created successfully";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>