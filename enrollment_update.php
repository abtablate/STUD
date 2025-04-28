<?php
include 'db.php';

if (isset($_POST['update'])) {
    $stmt = $conn->prepare("UPDATE ENROLLMENT SET ENROLLMENT_DATE=?, STUDENTID=?, COURSEID=? WHERE ENROLLMENTID=?");
    $stmt->bind_param("siii", $_POST['enrollment_date'], $_POST['student_id'], $_POST['course_id'], $_POST['enrollment_id']);
    $stmt->execute();
    header("Location: index.php");
}

$enrollment_id = "";
$enrollment_date = "";
$student_id = "";
$course_id = "";

if (isset($_GET['edit'])) {
    $enrollment_id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM ENROLLMENT WHERE ENROLLMENTID=$enrollment_id") or die($conn->error);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $enrollment_id = $row['ENROLLMENTID'];
        $enrollment_date = $row['ENROLLMENT_DATE'];
        $student_id = $row['STUDENTID'];
        $course_id = $row['COURSEID'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Enrollment</title>
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
    <h2>Update Enrollment</h2>
    <form method="post" action="enrollment_update.php">
        <input type="number" name="enrollment_id" value="<?php echo $enrollment_id; ?>" readonly>
        <input type="date" name="enrollment_date" value="<?php echo $enrollment_date; ?>" required>
        <input type="number" name="student_id" value="<?php echo $student_id; ?>" required>
        <input type="number" name="course_id" value="<?php echo $course_id; ?>" required>
        <input type="submit" name="update" value="Update Enrollment">
    </form>
</div>

</body>
</html>
