<?php

session_start();

if (isset($_COOKIE["remember_user"])) {
    $username = $_COOKIE["remember_user"];
} else {
    $username = "No cookie found";
}

$age = isset($_SESSION["age"]) ? $_SESSION["age"] : "No age found";
$phonenumber = isset($_SESSION["phonenumber"]) ? $_SESSION["phonenumber"] : "No phone number found";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Cookie Demo</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>

<div class="container">

    <h2>Cookie Information</h2>

    <div class="info">

        <p>Remembered Username:</p>
        <strong>
            <?php echo $username; ?>
        </strong>

        <br><br>

        <p>Age:</p>
        <strong>
            <?php echo $age; ?>
        </strong>

        <br><br>

        <p>Phone Number:</p>
        <strong>
            <?php echo $phonenumber; ?>
        </strong>

    </div>

    <p>
        Username is retrieved from the browser cookie.
        Age and phone number are retrieved from the session.
    </p>

    <a href="dashboard.php">Back to Dashboard</a>

</div>

</body>
</html>