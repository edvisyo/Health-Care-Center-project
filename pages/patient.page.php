<?php
require_once("../classes/database.class.php");
ob_start();
session_start();

$id = $_SESSION['loggedInId'];

$db = new Database();
$all = $db->getData("SELECT * FROM pacientai WHERE prisijungimas_id= '$id'");

if($all) {
    foreach($all as $one) {
        $name = $one['vardas'];
        $lastname = $one['pavarde'];
        $birthdate = $one['gimimo_data'];
    }
}

$patientVisit = new Database();
$allVisits = $patientVisit->getData("SELECT * FROM vizitai WHERE pacientas_vardas= '$name' AND pacientas_pavarde= '$lastname' AND pacientas_gimimo_data= '$birthdate' ORDER BY vizito_data ASC");

//$admin = hash('sha256', "admin");
//echo $admin.'<br>';
//$admin2 = "admin";
//echo md5($admin2);
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
    <h5>Jūsų <?php echo $name.' '.$lastname; ?>, vizitų sąrašas:</h5>
    <hr>
    <p>Prisijungimo slaptazodi galite pasikeisti paspaudę čia: <a href="../views/changepassword.view.php">Keisti slaptažodį</a></p>
    <p>Jūsų receptų sąrašą galite rasti paspaudę čia: <a href="recepts.page.php">Peržiūrėti receptus</a></p>
    <br>
<?php if($allVisits) { ?>
    <?php foreach($allVisits as $visit) { ?>
<div class="card" style="margin-bottom: 45px">
  <h5 class="card-header">Vizito data: <a href="visitdetails.page.php?visit%id=<?php echo $visit['id']; ?>"><?php echo date('Y-m-d H:i',strtotime($visit['vizito_data'])); ?></a></h5>
  <div class="card-body">
    <h5 class="card-title">Ligos kodas:</h5><p><?php echo $visit['tlk_10']; ?></p>
    <p class="card-text" style="text-align: right">Gydytojo vardas, pavardė: <?php echo $visit['gydytojas_vardas'].' '.$visit['gydytojas_pavarde']; ?></p>
    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
  </div>
</div>
<?php } ?>
<?php } else {?>
<?php echo "Šiuo metu paskirtų vizitų neturite." ?>
<?php } ?>

<?php ob_end_flush(); ?>
</div>
</main>
</body>
</html>