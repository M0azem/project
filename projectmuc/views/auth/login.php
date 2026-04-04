<head>
    <link rel="stylesheet" href="\projectmuc\views\style\login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Coming+Soon&family=Playwrite+IE:wght@100..400&family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&family=Scheherazade+New:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
   
    <section>
        <h2 >Login</h2>
        <form method="POST" action="index.php?url=auth/check">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
        <a href="index.php?url=auth/register">Create Account</a> 
    </form>
    </section>
    

   
</body>
