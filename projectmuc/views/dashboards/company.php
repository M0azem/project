<?php

$conn = new mysqli("localhost", "root", "", "muc");

// example logged user
$user_id = $_SESSION['user_id'] ?? 1;

// get page
$page = $_GET['page'] ?? 'dashboard';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial;
}

body {
  display: flex;
  height: 100vh;
  background: #f5f6fa;
}

.sidebar {
  width: 250px;
  background: #0A090C;
  color: white;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 20px;
}

.menu {
  list-style: none;
}

.menu li {
  margin: 15px 0;
}

.menu a {
  text-decoration: none;
  color: white;
  display: block;
  padding: 10px;
  border-radius: 8px;
}

.menu a:hover {
  background: rgba(255,255,255,0.1);
}

.active {
  background: rgba(255,255,255,0.2);
}



.content {
  flex: 1;
  padding: 30px;
}

.box {
  background: white;
  padding: 20px;
  border-radius: 10px;
}
</style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
  <div>
    <h2>EDU-X</h2>
    <ul class="menu">
      <li><a href="?page=dashboard" class="<?= $page=='dashboard'?'active':'' ?>">📊 Dashboard</a></li>
      <li><a href="?page=tasks" class="<?= $page=='tasks'?'active':'' ?>">📋 Your Tasks</a></li>
      <li><a href="?page=profile" class="<?= $page=='profile'?'active':'' ?>">👤 Profile</a></li>
    </ul>
  </div>

  
</div>
</div>

<!-- Content -->
<div class="content">
  <h1>
    <?php
      if ($page == 'dashboard') echo "Dashboard";
      if ($page == 'tasks') echo "Your Tasks";
      if ($page == 'profile') echo "Profile";
    ?>
  </h1>

  <div class="box">

    <?php
    // DASHBOARD
    if ($page == 'dashboard') {
      echo "Welcome to your dashboard 🎉";
    }

    // TASKS (CLEARED FOR FUTURE USE)
    if ($page == 'tasks') {
      echo ""; // empty for now
    }

    // PROFILE (FROM DATABASE)
    if ($page == 'profile') {

      $sql = "SELECT name, email, role FROM company WHERE company_id='$user_id'";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        echo "
        <div style='display:flex;gap:20px;align-items:center;'>
          <div style='width:80px;height:80px;background:#2c2c6c;color:white;
          display:flex;align-items:center;justify-content:center;border-radius:50%;font-size:30px;'>
            👤
          </div>

          <div>
            <p><strong>Name:</strong> {$user['name']}</p>
            <p><strong>Email:</strong> {$user['email']}</p>
            <p><strong>Role:</strong> {$user['role']}</p>
          </div>
        </div>
        ";
      } else {
        echo "User not found ❌";
      }

    }
    ?>

  </div>
</div>

</body>
</html>