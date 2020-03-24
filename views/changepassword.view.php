<?php
require_once("../classes/database.class.php");
session_start();



if(isset($_POST['change'])) {

    $change_pwd = new Database();
    $id = $_SESSION['loggedInId'];
    $current_password = $_POST['current_pwd'];
    $password = $_POST['new_pwd2'];

    $change_pwd->changePassword($password, $id, $current_password);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<header>
    <?php include "../includes/navigation.inc.php"; ?>
</header>
<main>
    <div class="container">
    <div class="row justify-content-center">
        <form action="changepassword.view.php" method="POST" class="form-signin" style="width: 50%">
            <div class="text-center mb-4">
                <img class="mb-4" src="" alt="" width="" height="">
                <h1 class="h3 mb-3 font-weight-normal">Slaptazodzio keitimas</h1>
                <p></p>
            </div>
            
            <div class="form-label-group">
                <label for="inputPassword">Esamas jūsų slaptažodis</label>
                <input type="password" name="current_pwd" id="inputPassword" class="form-control" placeholder="">
            </div>

            <div class="form-label-group">
                <label for="inputPassword1">Naujas slaptažodis</label>
                <input type="password" name="new_pwd" id="inputPassword1" class="form-control" placeholder="">
            </div>

            <div class="form-label-group">
                <label for="inputPassword2">Pakartokite naują slaptažodį</label>
                <input type="password" name="new_pwd2" id="inputPassword2" class="form-control" placeholder="">
            </div>
        <hr>
            <button class="btn btn-lg btn-primary btn-block" name="change" type="submit">Keisti</button>
            <p class="mt-5 mb-3 text-muted text-center">&copy; 2019-2020</p>
        </form>
    </div>
    </div>
</main>
</body>
</html>