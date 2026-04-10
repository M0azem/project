<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<link rel="stylesheet" href="\projectmuc\views\style\studentDash.css">
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
  <div>
    <h2>EDU-X</h2>
    <ul class="menu">
      <li>
        <a href="?page=tasks" class="<?= $page=='tasks'?'active':'' ?>">Tasks</a>
      </li>

      <li>
          <a href="?page=done" class="<?= $page=='done'?'active':'' ?>">Done tasks</a>
      </li>

      <li>
        <a  href="?page=about" class="<?= $page=='about'?'active':'' ?>">About EDU-X</a>
      </li>

      <li>
        <a  href="?page=profile" class="<?= $page=='profile'?'active':'' ?>">profile</a>
      </li>

    </ul>
  </div>

  
</div>
</div>

<!-- Content -->
<div class="content">
  <div class="box">
    <?php

$page = isset($_GET['page']) ? strtolower($_GET['page']) : 'tasks';

if ($page == 'tasks') {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/projectmuc/views/page/tasks.php");

} elseif ($page == 'done') {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/projectmuc/views/page/done.php");

} elseif ($page == 'about') {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/projectmuc/views/page/about.php");

} elseif ($page == 'profile') {
    require_once($_SERVER['DOCUMENT_ROOT'] . "/projectmuc/views/page/profile.php");

} else {
    echo "404 Page Not Found";
}
  ?></div>
</div>

</body>