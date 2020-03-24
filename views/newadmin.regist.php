<?php
require_once("../classes/database.class.php");
require_once("../classes/admin.class.php");
require_once("../classes/validation.class.php");

//$errors = array();

//$validate = new Validation($_POST);
//$errors = $validate->validateForm();

    

    if(isset($_POST['regist_user'])) {

        //if($_POST['password'] != $_POST['password2'] ) {
            //array_push($errors, "Ivesti slaptazodziai nesutampa!");
        //}
        $validate = new Validation($_POST);
        $errors = $validate->validateForm();
        if(count($errors) == 0) {

        $new_admin = new Admin();
        $success_message = '';
        $default_role = 1;
        $hash = hash('sha256', $_POST['password2']);

        $data_array = array(
            'role_id' => $default_role,   
            'email' => $_POST['email'],
            'password' => $hash
        );

        if($new_admin->insertData('prisijungimas', $data_array)) {
            $success_message = "Uzregistruota!";
        }
        
}
}  
?>    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../CSS/style.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
<div id="userRegistForm">
<h4>Administratoriaus registracija</h4>
<div class="row justify-content-center">
<div style="width: 55rem;">
    <button type="button" style="margin-right: 20px" onclick="closeUserForm()" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  <div class="card-body">
    <form action="admin.page.php" method="POST">
        <div class="form-group">
            <label for="exampleFormControlInput2"><span>*</span>El.Pasto adresas</label>
            <input type="email" name="email" class="form-control" id="exampleFormControlInput2">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput5"><span>*</span>Slaptazodis</label>
            <input type="password" name="password" class="form-control" id="exampleFormControlInput5">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput6"><span>*</span>Pakartoti slaptazodi</label>
            <input type="password" name="password2" class="form-control" id="exampleFormControlInput6">
        </div>
        <button type="submit" name="regist_user" class="btn btn-success">Registruoti</button>
        
    </form>
  </div>
</div>
</div>
</div>


<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<script src="../script/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>