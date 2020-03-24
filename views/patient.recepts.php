<?php
include_once "../classes/database.class.php";
include_once "../classes/admin.class.php";
session_start();

$loggedDocId = $_SESSION['loggedInId'];
$patientId = $_GET['patient'];
$data = new Database();

$sessionDoc = $data->getData("SELECT vardas, pavarde FROM gydytojai WHERE prisijungimas_id = '$loggedDocId'");
if(!empty($sessionDoc)) {
    foreach($sessionDoc as $currentDoc) {
        $docName = $currentDoc['vardas'];
        $docLastname = $currentDoc['pavarde'];
    }
}

$patient = $data->getData("SELECT vardas, pavarde, gimimo_data FROM pacientas_gydytojas WHERE id = '$patientId'");

if(!empty($patient)) {
        foreach($patient as $currentPatient) {
            $name = $currentPatient['vardas'];
            $lastname = $currentPatient['pavarde'];
            $birthdate = $currentPatient['gimimo_data'];
        }
    }

$patienRecepts = $data->getData("SELECT * FROM receptai WHERE pacientas_vardas = '$name' AND pacientas_pavarde = '$lastname' AND pacientas_gimimo_data = '$birthdate' AND gydytojas_vardas = '$docName' AND gydytojas_pavarde = '$docLastname' ORDER BY recepto_israsymo_data DESC");

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
        <?php include_once "../includes/navigation.inc.php"; ?>
    </header>
    <main>
        <div class="container">
        <h4>Paciento <?php echo "'".$name.' '.$lastname."'"; ?> receptu sarasas:</h4>
            <?php if(!empty($patienRecepts)) { ?>
            <?php foreach($patienRecepts as $recepts) { ?>
        <div class="card" style="margin-bottom: 30px;">
            <div class="card-body">
            <h5>Paciento gimimo data: <?php echo $recepts['pacientas_gimimo_data']; ?></h5>
            <h5 class="card-title">Vaisto veiklioji medziaga:<small> <?php echo $recepts['veiklioji_medziaga']; ?></small></h5>
            <h6>Kiekis vienoje dozeje: <?php echo $recepts['kiekis_vienoje_dozeje'].' '.$recepts['matavimo_vienetas']; ?></h6>
            <h6>Vaisto vartojimo aprasymas:</h6>
            <p class="card-text"><?php echo $recepts['vartojimo_aprasymas']; ?></p>
            <h6>Recepto panaudojimo daznis: <?php //echo $history['pakartojimas']; ?> 0 kartus</h6>
            <div class="row justify-content-end">
                <p style="margin-right: 15px;">Recepto israsymo data: <?php echo date('Y-m-d H:i',strtotime($recepts['recepto_israsymo_data'])); ?></p>
            </div>
            <div class="row justify-content-end">
                <p style="margin-right: 15px;">Receptas galioja iki: <?php if($recepts['recepto_galiojimas_iki'] != 0000-00-00) { echo date('Y-m-d',strtotime($recepts['recepto_galiojimas_iki']));} if($recepts['recepto_galiojimas_iki'] == 0000-00-00){ echo $recepts['neterminuotas']; } ?></p>
            </div>
            </div>
        </div>
            <?php } ?>
            <?php } else {?>
                <div class="alert alert-info" style="text-align: center;" role="alert">
                    <?php echo "Sis pacientas jusu israsytu receptu neturi." ?>
                </div>
            <?php } ?>   
        </div>
    </main>
</body>
</html>