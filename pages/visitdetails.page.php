<?php
session_start();
require_once("../classes/database.class.php");
require_once("../classes/visit.class.php");
require_once("../classes/getvisit.class.php");

$visit_id = intval($_GET['visit%id']);

$patientVisit = new Visit();
$allVisits = $patientVisit->getVisitInfo("SELECT * FROM vizitai WHERE id= '$visit_id'");

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
<?php include "../includes/navigation.inc.php"; ?>
    <div class="container">
        <h4>Detalus vizito aprašymas:</h4>
        <a href="patient.page.php"><i class="fas fa-arrow-left"></i> Grįžti į pagrindinį puslapį</a>
<hr>
        <?php if($allVisits) { ?>
            <?php foreach($allVisits as $one) { ?>
                    <p><strong>Paciento vardas, pavardė: </strong><?php echo $one->getName().' '. $one->getLastname(); ?></p>
                    <p><strong>Būsimo vizito data, laikas: </strong><?php echo date('Y-m-d H:i',strtotime($one->getVisitDate())); ?></p>
                    <p><strong>Planuojama vizito trukmė: </strong><?php echo date('H:i',strtotime($one->getVisitTime())).'min'; ?></p>
                    <p><strong>Ligos kodas: </strong><?php echo $one->getTlk(); ?></p>
                    <p><strong>Trumpas vizito aprašymas: </strong><?php echo $one->getVisitSummary(); ?></p>
                    <p><strong>Ar vizitas kompensuojamas valstybinės ligonių kasos: </strong><?php echo $one->getVisitComp(); ?></p>
                    <p><strong>Ar vizitas pakartotinis dėl tos pačios priežasties: </strong><?php echo $one->getVisitRep(); ?></p>    
            <?php  } ?>
       <?php } ?>
        
    </div>
</body>
</html>