<?php 
require_once("../classes/database.class.php");
//require_once("../classes/db.class.php");
require_once("../classes/admin.class.php");

$getData = new Admin();
$allDoctors = $getData->getData('gydytojai');
$allPharmacists = $getData->getData('vaistininkai');

if(isset($_POST['assign'])) {

    $insert = new Admin();
    //$database = new DB();
    $insert_array = array(
        'vardas' => $_POST['name'],
        'pavarde' => $_POST['lastname'],
        'gimimo_data' => $_POST['birth_date'],
        'gydytojo_id' => $_POST['doctor_name'],
        //'vaistininko_id' => $_POST['pharmacist_name']
    );

    //$insert->insertData('paciento_registracija', $values);

    // foreach($values as $data => $value) {
    //     $dat[] = $data;
    //     $val[] = "'".$value."'";
    // }

    // $dat = implode(",", $dat);
    // $val = implode(",", $val);
    // echo $dat.'<br>';
    // echo $val;


   $insert->insertData("pacientas_gydytojas", $insert_array);
   //echo $database->insertData("paciento_registracija", $insert_array);
}


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
    <div id="assignToForm">
    <h4>Priskirti pacienta gydytojui</h4>
<div class="row justify-content-center">
<div style="width: 55rem;">
    <button type="button" style="margin-right: 20px" onclick="closeAssignForm()" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
  <div class="card-body">
    <form action="admin.page.php" method="POST">
        <div class="form-group">
            <label for="exampleFormControlInput1"><span>*</span>Vardas</label>
            <input type="text" name="name" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput2"><span>*</span>Pavarde</label>
            <input type="text" name="lastname" class="form-control" id="exampleFormControlInput2">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput2"><span>*</span>Gimimo data:</label>
            <input type="date" name="birth_date" class="form-control" id="exampleFormControlInput2">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2"><span>*</span>Gydytojas:</label>
            <select class="form-control" name="doctor_name" id="exampleFormControlSelect2">
                <option value=""></option>
                <?php if($allDoctors) { ?>
                    <?php foreach($allDoctors as $oneDoc) { ?>
                    <option value="<?php echo $oneDoc['id']; ?>"><?php echo $oneDoc['vardas'],' '. $oneDoc['pavarde'],' - '. $oneDoc['specializacija'], $oneDoc['kita_specializacija']; ?></option>
                    <?php } ?>
                <?php } ?>    
            </select>
        </div>
        <!-- <div class="form-group">
            <label for="exampleFormControlSelect3"><span>*</span>Vaistininkas:</label>
            <select class="form-control" name="pharmacist_name" id="exampleFormControlSelect3">
                <option value=""></option> -->
                <?php //if($allPharmacists) { ?>
                    <?php //foreach($allPharmacists as $onePharm) { ?>
                    <!-- <option value="<?php //echo $onePharm['id']; ?>"><?php //echo $onePharm['vardas'],' '. $onePharm['pavarde'],' - '. $onePharm['darbovietes_pavadinimas']; ?></option> -->
                    <?php //} ?>
                <?php //} ?>    
            <!-- </select>
        </div> -->
        <button type="submit" name="assign" class="btn btn-success">Registruoti</button>
    </form>
  </div>
</div>
</div>
</div>    
</body>
</html>