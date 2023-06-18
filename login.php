<?php


include "./db/conn.php";
$DB = new Database();
$status = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "here";
    $username =  $_POST['username'];
    $password =  $_POST['pswd'];
    $s = "SELECT * FROM `admin` WHERE `userid` = '$username'";
    $resultData = $DB->RetriveSingle($s);
    if ($resultData && $resultData['password'] == $password) {
        session_start();
        $_SESSION['admin'] = true;
        header("Location: ./index");
    } else {
        $status = true;
        header("Location: ./login?q=invalid");
    }
}

if (isset($_GET['q']) && $_GET['q'] == 'invalid') {
    $status = true;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Multi State Cooperative Societies</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="shortcut icon" href="./assets/img/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="loginContainer">

        <img src="./assets/img/logo.png" alt="logo" class="loginLogo mb-1">
        <h2 class="text-center mb-3">Multi State Cooperative Societies</h2>
        <h6 class="text-secondary">Login to Continue</h6>

        <form action="login.php" method="POST" class="loginForm">
            <?php
            if ($status) {
                echo '
                    <div class="alert alert-danger text-center" role="alert">
                       Invalid Credentials
                    </div>
                    ';
            }
            ?>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" name="username" placeholder="User Name" required>
                <label for="floatingInput">User Name</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="pswd" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>
            <div class="passwordToggle my-1" id="toggleShowPassword">
                <input type="checkbox" name="show" id="passwordCheckbox">
                <p class="m-0 ms-2">Show Password</p>
            </div>

            <button class="btn btn-default mt-4 w-100" type="submit">Login</button>
        </form>

    </div>


    <script>
        const toggleShowPassword = document.getElementById("toggleShowPassword")

        const passwordCheckbox = document.getElementById('passwordCheckbox');
        const floatingPassword = document.getElementById('floatingPassword');

        toggleShowPassword.addEventListener("click", function() {

            passwordCheckbox.checked = !passwordCheckbox.checked;

            if (floatingPassword.type === 'password') {
                floatingPassword.type = 'text';
            } else {
                floatingPassword.type = 'password';
            }
        })
    </script>

</body>

</html>