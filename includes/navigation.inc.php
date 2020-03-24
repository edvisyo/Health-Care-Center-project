<?php
//include_once("classes/database.class.php");
//include_once("classes/database.class.php");
//include_once("autoloader.inc.php");

//session_start();
//if(isset($_POST['login'])) {

//    $user = new Login();

//    $email = $_POST['email'];
//    $password = $_POST['password'];

//    $user->LoginUser($email, $password);
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/all.css">
    <!-- MyStyle -->
    <link rel="stylesheet" href="../CSS/style.css?v=<?php echo time(); ?>">
    <title>SPC</title>
</head>
<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-0 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"><i class="fas fa-notes-medical fa-lg" style="color: #2b7cc7;"></i> Sveikatos Priežiūros Centras</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="../index.php">Pagrindinis</a>
            <a class="p-2 text-dark" href="pages/employees.page.php">Darbuotojai</a>
            <a class="p-2 text-dark" href="#">Paslaugos</a>
            <a class="p-2 text-dark" href="#">Kontaktai</a>
            <?php if(!isset($_SESSION['username'])) { ?>
            <a class="p-2 text-success" href="views/register.view.php">Registracija</a> 
            <?php } ?>
        </nav>
        <?php if(isset($_SESSION['username'])) { ?>
            <div class="session_name">
                Sveiki, <?php echo $_SESSION['username']; ?>!
            </div>
            <a class="btn btn-outline-primary" href="../includes/logout.php">Atsijungti</a>
       <?php } else if(!isset($_SESSION['username'])) { ?>
        <!-- <a class="p-2 text-success" href="views/register.view.php">Registracija</a> -->
        <a class="btn btn-outline-primary" onclick="openLoginForm()" href="#">Prisijungti</a>
       <?php } ?>
    </div> 

<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>