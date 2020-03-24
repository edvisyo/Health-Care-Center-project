<?php 
ob_start();
session_start();

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
<header>
    <?php include "../includes/navigation.inc.php"; ?>
</header>

<main>

    <div class="container-fluid">
        <div style="text-align: center; margin-bottom: 50px">
        Administratoriaus puslapis
        </div>
        <div class="row justify-content-between">
        <div class="admin_nav">
        <div class="" style="width: 22rem;">
            <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><span class="badge badge-pill badge-warning">0</span> <a href="../views/changepassword.view.php">Keisti slaptažodį</a></li>
                <li class="list-group-item"><span class="badge badge-pill badge-secondary">1</span> <a href="#" onclick="userRegistForm()">Naujo administratoriaus registracija</a></li>
                <li class="list-group-item"><span class="badge badge-pill badge-secondary">2</span> <a href="#" onclick="patientRegistForm()">Naujo paciento registracija</a></li>
                <li class="list-group-item"><span class="badge badge-pill badge-secondary">3</span> <a href="#" onclick="doctorRegistForm()">Naujo gydytojo registracija</a></li>
                <li class="list-group-item"><span class="badge badge-pill badge-secondary">4</span> <a href="#" onclick="pharmacistRegistForm()">Naujo vaistininko registracija</a></li>
                <li class="list-group-item"><span class="badge badge-pill badge-success">5</span> <a href="#" onclick="assignForm()">Priskirti pacienta gydytojui</a></li>
            </ul>
            </div>
        </div>
    </div>
    <?php include_once("../views/doctor.regist.php"); ?>
    <?php include_once("../views/patient.regist.php"); ?>
    <?php include_once("../views/pharmacist.regist.php"); ?>
    <?php include_once("../views/assign_to_doctor.regist.php"); ?>
    <?php include_once("../views/newadmin.regist.php"); ?>
    </div>

    <div style="text-align: center">
    <?php if(isset($success_message)) { ?>
        <div class="alert alert-success" role="alert">
        <?php echo "Uzregistruota!"; ?>
       <?php //echo $success_message; ?>
       </div>
       <?php //header("Refresh: 2.5; url=admin.page.php"); ?>
   <?php } ?>
    </div>

    <div style="text-align: center">
    <?php if (isset($errors) && count($errors) > 0) { ?>
        <?php foreach ($errors AS $value) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $value; ?>
                </div>
                <?php } ?>
                <?php //header("Refresh: 3.5; url=admin.page.php"); ?>
            <?php } ?>
    </div>

    </div>    
</main>

<?php ob_end_flush(); ?>
</body>
</html>