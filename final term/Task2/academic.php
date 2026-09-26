<?php

session_start();

if (!isset($_SESSION["student_id"])) {

    header("Location: index.php");
    exit();
}

if (isset($_POST["next"])) {

    $_SESSION["semester"] = $_POST["semester"];
    $_SESSION["academic_year"] = $_POST["academic_year"];
    $_SESSION["course"] = $_POST["course"];
    $_SESSION["course_code"] = $_POST["course_code"];
    $_SESSION["credit_hours"] = $_POST["credit_hours"];
    $_SESSION["section"] = $_POST["section"];

    header("Location: review.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Academic Information</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h2>Academic Information</h2>

    <div class="info">

        <p>
            Student ID:
            <strong>
                <?php echo htmlspecialchars($_SESSION["student_id"]); ?>
            </strong>
        </p>

        <p>
            Full Name:
            <strong>
                <?php echo htmlspecialchars($_SESSION["full_name"]); ?>
            </strong>
        </p>

        <p>
            Department:
            <strong>
                <?php echo htmlspecialchars($_SESSION["department"]); ?>
            </strong>
        </p>

        <p>
            Program:
            <strong>
                <?php echo htmlspecialchars($_SESSION["program"]); ?>
            </strong>
        </p>

    </div>

    <form method="POST">

        <label>Semester</label>

        <select name="semester" required>

            <option value="">Select Semester</option>
            <option value="Spring">Spring</option>
            <option value="Summer">Summer</option>
            <option value="Fall">Fall</option>

        </select>

        <label>Academic Year</label>

        <select name="academic_year" required>

            <option value="">Select Academic Year</option>
            <option value="2026">2026</option>
            <option value="2027">2027</option>
            <option value="2028">2028</option>

        </select>

        <label>Course</label>

        <select name="course" required>

            <option value="">Select Course</option>

            <option value="Web Engineering">
                Web Engineering
            </option>

            <option value="Database Management System">
                Database Management System
            </option>

            <option value="Computer Networks">
                Computer Networks
            </option>

            <option value="Artificial Intelligence">
                Artificial Intelligence
            </option>

        </select>

        <label>Course Code</label>

        <input
            type="text"
            name="course_code"
            placeholder="Example: CSE 311"
            required
        >

        <label>Credit Hours</label>

        <select name="credit_hours" required>

            <option value="">Select Credit Hours</option>
            <option value="1.5">1.5</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>

        </select>

        <label>Section</label>

        <select name="section" required>

            <option value="">Select Section</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>

        </select>

        <button type="submit" name="next">
            Review Registration
        </button>

    </form>

</div>

</body>

</html>