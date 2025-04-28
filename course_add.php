<?php
include 'db.php';

if (isset($_POST['save'])) {
    $stmt = $conn->prepare("INSERT INTO COURSE (COURSEID, COURSE_CODE, COURSE_DESCRIPTION, UNITS) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi", $_POST['course_id'], $_POST['course_code'], $_POST['course_description'], $_POST['units']);
    $stmt->execute();
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Course</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI'; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;}
        .form-card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1); width: 400px;}
        .form-card h2 { text-align: center; margin-bottom: 20px; color: #2c3e50;}
        .form-card input { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 8px;}
        .form-card input[type="submit"] { width: 50%; margin-left: 25%; background-color: #3498db; border: none; color: white; cursor: pointer; }
        .form-card input[type="submit"]:hover { background-color: #2980b9; }
    </style>
</head>
<body>

<div class="form-card">
    <h2>Add New Course</h2>
    <form method="post" action="course_add.php">
        <input type="number" name="course_id" placeholder="Course ID" required>
        <input type="text" name="course_code" placeholder="Course Code" required>
        <input type="text" name="course_description" placeholder="Course Description" required>
        <input type="number" name="units" placeholder="Units" required>
        <input type="submit" name="save" value="Save Course">
    </form>
</div>

</body>
</html>
