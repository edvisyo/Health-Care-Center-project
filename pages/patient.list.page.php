<?php
require_once("../classes/database.class.php");
session_start();

$id = $_SESSION['loggedInId'];

$data = new Database();
$current_session_doc = $data->getData("SELECT id FROM gydytojai WHERE prisijungimas_id= '$id'");
if($current_session_doc) {
    foreach($current_session_doc as $doctor) {
        $doc_id = $doctor['id'];
    }
}
$patient_list = $data->getData("SELECT * FROM pacientas_gydytojas WHERE gydytojo_id= '$doc_id'");

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
        <h4>Pacientu saraso puslapis</h4>
        <form action="patient.list.page.php" method="GET" class="" style="">
        <div class="row justify-content-between">
        <input class="form-control mr-sm-2" type="search" name="search_input" style="width: 90%" placeholder="Ieskoti paciento" aria-label="Search" required>
        <button style="" class="btn btn-outline-success my-2 my-sm-0" name="search" type="submit">Search</button>
        </div>
    </form>
        <br>
    <?php 
            if(isset($_GET['search'])) {

                $search = $_GET['search_input'];
                $found = $data->searchPatient($search);
             
                $results = null;
                if($found > 0) {
                    $results = $found;
                } ?>
        <?php if($results) { ?>
            <h5>Rezultatai rasti pagal jusu uzklausa: <?php echo "'". $search ."'"; ?></h5>
            <?php  foreach($results as $result) { ?>
                <a href="search-results.php?result=<?php echo $result['id']; ?>"><?php echo $result['vardas'].' '. $result['pavarde'].' '.$result['gimimo_data'].'<br>'; ?></a>
            <?php } ?>
            <?php } else { ?>
        <?php echo "Pagal jūsų užklausą '$search' duomenų nerasta"; ?>
        <hr>
        <?php } ?>
    <?php } ?>
        <br>
        <strong><p>Visų jūsų pacientų sąrašas:</p></strong>
        <?php 
            if($patient_list) {
                foreach($patient_list as $patients) { ?>
                <ol>
                    <li><a href="search-results.php?result=<?php echo $patients['id']; ?>"><?php echo $patients['vardas'].' '.$patients['pavarde'].' '.$patients['gimimo_data']; ?></a></li>
                </ol>
        <?php   }
            } else {
                echo "Nera jums priskirtu pacientu.";
            }
        ?>
    </div>
</body>
</html>