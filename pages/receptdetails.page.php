<?php
require_once("../classes/database.class.php");
session_start();

date_default_timezone_set("Europe/Vilnius");
$time = date("Y-m-d H:i");

$recept_id = $_GET['recept%id'];

$recept_data = new Database();
$found_recept = $recept_data->getData("SELECT * FROM receptai  WHERE id= '$recept_id'");

$recept_usage = $recept_data->getData("SELECT pirkimo_data, vaistininkas_vardas, vaistininkas_pavarde FROM vaistu_pirkimas WHERE receptas_id= '$recept_id'")
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
<?php if($found_recept) { ?>
        <?php foreach($found_recept as $data) { ?>
            <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col" row="2"></th>
      <th scope="col">Vaisto veiklioji medziaga</th>
      <th scope="col">Kiekis vienoje dozeje</th>
      <th scope="col">Matavimo vienetas</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"></th>
      <td><?php echo $data['veiklioji_medziaga']; ?></td>
      <td><?php echo $data['kiekis_vienoje_dozeje']; ?></td>
      <td><?php echo $data['matavimo_vienetas']; ?></td>
    </tr>
    <tr>
      <th scope="row">Vaisto aprasymas:</th>
      <td colspan= "3"><?php echo $data['vartojimo_aprasymas']; ?></td>
      <!-- <td><?php //echo $data['kiekis_vienoje_dozeje']; ?></td> -->
      <!-- <td><?php //echo $data['matavimo_vienetas']; ?></td> -->
    </tr>
    <tr>
      <th scope="row">Receptas galioja iki:</th>
      <td colspan= "2"><?php if($data['recepto_galiojimas_iki'] != 0000-00-00){ echo $data['recepto_galiojimas_iki'];} if($data['recepto_galiojimas_iki'] == 0000-00-00) { echo $data['neterminuotas']; } else if($data['recepto_galiojimas_iki'] < $time){ echo '<p style="color: red">Sis receptas nebegalioja</p>'; } ?></td>
      <td><?php //echo $data['kiekis_vienoje_dozeje']; ?></td>
      <!-- <td><?php //echo $data['matavimo_vienetas']; ?></td> -->
    </tr>
  </tbody>
</table>
       
        <?php } ?>
    <?php } ?>
    <h4>Recepto panaudojimas:</h4>
    <?php if($recept_usage) { ?>
    <?php foreach($recept_usage as $usage) { ?>
    <ul>
      <li><?php echo date('Y-m-d H:i',strtotime($usage['pirkimo_data'])).'</br>'.' Vaistinikas: '. $usage['vaistininkas_vardas'].' '. $usage['vaistininkas_pavarde']; ?> </li>
    </ul>
    <?php } ?>
    <?php } else { ?>
    <?php echo "Sis receptas dar nepanaudotas."; ?>
    <?php } ?>
</div>
</main>
</body>
</html>