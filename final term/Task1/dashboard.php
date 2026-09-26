<?php

session_start();

if (!isset($_SESSION["username"])) {
    header("Location: se_co.php");
    exit();
}

$username = $_SESSION["username"];
$age = $_SESSION["age"];
$phonenumber = $_SESSION["phonenumber"];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>

<div class="container">

    <h2>Dashboard</h2>

    <div class="info">

        <p>
            Welcome,
            <strong><?php echo $username; ?></strong>
        </p>

        <p>
            Age:
            <strong><?php echo $age; ?></strong>
        </p>

        <p>
            Phone Number:
            <strong><?php echo $phonenumber; ?></strong>
        </p>

        <p>
            This information is stored in the
            <strong>PHP Session</strong>.
        </p>

    </div>

    <a href="cookie.php">View Cookie</a>

    <br><br>

    <a href="logout.php">Logout</a>

</div>

</body>
</html>