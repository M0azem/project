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
</form>

<a href="index.php?url=auth/login">Login</a>