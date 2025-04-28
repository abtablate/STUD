<?php
include 'db.php';

if (isset($_POST['save'])) {
    $stmt = $conn->prepare("INSERT INTO STUDENT (STUDENTID, FIRSTNAME, LASTNAME, MIDDLEINITIAL, EMAIL, STUDENTTYPE, YEARofSTUDY) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $_POST['student_id'], $_POST['first_name'], $_POST['last_name'], $_POST['middle_initial'], $_POST['email'], $_POST['student_type'], $_POST['year']);
    $stmt->execute();
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
            width: 400px;
        }
        .form-card h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .form-card input[type="text"],
        .form-card input[type="email"],
        .form-card input[type="number"],
        .form-card input[type="date"],
        .form-card select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        .form-card input[type="submit"] {
            width: 50%;
            margin-left: 25%;
            background-color: #3498db;
            border: none;
            padding: 12px;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 10px;
        }
        .form-card input[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="form-card">
    <h2>Add New Student</h2>
    <form method="post" action="student_add.php">
        <input type="number" name="student_id" placeholder="Student ID" required>
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="text" name="middle_initial" placeholder="Middle Initial">
        <input type="email" name="email" placeholder="Email">
        <select name="student_type" required>
            <option value="">Select Student Type</option>
            <option value="Regular">Regular</option>
            <option value="Irregular">Irregular</option>
        </select>
        <input type="text" name="year" placeholder="Year of Study" required>

        <input type="submit" name="save" value="Save Student">
    </form>
</div>

</body>
</html>
