<?php
require_once("../classes/database.class.php");
session_start();

$data = new Database();
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
<h4>Vaistininko puslapis</h4>
        <form action="pharmacist.page.php" method="GET" class="" style="">
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
                <a href="patient.recepts.page.php?recept=<?php echo $result['id']; ?>"><?php echo $result['vardas'].' '. $result['pavarde'].' '.$result['gimimo_data'].'<br>'; ?></a>
            <?php } ?>
            <?php } else { ?>
        <?php echo "Pagal jūsų užklausą '$search' duomenų nerasta"; ?>
        <hr>
        <?php } ?>
    <?php } ?>
    <a href="../views/changepassword.view.php">Keisiti prisijungimo slaptazodi</a>
</div>
</main>
</body>
</html>

        
