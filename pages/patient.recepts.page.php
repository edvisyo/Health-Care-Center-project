<?php
require_once("../classes/database.class.php");
require_once("../classes/admin.class.php");
session_start();
date_default_timezone_set("Europe/Vilnius");
$date = date("Y-m-d H:i");

$pharm_id = $_SESSION['loggedInId'];

$id = $_GET['recept'];

$data = new Database();
$patients = $data->getData("SELECT * FROM pacientai WHERE id= '$id'");
if($patients) {
    foreach($patients as $patient) {
        $name = $patient['vardas'];
        $lastname = $patient['pavarde'];
        $birthdate = $patient['gimimo_data'];
    }
}
$without_termin = 'Neterminuotas';

$recepts = $data->getData("SELECT * FROM receptai WHERE pacientas_vardas= '$name' AND pacientas_pavarde= '$lastname' AND pacientas_gimimo_data= '$birthdate' AND recepto_galiojimas_iki > '$date'");
//$recepts = $data->getData("SELECT * FROM receptai WHERE pacientas_vardas= '$name' AND pacientas_pavarde= '$lastname' AND pacientas_gimimo_data= '$birthdate' AND recepto_galiojimas_iki > '$date' OR neterminuotas = '$without_termin'");

$current_pharm = $data->getData("SELECT id, vardas, pavarde FROM vaistininkai WHERE prisijungimas_id= '$pharm_id'");

if(isset($_POST['buy'])) {
    
    $insert_data = new Admin();
    $message = "";
    
    $data_array = array(
        'vaistininkas_id' => $_POST['pharm_id'],
        'receptas_id' => $_POST['recept_id'],
        'pacientas_vardas' => $_POST['name'],
        'pacientas_pavarde' => $_POST['lastname'],
        'pacientas_gimimo_data' => $_POST['birthdate'],
        'vaistininkas_vardas' => $_POST['pharm_name'],
        'vaistininkas_pavarde' => $_POST['pharm_lastname']
    );

    if($insert_data->insertData('vaistu_pirkimas', $data_array)) {
        $message = TRUE;
    }
}

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
    <a href="pharmacist.page.php">Grizti</a>
    <br>
    <br>
        <h5>Paciento <?php echo "'".'<span style="color: green; border-bottom: 1px solid black">'.$name.' '.$lastname.'</span>'."'" ?> galiojanciu receptu rezultatai:</h5>
        <?php if(isset($message)) { ?>
            <div class="alert alert-success" role="alert" style="text-align: center">
                <?php echo "Vaisto pirkimo faktas pazymetas"; ?>
            </div>
        <?php } ?>
        <?php if($recepts) { ?>
            <?php foreach($recepts as $recept) { ?>
        <form action="patient.recepts.page.php?recept=<?php echo $id; ?>" method="POST">
        <div class="card" style="margin-bottom: 35px">
            <div class="card-header">
                Paciento vardas, pavarde: <?php echo $recept['pacientas_vardas'].' '.$recept['pacientas_pavarde']; ?>
                <input type="hidden" name="recept_id" value="<?php echo $recept['id']; ?>">
                <input type="hidden" name="name" value="<?php echo $recept['pacientas_vardas']; ?>">
                <input type="hidden" name="lastname" value="<?php echo $recept['pacientas_pavarde']; ?>">
                <input type="hidden" name="birthdate" value="<?php echo $recept['pacientas_gimimo_data']; ?>">
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Vaisto veiklioji medizaga:</th>
                    <th scope="col">Kiekis vienoje dozeje:</th>
                    <th scope="col">Matavimo vienetas:</th>
                    <th scope="col">Receptas galioja iki:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td><?php echo $recept['veiklioji_medziaga']; ?></td>
                    <td><?php echo $recept['kiekis_vienoje_dozeje']; ?></td>
                    <td><?php echo $recept['matavimo_vienetas']; ?></td>
                    <td><?php echo $recept['recepto_galiojimas_iki'].'d.'; ?></td>
                    </tr>
                </tbody>
                </table>
                <?php if($current_pharm) { ?>
                       <?php foreach($current_pharm as $pharm) { ?>
                        <input type="hidden" name="pharm_id" value="<?php echo $pharm['id']; ?>">
                        <input type="hidden" name="pharm_name" value="<?php echo $pharm['vardas']; ?>">
                        <input type="hidden" name="pharm_lastname" value="<?php echo $pharm['pavarde']; ?>">
                       <?php } ?>
                   <?php } ?>
                <p style="text-align: right">Gydytojas: <?php echo $recept['gydytojas_vardas'].' '.$recept['gydytojas_pavarde']; ?></p>
                <button type="submit" name="buy" class="btn btn-primary">Zymeti pirkimo fakta</button>
            </div>
        </div>
        <hr>
        </form>
        <?php 
                }
            } else {
                echo "Pacientas galiojanciu receptu siuo metu neturi.";
            }
        ?>
    </div>
</main>
</body>
</html>