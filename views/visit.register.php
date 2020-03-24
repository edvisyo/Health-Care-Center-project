<?php
require_once("../classes/database.class.php");
require_once("../classes/admin.class.php");
require_once("../classes/doctor.class.php");
require_once("../classes/getdoctor.class.php");

$loggedInId = $_SESSION['loggedInId']; 

$doctors = new Doctor();
$allDoc = $doctors->getDocData("SELECT id, prisijungimas_id, vardas, pavarde, specializacija, kita_specializacija FROM gydytojai WHERE prisijungimas_id= $loggedInId");


if(isset($_POST['regist'])) {

  $newVisit = new Admin();

  $data_array = array(
    'pacientas_vardas' => $_POST['name'],
    'pacientas_pavarde' => $_POST['lastname'],
    'pacientas_gimimo_data' => $_POST['birthdate'],
    'gydytojas_id' => $_POST['doctorId'],
    'gydytojas_vardas' => $_POST['doctor_name'],
    'gydytojas_pavarde' => $_POST['doctor_lastname'],
    'vizito_data' => $_POST['date'],
    'vizito_trukme' => $_POST['time'],
    'tlk_10' => $_POST['tlk10'],
    'vizito_aprasymas' => $_POST['summary'],
    'kompensacija' => $_POST['comp'],
    'pakartojimas' => $_POST['is_repeated'],
  );

  $newVisit->insertData('vizitai', $data_array);
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
<div style="float: right">
<div class="col-md-11 order-md-1">
      <h4 class="mb-3">Vizito registracija:</h4>
      <form class="needs-validation" action="doctor.page.php" method="POST">

      <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Vizito data:</label>
            <input type="datetime-local" class="form-control" name="date" id="firstName" placeholder="" value="" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Vizito trukmė:</label>
            <input type="time" class="form-control" name="time" id="lastName" placeholder="" value="" required>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Vardas:</label>
            <input type="text" class="form-control" id="firstName" name="name" placeholder="" value="" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Pavardė:</label>
            <input type="text" class="form-control" id="lastName" name="lastname" placeholder="" value="" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="username">Gimimo data:</label>
          <div class="input-group">
            <input type="date" class="form-control" id="username" name="birthdate" placeholder="" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">TLK_10 ligos kodas:</label>
          <input type="text" class="form-control" name="tlk10" id="email" placeholder="">
        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Vizito aprašymas:</label>
            <textarea class="form-control" name="summary" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>

        <!-- <div class="mb-3">
          <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
          <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
        </div> -->

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="country">Ar vizitas kompensuojamas Valstybinės ligonių kasos:</label>
            <select class="custom-select d-block w-100" name="comp" id="country" required>
              <option value="">Pasirinkite...</option>
              <option value="Taip">TAIP</option>
              <option value="Ne">NE</option>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label for="state">Ar vizitas yra pakartotinis dėl tos pačios priežasties:</label>
            <select class="custom-select d-block w-100" name="is_repeated" id="state" required>
              <option value="">Pasirinkite...</option>
              <option value="Taip">TAIP</option>
              <option value="Ne">NE</option>
            </select>
          </div>
            <?php  if($allDoc) { ?>
            <?php  foreach($allDoc as $one) { ?>
              <input type="hidden" name="doctorId" value="<?php echo $one->getId(); ?>">
              <input type="hidden" name="doctor_name" value="<?php echo $one->getName(); ?>">
              <input type="hidden" name="doctor_lastname" value="<?php echo $one->getLastname(); ?>">
            <?php  } ?>
          <?php  } ?>
          
        </div>
        <div class="row justify-content-end" style="padding-right: 15px">
        <button type="submit" name="regist" class="btn btn-primary">Registruoti</button>
        </div>
      </form>
    </div>
  </div>
  </div>



<script src="https://code.jquery.com/jquery-3.4.1.js"
integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
crossorigin="anonymous"></script>
<script src="../script/script.js?v=<?php echo time(); ?>"></script>
</body>
</html>