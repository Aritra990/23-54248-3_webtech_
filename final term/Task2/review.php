<?php

session_start();

if (
    !isset($_SESSION["student_id"]) ||
    !isset($_SESSION["semester"])
) {

    header("Location: index.php");
    exit();
}

if (isset($_COOKIE["student_id"])) {

    $cookie_student_id = $_COOKIE["student_id"];

} else {

    $cookie_student_id = "No cookie found";
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Registration Review</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h2>Registration Review</h2>

    <h3>Personal / Student Information</h3>

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
            Date of Birth:
            <strong>
                <?php echo htmlspecialchars($_SESSION["dob"]); ?>
            </strong>
        </p>

        <p>
            Gender:
            <strong>
                <?php echo htmlspecialchars($_SESSION["gender"]); ?>
            </strong>
        </p>

        <p>
            Email:
            <strong>
                <?php echo htmlspecialchars($_SESSION["email"]); ?>
            </strong>
        </p>

        <p>
            Phone Number:
            <strong>
                <?php echo htmlspecialchars($_SESSION["phone"]); ?>
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

        <p>
            Batch:
            <strong>
                <?php echo htmlspecialchars($_SESSION["batch"]); ?>
            </strong>
        </p>

        <p>
            Address:
            <strong>
                <?php echo htmlspecialchars($_SESSION["address"]); ?>
            </strong>
        </p>

    </div>


    <h3>Academic Information</h3>

    <div class="info">

        <p>
            Semester:
            <strong>
                <?php echo htmlspecialchars($_SESSION["semester"]); ?>
            </strong>
        </p>

        <p>
            Academic Year:
            <strong>
                <?php echo htmlspecialchars($_SESSION["academic_year"]); ?>
            </strong>
        </p>

        <p>
            Course:
            <strong>
                <?php echo htmlspecialchars($_SESSION["course"]); ?>
            </strong>
        </p>

        <p>
            Course Code:
            <strong>
                <?php echo htmlspecialchars($_SESSION["course_code"]); ?>
            </strong>
        </p>

        <p>
            Credit Hours:
            <strong>
                <?php echo htmlspecialchars($_SESSION["credit_hours"]); ?>
            </strong>
        </p>

        <p>
            Section:
            <strong>
                <?php echo htmlspecialchars($_SESSION["section"]); ?>
            </strong>
        </p>

    </div>


    <h3>Cookie Information</h3>

    <div class="cookie-info">

        <p>
            Remembered Student ID:
            <strong>
                <?php echo htmlspecialchars($cookie_student_id); ?>
            </strong>
        </p>

    </div>

    <a href="academic.php">
        Back
    </a>

    <a href="complete.php">
        Complete Registration
    </a>

</div>

</body>

</html>