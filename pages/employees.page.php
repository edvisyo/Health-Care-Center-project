<?php 
require_once "../classes/database.class.php";
$data = new Database();

$doctors = $data->getData("SELECT * FROM gydytojai");
$pharmacists = $data->getData("SELECT * FROM vaistininkai");

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
<?php include_once("../includes/navigation.inc.php"); ?>
</header>
<main>
    <div class="container">
    <?php //include_once "../views/login.view.php"; ?>
    <h3>Musu komanda</h3>
    Gydytojai:
        <?php 
            if(!empty($doctors)) {
                foreach($doctors as $doctor) {
                    echo $doctor['vardas'].' '.$doctor['pavarde'].' ';
                }
            } else {
                echo "Siuo metu darbuotoju neturime ;[";
            } 
            ?>
            <br>
    Vaistininkai:        
        <?php
            if(!empty($pharmacists)) {
                foreach($pharmacists as $pharmacist) {
                    echo $pharmacist['vardas'].' '.$pharmacist['pavarde'].' ';
                }
            } else {
                echo "Siuo metu darbuotoju neturime ;[";
            }
        ?>
    </div>
</main>
</body>
</html>