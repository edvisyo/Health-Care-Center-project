<?php 
include_once "classes/database.class.php";
include_once "classes/admin.class.php";

$db = new Database();
$getArticles = $db->getData("SELECT pavadinimas, turinys, ikelimo_data FROM naujienu_srautas");

    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="CSS/style.css?v=<?php echo time(); ?>">
    <title>SPC</title>
</head>
<body>
<header>
<?php include_once("includes/navigation.inc.php"); ?>
</header>

<main>
<img src="Images/Šiuolaikinė-medicina-tai-religija-1092x667.jpg" alt="medicinos-paveikslelis"> 
    <div class="container"> 
        <?php include "views/login.view.php"; ?>

        <?php if(!empty($getArticles)) { ?>
            <?php foreach($getArticles as $article) { ?>
            <div class="row">
            <div style="margin-top: 35px;">
            <div class="col-6">
            <h3><?php echo $article['pavadinimas'].'</br>'; ?></h3>
            <p><?php echo $article['turinys'].'</br>'; ?></p>
            <small><?php echo date('Y-m-d',strtotime($article['ikelimo_data'])); ?></small>
            </div>
            </div>
            </div>
            <?php } ?>
        <?php } ?>
    </div> 
</main>
<footer>
        <?php include "includes/footer.inc.php"; ?>
</footer>

<script src="script/script.js?v=<?php echo time(); ?>"></script>       
</body>
</html>
