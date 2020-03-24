<?php
require_once("../classes/database.class.php");
session_start();
$id = $_SESSION['loggedInId'];

$db = new Database();
$current_doctor = $db->getData("SELECT id FROM gydytojai WHERE prisijungimas_id= '$id'");
if($current_doctor) {
  foreach($current_doctor as $doctor) {
      $doc_id = $doctor['id'];
  }
}
$patients_data = $db->getData("SELECT * FROM pacientas_gydytojas WHERE gydytojo_id= '$doc_id'");
if($patients_data) {
  foreach($patients_data as $data) {
    $name = $data['vardas'];
    $lastname = $data['pavarde'];
    $date = $data['gimimo_data'];
  }
} if(empty($patients_data)) {
    $name = null;
    $lastname = null;
    $date = null;
}

$save_patients_data = $db->getData("SELECT vardas, pavarde, gimimo_data, asmens_kodas FROM pacientai WHERE vardas= '$name' AND pavarde= '$lastname' AND gimimo_data= '$date'");
if(isset($_POST['save'])) {
  $file = fopen('../patientExports/patientList.txt', 'w') or die("Cannot export file");
  $txt = $save_patients_data;
  fwrite($file, print_r($txt, TRUE));
  fclose($file);
  echo '<script>alert("Jusu failas irasytas")</script>';
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
    Daktaro puslapis
    
<div class="nav" style="float: left; padding-top: 25px">
<ul class="nav flex-column">
  <li class="nav-item">
    <a class="nav-link active" href="../views/changepassword.view.php">Keisti prisijungimo slaptažodį</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="newrecept.page.php">Naujo recepto išrašymas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="patient.list.page.php">Peržiūrėti pacientų sąrašą</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Peržiūrėti darbo dienų statistiką - </a>
  </li>
  <li class="nav-item">
    <form action="doctor.page.php" method="POST">
      <button type="submit" name="save" class="btn btn-warning" style="margin-left: 15px; margin-top: 15px">Eksportuoti pacientų sąrašą</button>
    </form>
  </li>
</ul>
</div>

<?php include "../views/visit.register.php"; ?>
</div>
</main>
</body>
</html>