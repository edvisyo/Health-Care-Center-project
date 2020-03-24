<?php
include_once("classes/database.class.php");
include_once("classes/login.class.php");
session_start();
if(isset($_POST['login'])) {

    $user = new Login();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user->LoginUser($email, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="loginForm" id="loginForm">
<div class="row justify-content-center">
    <form action="index.php" method="POST">
        <div class="card" style="width: 30rem;">
            <div class="card-body">
            <div class="row justify-content-end">
                <button type="button" onclick="closeLoginForm()" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <h5 class="card-title">Prisijungimas</h5>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Jūsų elektroninis pastas" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Jūsų slaptažodis" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <button type="submit" name="login" class="btn btn-primary">Prisijungti</button>
            </div>
        </div>
    </form>
</div>
</div>

 
</body>
</html>