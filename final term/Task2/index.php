<?php

session_start();

$remembered_id = "";

if (isset($_COOKIE["student_id"])) {
    $remembered_id = $_COOKIE["student_id"];
}

if (isset($_POST["next"])) {

    $_SESSION["student_id"] = $_POST["student_id"];
    $_SESSION["full_name"] = $_POST["full_name"];
    $_SESSION["dob"] = $_POST["dob"];
    $_SESSION["gender"] = $_POST["gender"];
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["phone"] = $_POST["phone"];
    $_SESSION["department"] = $_POST["department"];
    $_SESSION["program"] = $_POST["program"];
    $_SESSION["batch"] = $_POST["batch"];
    $_SESSION["address"] = $_POST["address"];

    // Remember Student ID for 30 days
    if (isset($_POST["remember"])) {

        setcookie(
            "student_id",
            $_POST["student_id"],
            time() + (86400 * 30),
            "/"
        );
    }

    header("Location: academic.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>University Portal Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h2>University Portal Registration</h2>
    <h3>Personal / Student Information</h3>

    <form method="POST">

        <label>Student ID</label>
        <input
            type="text"
            name="student_id"
            value="<?php echo htmlspecialchars($remembered_id); ?>"
            required
        >

        <label>Full Name</label>
        <input
            type="text"
            name="full_name"
            required
        >

        <label>Date of Birth</label>
        <input
            type="date"
            name="dob"
            required
        >

        <label>Gender</label>

        <select name="gender" required>

            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>

        </select>

        <label>Email</label>

        <input
            type="email"
            name="email"
            required
        >

        <label>Phone Number</label>

        <input
            type="tel"
            name="phone"
            required
        >

        <label>Department</label>

        <select name="department" required>

            <option value="">Select Department</option>
            <option value="CSE">CSE</option>
            <option value="EEE">EEE</option>
            <option value="Civil">Civil Engineering</option>
            <option value="BBA">BBA</option>

        </select>

        <label>Program</label>

        <select name="program" required>

            <option value="">Select Program</option>
            <option value="BSc">BSc</option>
            <option value="BBA">BBA</option>
            <option value="MSc">MSc</option>
            <option value="MBA">MBA</option>

        </select>

        <label>Batch</label>

        <input
            type="text"
            name="batch"
            placeholder="Example: 63"
            required
        >

        <label>Address</label>

        <textarea
            name="address"
            rows="4"
            required
        ></textarea>

        <label class="remember">

            <input
                type="checkbox"
                name="remember"
            >

            Remember Student ID

        </label>

        <button type="submit" name="next">
            Next
        </button>

    </form>

</div>

</body>

</html>