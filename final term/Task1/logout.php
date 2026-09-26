<?php

session_start();

session_unset();

session_destroy();

if (isset($_COOKIE["remember_user"])) {

    setcookie(
        "remember_user",
        "",
        time() - 3600,
        "/"
    );
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>

<div class="container">

    <h2>Logout Successful</h2>

    <p>
        The session has been destroyed and the Remember Me cookie has been removed.
    </p>

    <a href="index.php">Go to Login</a>

</div>

</body>
</html>