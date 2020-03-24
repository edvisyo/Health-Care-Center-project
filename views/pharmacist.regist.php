<?php
require_once("../classes/database.class.php");
require_once("../classes/admin.class.php");

if(isset($_POST['registPharmacist'])) {

    $pharmacist = new Admin();
    $success_message = '';
    $default_role = 4;

    $role_id = $default_role;
    $email = $_POST['email'];
    $password = $_POST['password'];

    $pharmacist->insertData2('prisijungimas', $role_id, $email, $password);
    $id = $pharmacist->lastId();

    $data_array = array(
        'prisijungimas_id' => $id,
        'vardas' => $_POST['name'],
        'pavarde' => $_POST['lastname'],
        'darbovietes_pavadinimas' => $_POST['work']
    );

    if($pharmacist->insertData('vaistininkai', $data_array)) {
        $success_message = "Uzregistruota!";
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
<div id="pharmacistRegistForm">
<h4>Vaistininko registracija</h4>
<div class="row justify-content-center">
<div style="width: 55rem;">
    <button type="button" style="margin-right: 20px" onclick="closePharmacistForm()" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  <div class="card-body">
    <form action="admin.page.php" method="POST">
        <div class="form-group">
            <label for="exampleFormControlInput2"><span>*</span>Vardas</label>
            <input type="text" name="name" class="form-control" id="exampleFormControlInput2">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput3"><span>*</span>Pavarde</label>
            <input type="text" name="lastname" class="form-control" id="exampleFormControlInput3">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput4"><span>*</span>Darbovietes pavadinimas</label>
            <input type="text" name="work" class="form-control" id="exampleFormControlInput4">
        </div>
        <p><strong>Vartotojo internetinei prieigai reikalingi duomenys:</strong></p>
        <div class="form-group">
            <label for="exampleFormControlInput5"><span>*</span>El.Pasto adresas</label>
            <input type="email" name="email" class="form-control" id="exampleFormControlInput5">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput6"><span>*</span>Slaptazodis</label>
            <input type="password" name="password" class="form-control" id="exampleFormControlInput6">
        </div>
        <button type="submit" name="registPharmacist" class="btn btn-success">Registruoti</button>
        
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