<?php
require_once("../classes/database.class.php");
require_once("../classes/pagination.class.php");
session_start();

date_default_timezone_set("Europe/Vilnius");
$time = date("Y-m-d H:i");

$data = new Database();


$id = $_SESSION['loggedInId'];
$pacient_data = $data->getData("SELECT vardas, pavarde, gimimo_data FROM pacientai WHERE prisijungimas_id= '$id'");
if($pacient_data) {
    foreach($pacient_data as $patient) {
        $name = $patient['vardas'];
        $lastname = $patient['pavarde'];
        $birthdate = $patient['gimimo_data'];
    }
}
$pagination = new Pagination('receptai', $name, $lastname, $birthdate);

//$recepts = $data->getData("SELECT * FROM receptai WHERE pacientas_vardas= '$name' AND pacientas_pavarde= '$lastname' AND pacientas_gimimo_data= '$birthdate' ORDER BY recepto_israsymo_data DESC");
//if($recepts) {
  //foreach($recepts as $oneId) {
    //$onlyId = $oneId['id'];
    //echo $onlyId;
    //$asOne = array($onlyId);
    //print_r($asOne);
  //}
//}

$allReceptsPages = $pagination->getRecords($name, $lastname, $birthdate);
$pages = $pagination->getPageNumbers();

$recept_usage = $data->countData("SELECT receptas_id FROM vaistu_pirkimas WHERE pacientas_vardas= '$name' AND pacientas_pavarde= '$lastname' AND pacientas_gimimo_data= '$birthdate' ORDER BY recepto_israsymo_data DESC");
//$recept_usage = $data->getData("SELECT pacientas_vardas, pacientas_pavarde, pacientas_gimimo_data, COUNT(receptas_id) FROM vaistu_pirkimas WHERE pacientas_vardas= '$name' AND pacientas_pavarde= '$lastname' AND pacientas_gimimo_data= '$birthdate' GROUP BY receptas_id");
//$recept_usage = $data->getData("SELECT pacientas_vardas, pacientas_pavarde, pacientas_gimimo_data, COUNT(receptas_id) FROM vaistu_pirkimas WHERE pacientas_vardas= '$name' AND pacientas_pavarde= '$lastname' AND pacientas_gimimo_data= '$birthdate'");

//$recept_usage = $data->countData("SELECT receptas_id, COUNT(receptas_id) FROM vaistu_pirkimas WHERE pacientas_vardas= '$name' AND pacientas_pavarde= '$lastname' AND pacientas_gimimo_data= '$birthdate' AND receptas_id= 9");
// if(is_array($recept_usage) || is_object($recept_usage)) {
//   foreach($recept_usage as $onlyOne) {
//     echo $onlyOne['receptas_id'];
//   }
// } else {
//   echo 'nothing found';
// }

//$recept_id = 9;
//$recept_usage = $data->countData("SELECT receptas_id FROM vaistu_pirkimas");

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
    <div class="container">
    <h4>Receptu puslapis</h4>
    <a href="patient.page.php"><i class="fas fa-arrow-left"></i> Grįžti į pagrindinį puslapį</a>
        <?php if($allReceptsPages) {?>
        <?php foreach($allReceptsPages as $receptsPages) { ?>
        <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Recepto išrašymo data: <?php echo date('Y-m-d H:i',strtotime($receptsPages->recepto_israsymo_data)); ?></h6>
    <div class="media text-muted pt-3">
      <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-gray-dark">Pacientas: <?php echo $receptsPages->pacientas_vardas.' '.$receptsPages->pacientas_pavarde; ?></strong>
          <?php echo $receptsPages->id; ?>
          <a href="receptdetails.page.php?recept%id=<?php echo $receptsPages->id; ?>">Peržiūrėti</a>
        </div>
        <span class="d-block">Gydytojas: <?php echo $receptsPages->gydytojas_vardas.' '.$receptsPages->gydytojas_pavarde; ?></span>
        <p style="text-align: right">Receptas galioja iki: <?php if($receptsPages->recepto_galiojimas_iki != 0000-00-00){ echo $receptsPages->recepto_galiojimas_iki;} if($receptsPages->recepto_galiojimas_iki == 0000-00-00 ) { echo $receptsPages->neterminuotas; } else if($receptsPages->recepto_galiojimas_iki < $time){ echo '<div class="row justify-content-center"><h5 style="color: white; border: 3px solid red; border-radius: 5px; padding: 5px 5px; background-color: red">RECEPTAS NEBEGALIOJA</h5></div>'; } //echo '<div class="row justify-content-center"><h4 style="color: red; border-bottom: 3px solid red;">RECEPTAS NEBEGALIOJA</h4></div>'; } ?></p>
        <b>Receptas panaudotas: <?php echo $recept_usage; ?></b>
        <!-- <b>Receptas panaudotas: <?php //if($recept_usage){ foreach($recept_usage as $usage) { echo $usage['COUNT(receptas_id)']; }} else { echo 0; } ?></b> -->
      </div>
    </div>
  </div>
  <?php } ?>
  
  
        <?php } else if($allReceptsPages < $pages) {?>
        <?php echo "Jums israsytu receptu nera"; ?>
        <?php } ?>
        <div class="row justify-content-center">
        <nav aria-label="Page navigation example" style="margin-bottom: 80px">
        <ul class="pagination justify-content-center">
            <li class="page-item">
            <a class="page-link" href="recepts.page.php?page=<?php echo $pagination->prevPage(); ?>" tabindex="-1" aria-disabled="true">Atgal</a>
            </li>
            <?php for($page = 1; $page <= $pages; $page++) { ?>
            <li class="page-item <?php echo $pagination->isActive($page); ?>"><a class="page-link" href="recepts.page.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
            <?php } ?>
            <li class="page-item">
            <a class="page-link" href="recepts.page.php?page=<?php echo $pagination->nextPage($page); ?>">Pirmyn</a>
            </li>
        </ul>
        </nav>
        </div>
      </div>
</body>
</html>