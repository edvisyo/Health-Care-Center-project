<?php
require_once("../classes/database.class.php");
require_once("../classes/admin.class.php");

if(isset($_POST['regist'])) {

    $doctor = new Admin();
    $success_message = '';
    $default_role = 3;

    $role_id = $default_role;
    $email = $_POST['email'];
    $password = $_POST['password'];

    $doctor->insertData2('prisijungimas', $role_id, $email, $password);
    $id = $doctor->lastId();

    $data_array = array(
        'prisijungimas_id' => $id,
        'vardas' => $_POST['name'],
        'pavarde' => $_POST['lastname'],
        'specializacija' => $_POST['specialization'],
        'kita_specializacija' => $_POST['specialization2'] 
    );

    if($doctor->insertData('gydytojai', $data_array)) {
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
<div id="doctorRegistForm">
<h4>Gydytojo registracija</h4>
<div class="row justify-content-center">
<div style="width: 55rem;">
    <button type="button" style="margin-right: 20px" onclick="closeDoctorForm()" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  <div class="card-body">
    <form action="admin.page.php" method="POST">
        <div class="form-group">
            <label for="exampleFormControlInput1"><span>*</span>Vardas</label>
            <input type="text" name="name" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput2"><span>*</span>Pavarde</label>
            <input type="text" name="lastname" class="form-control" id="exampleFormControlInput2">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2"><span>*</span>Pasirinkite specializacija:</label>
            <select class="form-control" name="specialization" id="exampleFormControlSelect2">
                <option value="">Specializacijos..</option>
                    <option value="Seimos daktaras">Seimos daktaras</option>
                    <option value="Kardiologas">Kardiologas</option>
                    <option value="Neurologas">Neurologas</option>
            </select>
        </div>
        <p><strong>Jeigu nerandate specializacijos sarase, spauskite mygtuka irasyti!</strong></p>
        <button type="button" class="btn btn-light" id="addNewSpec">Irasyti</button>
        <div class="newSpecArea" id="newSpecArea">
        <div class="form-group">
            <label for="exampleFormControlTextarea1"><span>*</span>Specializacija</label>
            <textarea class="form-control" name="specialization2" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        </div>
        <br>
        <br>
        <p><strong>Vartotojo internetinei prieigai reikalingi duomenys:</strong></p>
        <div class="form-group">
            <label for="exampleFormControlInput5"><span>*</span>El.Pasto adresas</label>
            <input type="email" name="email" class="form-control" id="exampleFormControlInput5">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput6"><span>*</span>Slaptazodis</label>
            <input type="password" name="password" class="form-control" id="exampleFormControlInput6">
        </div>
        <button type="submit" name="regist" class="btn btn-success">Registruoti</button>
        
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



