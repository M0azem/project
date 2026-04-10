
<head>
    <link rel="stylesheet" href="\projectmuc\views\style\new-task.css">
</head>
<body>

<div class="container">
    <h2>Create New Task</h2>

    <form action="save_task.php" method="POST" enctype="multipart/form-data">
    
    <label>Title</label>
    <input type="text" name="title" required>

    <label>Description</label>
    <textarea name="description" rows="4" required></textarea>

    <label>Difficulty</label>
    <select name="difficulty_id" required>
        <option value="">Select difficulty</option>
        <option value="1">Easy</option>
        <option value="2">Medium</option>
        <option value="3">Hard</option>
    </select>

    <label>Upload Image</label>
    <input type="file" name="image" accept="image/*">

    <label>Upload File</label>
    <input type="file" name="file">

    <button type="submit">Create Task</button>

</form>
</div>

</body>
</html>