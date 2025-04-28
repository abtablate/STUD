<?php
include 'db.php';

// Handle Deletes
if (isset($_GET['delete_student'])) {
    $id = $_GET['delete_student'];
    $conn->query("DELETE FROM STUDENT WHERE STUDENTID=$id") or die($conn->error);
    header("Location: index.php");
}

if (isset($_GET['delete_course'])) {
    $id = $_GET['delete_course'];
    $conn->query("DELETE FROM COURSE WHERE COURSEID=$id") or die($conn->error);
    header("Location: index.php");
}

if (isset($_GET['delete_enrollment'])) {
    $id = $_GET['delete_enrollment'];
    $conn->query("DELETE FROM ENROLLMENT WHERE ENROLLMENTID=$id") or die($conn->error);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Student Enrollment Management System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #f0f2f5;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 32px;
            font-weight: bold;
        }

        .section {
            background: white;
            margin: 20px;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 2px 8px rgba(0,0,0,0.1);
        }

        .section h2 {
            margin-top: 0;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .actions form {
            display: inline;
        }

        .actions a {
            background-color: #27ae60;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .actions input[type="text"] {
            padding: 8px;
            width: 250px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        a.action-btn {
            padding: 5px 10px;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            margin: 2px;
        }

        a.delete-btn {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>

<header>
    Student Enrollment Management System
</header>

<!-- STUDENTS SECTION -->
<div class="section">
    <h2>Students</h2>
    <div class="actions">
        <form method="get" action="index.php">
            <input type="text" name="search_student" placeholder="Search Students...">
            <input type="submit" value="Search">
        </form>
        <a href="student_add.php">➕ Add Student</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>FIRST Name</th>
            <th>LAST Name</th>
            <th>MIDDLE INITIAL</th>
            <th>Email</th>
            <th>Type</th>
            <th>Year</th>
            <th>Actions</th>
        </tr>

        <?php
        if (isset($_GET['search_student'])) {
            $search = $conn->real_escape_string($_GET['search_student']);
            $result = $conn->query("SELECT * FROM STUDENT WHERE FIRSTNAME LIKE '%$search%' OR LASTNAME LIKE '%$search%'") or die($conn->error);
        } else {
            $result = $conn->query("SELECT * FROM STUDENT") or die($conn->error);
        }
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?php echo $row['STUDENTID']; ?></td>
            <td><?php echo $row['FIRSTNAME']; ?></td>
            <td><?php echo $row['LASTNAME']; ?></td>
            <td><?php echo $row['MIDDLEINITIAL']; ?></td>
            <td><?php echo $row['EMAIL']; ?></td>
            <td><?php echo $row['STUDENTTYPE']; ?></td>
            <td><?php echo $row['YEARofSTUDY']; ?></td>
            <td>
                <a class="action-btn" href="student_update.php?edit=<?php echo $row['STUDENTID']; ?>">✏️ Update</a>
                <a class="action-btn delete-btn" href="index.php?delete_student=<?php echo $row['STUDENTID']; ?>" onclick="return confirm('Delete this student?')">🗑 Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<!-- COURSES SECTION -->
<div class="section">
    <h2>Courses</h2>
    <div class="actions">
        <form method="get" action="index.php">
            <input type="text" name="search_course" placeholder="Search Courses...">
            <input type="submit" value="Search">
        </form>
        <a href="course_add.php">➕ Add Course</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Description</th>
            <th>Units</th>
            <th>Actions</th>
        </tr>

        <?php
        if (isset($_GET['search_course'])) {
            $search = $conn->real_escape_string($_GET['search_course']);
            $result = $conn->query("SELECT * FROM COURSE WHERE COURSE_CODE LIKE '%$search%' OR COURSE_DESCRIPTION LIKE '%$search%'") or die($conn->error);
        } else {
            $result = $conn->query("SELECT * FROM COURSE") or die($conn->error);
        }
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?php echo $row['COURSEID']; ?></td>
            <td><?php echo $row['COURSE_CODE']; ?></td>
            <td><?php echo $row['COURSE_DESCRIPTION']; ?></td>
            <td><?php echo $row['UNITS']; ?></td>
            <td>
                <a class="action-btn" href="course_update.php?edit=<?php echo $row['COURSEID']; ?>">✏️ Update</a>
                <a class="action-btn delete-btn" href="index.php?delete_course=<?php echo $row['COURSEID']; ?>" onclick="return confirm('Delete this course?')">🗑 Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<!-- ENROLLMENTS SECTION -->
<div class="section">
    <h2>Enrollments</h2>
    <div class="actions">
        <form method="get" action="index.php">
            <input type="text" name="search_enrollment" placeholder="Search Enrollments...">
            <input type="submit" value="Search">
        </form>
        <a href="enrollment_add.php">➕ Add Enrollment</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Student ID</th>
            <th>Course ID</th>
            <th>Actions</th>
        </tr>

        <?php
        if (isset($_GET['search_enrollment'])) {
            $search = $conn->real_escape_string($_GET['search_enrollment']);
            $result = $conn->query("SELECT * FROM ENROLLMENT WHERE STUDENTID LIKE '%$search%' OR COURSEID LIKE '%$search%'OR ENROLLMENT_DATE LIKE '%$search%'") or die($conn->error);
        } else {
            $result = $conn->query("SELECT * FROM ENROLLMENT") or die($conn->error);
        }
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?php echo $row['ENROLLMENTID']; ?></td>
            <td><?php echo $row['ENROLLMENT_DATE']; ?></td>
            <td><?php echo $row['STUDENTID']; ?></td>
            <td><?php echo $row['COURSEID']; ?></td>
            <td>
                <a class="action-btn" href="enrollment_update.php?edit=<?php echo $row['ENROLLMENTID']; ?>">✏️ Update</a>
                <a class="action-btn delete-btn" href="index.php?delete_enrollment=<?php echo $row['ENROLLMENTID']; ?>" onclick="return confirm('Delete this enrollment?')">🗑 Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>



</body>
</html>
