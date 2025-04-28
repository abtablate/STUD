<?php
include 'db.php';

if (isset($_POST['update'])) {
    $stmt = $conn->prepare("UPDATE COURSE SET COURSE_CODE=?, COURSE_DESCRIPTION=?, UNITS=? WHERE COURSEID=?");
    $stmt->bind_param("ssii", $_POST['course_code'], $_POST['course_description'], $_POST['units'], $_POST['course_id']);
    $stmt->execute();
    header("Location: index.php");
}

$course_id = "";
$course_code = "";
$course_description = "";
$units = "";

if (isset($_GET['edit'])) {
    $course_id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM COURSE WHERE COURSEID=$course_id") or die($conn->error);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $course_id = $row['COURSEID'];
        $course_code = $row['COURSE_CODE'];
        $course_description = $row['COURSE_DESCRIPTION'];
        $units = $row['UNITS'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Course</title>
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
    <h2>Update Course</h2>
    <form method="post" action="course_update.php">
        <input type="number" name="course_id" value="<?php echo $course_id; ?>" readonly>
        <input type="text" name="course_code" value="<?php echo $course_code; ?>" required>
        <input type="text" name="course_description" value="<?php echo $course_description; ?>" required>
        <input type="number" name="units" value="<?php echo $units; ?>" required>
        <input type="submit" name="update" value="Update Course">
    </form>
</div>

</body>
</html>
