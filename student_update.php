<?php
include 'db.php';

if (isset($_POST['update'])) {
    $stmt = $conn->prepare("UPDATE STUDENT SET FIRSTNAME=?, LASTNAME=?, MIDDLEINITIAL=?, EMAIL=?, STUDENTTYPE=?, YEARofSTUDY=? WHERE STUDENTID=?");
    $stmt->bind_param("ssssssi", $_POST['first_name'], $_POST['last_name'], $_POST['middle_initial'], $_POST['email'], $_POST['student_type'], $_POST['year'], $_POST['student_id']);
    $stmt->execute();
    header("Location: index.php");
}

$student_id = "";
$first_name = "";
$last_name = "";
$middle_initial = "";
$email = "";
$student_type = "";
$year_of_study = "";

if (isset($_GET['edit'])) {
    $student_id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM STUDENT WHERE STUDENTID=$student_id") or die($conn->error);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $student_id = $row['STUDENTID'];
        $first_name = $row['FIRSTNAME'];
        $last_name = $row['LASTNAME'];
        $middle_initial = $row['MIDDLEINITIAL'];
        $email = $row['EMAIL'];
        $student_type = $row['STUDENTTYPE'];
        $year_of_study = $row['YEARofSTUDY'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Student</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI'; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;}
        .form-card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1); width: 400px;}
        .form-card h2 { text-align: center; margin-bottom: 20px; color: #2c3e50;}
        .form-card input, .form-card select { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 8px;}
        .form-card input[type="submit"] { width: 50%; margin-left: 25%; background-color: #3498db; border: none; color: white; cursor: pointer; }
        .form-card input[type="submit"]:hover { background-color: #2980b9; }
    </style>
</head>
<body>

<div class="form-card">
    <h2>Update Student</h2>
    <form method="post" action="student_update.php">
        <input type="number" name="student_id" value="<?php echo $student_id; ?>" readonly>
        <input type="text" name="first_name" value="<?php echo $first_name; ?>" required>
        <input type="text" name="last_name" value="<?php echo $last_name; ?>" required>
        <input type="text" name="middle_initial" value="<?php echo $middle_initial; ?>">
        <input type="email" name="email" value="<?php echo $email; ?>">
        <select name="student_type" required>
            <option value="Regular" <?php if ($student_type == "Regular") echo "selected"; ?>>Regular</option>
            <option value="Irregular" <?php if ($student_type == "Irregular") echo "selected"; ?>>Irregular</option>
        </select>
        <input type="text" name="year" value="<?php echo $year_of_study; ?>" required>

        <input type="submit" name="update" value="Update Student">
    </form>
</div>

</body>
</html>
