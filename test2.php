<?php 
require_once "classes/database.class.php";
require_once "classes/admin.class.php";

date_default_timezone_set("Europe/Vilnius");
$time = date("Y-m-d H:i");

$db = new Database();

echo "Receptai:".'</br>';
$recepts = $db->getData("SELECT * FROM receptai WHERE pacientas_vardas= 'antanas' AND pacientas_pavarde= 'jakutis' AND pacientas_gimimo_data= '1993-02-11' ORDER BY recepto_israsymo_data DESC");
if($recepts) {
  foreach($recepts as $recept) {
    echo $recept['id'].'</br>';
  }
}

echo'<br>';
echo "Kiekvieno recepto panaudojimas:".'</br>';
$zz = $db->getData("SELECT pacientas_vardas, COUNT(receptas_id) FROM vaistu_pirkimas WHERE pacientas_vardas = 'antanas' GROUP BY receptas_id DESC");
foreach($zz as $a) {
    echo $a['COUNT(receptas_id)'].' '.$a['pacientas_vardas'].'<br/>';
}

echo '<br>';
echo "Receptu id masyvas:".'</br>';
$getIds = $db->getData("SELECT receptas_id FROM vaistu_pirkimas");
    if($getIds) {
        foreach($getIds as $oneId) {
            $arr[] = $oneId;
           
        }
    } 
    print_r($arr);
echo '<hr>';

// $recepts = $db->getData("SELECT receptai.id, COUNT(vaistu_pirkimas.receptas_id) as kzk FROM `vaistu_pirkimas` INNER JOIN `receptai` ON vaistu_pirkimas.receptas_id = receptai.id GROUP BY receptas_id");
// if($recepts) {
//     foreach($recepts as $recept) {
//         echo $recept['kzk'];
//     }
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<br>
<br>
<div class="container">
    <h4>Receptu puslapis</h4>
        <?php if($recepts) {?>
        <?php foreach($recepts as $recept) { ?>
        <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Recepto išrašymo data: <?php echo date('Y-m-d H:i',strtotime($recept['recepto_israsymo_data'])); ?></h6>
    <div class="media text-muted pt-3">
      <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-gray-dark">Pacientas: <?php echo $recept['pacientas_vardas'].' '.$recept['pacientas_pavarde']; ?></strong>
          <?php echo $recept['id']; ?>
          <a href="receptdetails.page.php?recept%id=<?php echo $recept['id']; ?>">Peržiūrėti</a>
        </div>
        <span class="d-block">Gydytojas: <?php echo $recept['gydytojas_vardas'].' '.$recept['gydytojas_pavarde']; ?></span>
        <p style="text-align: right">Receptas galioja iki: <?php if($recept['recepto_galiojimas_iki'] != 0000-00-00){ echo $recept['recepto_galiojimas_iki'];} if($recept['recepto_galiojimas_iki'] == 0000-00-00 ) { echo $recept['neterminuotas']; } else if($recept['recepto_galiojimas_iki'] < $time){ echo '<div class="row justify-content-center"><h5 style="color: white; border: 3px solid red; border-radius: 5px; padding: 5px 5px; background-color: red">RECEPTAS NEBEGALIOJA</h5></div>'; } //echo '<div class="row justify-content-center"><h4 style="color: red; border-bottom: 3px solid red;">RECEPTAS NEBEGALIOJA</h4></div>'; } ?></p>
        <!-- <b>Receptas panaudotas: <?php //echo $a['COUNT(receptas_id)']; ?></b> -->
        <!-- <b>Receptas panaudotas: <?php //if($recept_usage){ foreach($recept_usage as $usage) { echo $usage['COUNT(receptas_id)']; }} else { echo 0; } ?></b> -->
        <?php foreach($zz as $a) { ?>
     <h5>panaudota: <?php echo $a['COUNT(receptas_id)']; ?></h5> 
<?php } ?>
      </div>
    </div>
  </div>
  <?php } ?>
        <?php }  else {?>
        <?php echo "Jums israsytu receptu nera"; ?>
        <?php } ?>
    </div> 
</body>
</html>