<?php

session_start();

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $age = $_POST["age"];
    $phonenumber = $_POST["phonenumber"];

    // Store data in session
    $_SESSION["username"] = $username;
    $_SESSION["age"] = $age;
    $_SESSION["phonenumber"] = $phonenumber;

    // Create cookie if Remember Me is checked
    if (isset($_POST["remember"])) {
        setcookie(
            "remember_user",
            $username,
            time() + (86400 * 30),
            "/"
        );
    }

    // Go to dashboard
    header("Location: dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Session and Cookie Demo</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h2>Login</h2>

    <form method="POST">

        <label>Username</label>
        <input
            type="text"
            name="username"
            required
        >

        <br><br>

        <label>Age</label>
        <input
            type="number"
            name="age"
            min="1"
            required
        >

        <br><br>

        <label>Phone Number</label>
        <input
            type="tel"
            name="phonenumber"
            pattern="[0-9]{11}"
            minlength="11"
            maxlength="11"
            required
        >

        <br><br>

        <label>
            <input
                type="checkbox"
                name="remember"
            >
            Remember Me
        </label>

        <br><br>

        <button type="submit" name="login">
            Login
        </button>

    </form>

</div>

</body>
</html>