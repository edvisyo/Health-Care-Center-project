<?php
require_once("classes/database.class.php");
require_once("classes/admin.class.php");

if(isset($_POST['submit'])) {

    $regist_patient = new Admin();
    $success_message = '';
    $default_role = 2;

    $role_id = $default_role;
    $email = $_POST['email'];
    $password = $_POST['password'];

    $regist_patient->insertData2($role_id, $email, $password);
    $id = $regist_patient->lastId();
    echo $id;

    // $data_array = array(
    //     'role_id' => $default_role,
    //     'email' => $_POST['email'],
    //     'password' => $_POST['password']
    // );

    // if($regist_patient->insertData('prisijungimas', $data_array)) {
    //     $success_message = "Uzregistruota!";
    // }

    // $id = $regist_patient->lastId();
    // echo $id;

    $data_array = array(
        'asmens_kodas' => $_POST['code'],
        'vardas' => $_POST['name'],
        'pavarde' => $_POST['lastname'],
        'gimimo_data' => $_POST['date'],
        'prisijungimas_id' => $id
    );

    // if($regist_patient->doubleInsert('prisijungimas', $data_array) && $regist_patient->doubleInsert('pacientai', $data_array2)) {
    //     $success_message = "Uzregistruota!";
    // }

    if($regist_patient->insertData('pacientai', $data_array)) {
            $success_message = "Uzregistruota!";
        }

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
    
    <form action="mvc.php" method="post">
    
            asmens kodas:
            <input type="text" name="code"><br>
            vardas:
            <input type="text" name="name"><br>
            pavarde:
            <input type="text" name="lastname"><br>
            gimimo data:
            <input type="date" name="date"><br>
            <br>
            <br>
            email:
            <input type="text" name="email"><br>
            password:
            <input type="password" name="password"><br>
            <input type="submit" value="ok" name="submit">
    </form>

</body>
</html>