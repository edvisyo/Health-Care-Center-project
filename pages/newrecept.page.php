<?php
require_once("../classes/database.class.php");
require_once("../classes/admin.class.php");
session_start();
$id = $_SESSION['loggedInId'];

$db = new Database();
$current_doc_info = $db->getData("SELECT vardas, pavarde FROM gydytojai WHERE prisijungimas_id= '$id'");

if(isset($_POST['save'])) {
    $insert_data = new Admin();

    $data_array = array(
        'pacientas_vardas' => $_POST['name'],
        'pacientas_pavarde' => $_POST['lastname'],
        'pacientas_gimimo_data' => $_POST['birthdate'],
        'veiklioji_medziaga' => $_POST['type'],
        'kiekis_vienoje_dozeje' => $_POST['quant'],
        'matavimo_vienetas' => $_POST['quant_type'],
        'vartojimo_aprasymas' => $_POST['summary'],
        'recepto_galiojimas_iki' => $_POST['expired_date']?$_POST['expired_date']: "NULL",
        'neterminuotas' => isset($_POST['timeless'])?$_POST['timeless']:"",
        'gydytojas_vardas' => $_POST['current_doc_name'],
        'gydytojas_pavarde' => $_POST['current_doc_lastname']
    );

    $insert_data->insertData('receptai', $data_array);
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
<header>
    <?php include "../includes/navigation.inc.php"; ?>
</header>
<main>
    <div class="container">
        <h4>Receptų išrašymas:</h4>
<form action="newrecept.page.php" method="POST">
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputEmail4">Paciento vardas:</label>
      <input type="text" name="name" class="form-control" id="inputEmail4">
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Paciento pavardė:</label>
      <input type="text" name="lastname" class="form-control" id="inputPassword4">
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Paciento gimimo data:</label>
      <input type="date" name="birthdate" class="form-control" id="inputPassword4">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Vaisto veiklioji medžiaga:</label>
    <input type="text" name="type" class="form-control" id="inputAddress" placeholder="">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Veikliosios medžiagos kiekis vienoje dozėje (teigiamas skaičius):</label>
    <input type="text" name="quant" class="form-control" id="inputAddress2" placeholder="">
  </div>
  <div class="form-group">
      <label for="inputState3">Veikliosios medžiagos matavimo vienetas:</label>
      <select id="inputState3" name="quant_type" class="form-control">
        <option>Pasirinkti...</option>
        <option value="miligramai">miligramai</option>
        <option value="mikrogramai">mikrogramai</option>
        <option value="TV/IU">TV/IU</option>
      </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Vartojimo aprašymas:</label>
    <textarea class="form-control" name="summary" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputState">Receptas galioja iki:</label>
      <input type="date" name="expired_date" class="form-control" id="inputState">
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" name="timeless" value="Neterminuotas" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Neterminuotas receptas
      </label>
    </div>
  </div>
  <?php if($current_doc_info) { ?>
    <?php foreach($current_doc_info as $current) { ?>
        <input type="hidden" name="current_doc_name" value="<?php echo $current['vardas']; ?>"> 
        <input type="hidden" name="current_doc_lastname" value="<?php echo $current['pavarde']; ?>"> 
    <?php } ?>
   <?php } ?>
  <button type="submit" name="save" class="btn btn-primary">Įrašyti</button>
</form>
    </div>
</main>
</body>
</html>