<?php
include_once "../classes/database.class.php";
include_once "../classes/admin.class.php";
session_start();

$loggedInDocId = $_SESSION['loggedInId'];
$patientId = $_GET['patient'];

$data = new Database();
$sessionDoc = $data->getData("SELECT id, vardas, pavarde FROM gydytojai WHERE prisijungimas_id = '$loggedInDocId'");

if(!empty($sessionDoc)) {
    foreach($sessionDoc as $currentDoc) {
        $docId = $currentDoc['id'];
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

$patientHistory = $data->getData("SELECT * FROM vizitai WHERE pacientas_vardas = '$name' AND pacientas_pavarde = '$lastname' AND pacientas_gimimo_data = '$birthdate' AND gydytojas_id = '$docId' ORDER BY vizito_data DESC");

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
        <h4 style="margin-bottom: 25px;">Paciento <?php echo "'".$name.' '.$lastname."'"; ?> ligu istorijos:</h4>
        <?php if(!empty($patientHistory)) { ?>
            <?php foreach($patientHistory as $history) { ?>
        <div class="card" style="margin-bottom: 30px;">
            <div class="card-body">
            <h5>Paciento gimimo data: <?php echo $history['pacientas_gimimo_data']; ?></h5>
            <h5 class="card-title">Ligos kodas:<small> <?php echo $history['tlk_10']; ?></small></h5>
            <h6>Ligos aprasymas:</h6>
            <p class="card-text"><?php echo $history['vizito_aprasymas']; ?></p>
            <h6>Ligoniu kasos kompensacija: <?php echo $history['kompensacija']; ?></h6>
            <h6>Vizitas pakartotinis: <?php echo $history['pakartojimas']; ?></h6>
            <div class="row justify-content-end">
                <p style="margin-right: 15px;">Apsilankymo data: <?php echo date('Y-m-d H:i',strtotime($history['vizito_data'])); ?></p>
            </div>
            </div>
        </div>
            <?php } ?>
        <?php } ?>
        </div>
    </main>
</body>
</html>