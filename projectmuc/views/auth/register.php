
<head>
    <link rel="stylesheet" href="\projectmuc\views\style\login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Coming+Soon&family=Playwrite+IE:wght@100..400&family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&family=Scheherazade+New:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <section>
    <h2>Register</h2>
    <form method="POST" action="index.php?url=auth/store">
    <input type="text" name="name" placeholder="Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>

    <label for="role">I am a:</label>
    <select name="role" required>
        <option value="student">Student</option>
        <option value="company">Company</option>
    </select><br>
    <button type="submit">Register</button>
    <a href="index.php?url=auth/login">Login</a>
    
</form>

</section>

</body>

