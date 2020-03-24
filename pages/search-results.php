<?php
require_once("../classes/database.class.php");
session_start();
$patient_id = $_GET['result'];
$data = new Database();
$patient_data = $data->getData("SELECT * FROM pacientas_gydytojas WHERE id= '$patient_id'");


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
<div style="float: left;">
    <nav class="nav flex-column">
      <a class="nav-link" href="../views/patient.history.php?patient=<?php echo $patient_id; ?>">Perziureti paciento ligos istorija</a>
      <a class="nav-link" href="../views/patient.recepts.php?patient=<?php echo $patient_id; ?>">Perziureti paciento receptu istorija</a>
    </nav>
</div>
<div style="float: right;">
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
      
        <?php if($patient_data) { ?>
            <?php foreach($patient_data as $patient) { ?>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="search_firstName">Vardas:</label>
            <input type="text" class="form-control" id="search_firstName" name="name" placeholder="" value="aaa<?php echo $patient['vardas']; ?>" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="search_lastName">Pavardė:</label>
            <input type="text" class="form-control" id="search_lastName" name="lastname" placeholder="" value="<?php echo $patient['pavarde']; ?>" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="search_birthdate">Gimimo data:</label>
          <div class="input-group">
            <input type="date" class="form-control" id="search_birthdate" name="birthdate" placeholder="" value="<?php echo $patient['gimimo_data']; ?>" required>
          </div>
        </div>
            <?php } ?>
        <?php } ?>
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
              <option value="taip">TAIP</option>
              <option value="ne">NE</option>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label for="state">Ar vizitas yra pakartotinis dėl tos pačios priežasties:</label>
            <select class="custom-select d-block w-100" name="is_repeated" id="state" required>
              <option value="">Pasirinkite...</option>
              <option value="taip">TAIP</option>
              <option value="ne">NE</option>
            </select>
          </div>
            <?php  //if($allDoc) { ?>
            <?php  //foreach($allDoc as $one) { ?>
              <input type="hidden" name="doctorId" value="<?php //echo $one->getId(); ?>">
              <input type="hidden" name="doctor_name" value="<?php //echo $one->getName(); ?>">
              <input type="hidden" name="doctor_lastname" value="<?php //echo $one->getLastname(); ?>">
            <?php  //} ?>
          <?php  //} ?>
          
        </div>
        <div class="row justify-content-end" style="padding-right: 15px">
        <button type="submit" name="regist" class="btn btn-primary">Registruoti</button>
        </div>
      </form>
    </div>
    </div>
  </div>
  </div>
</main>
</body>
</html>