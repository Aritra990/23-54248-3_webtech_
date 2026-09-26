<?php

session_start();

// Remove all session variables
session_unset();

// Destroy session
session_destroy();

?>

<!DOCTYPE html>
<html>

<head>

    <title>Registration Complete</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <h2>Registration Successful</h2>

    <div class="success">

        <h3>Congratulations!</h3>

        <p>
            Your university course registration
            has been completed successfully.
        </p>

        <p>
            Your session data has been removed.
        </p>

    </div>

    <a href="index.php">
        Return to Registration
    </a>

</div>

</body>

</html>