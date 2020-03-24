<?php
include "classes/database.class.php";
$db = new Database();
$z = $db->getData("SELECT vardas, pavarde, gimimo_data, asmens_kodas FROM pacientai");

// require_once("test.class.php");

// $test = new Test();

// if(isset($_POST['submit'])) {

//     $two = 2;

//     $role_id = $two;
//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     $test->insertData2($role_id, $email, $password);
//     $id = $test->lastId();
//     echo $id;


//     $asmens_kodas = $_POST['code'];
//     $vardas = $_POST['name'];
//     $pavarde = $_POST['lastname'];
//     $gimimo_data = $_POST['date'];
//     $prisijungimas_id = $id;
    

//     $test->insertData($asmens_kodas, $vardas, $pavarde, $gimimo_data, $prisijungimas_id);

// }
if(isset($_POST['save'])) {
// $myfile = fopen("views/failas.txt", "w");
$myfile = fopen("failas.txt", "w");
// $txt = array(
//     'Vardas' => $_POST['name'],
//     'Pavarde' => $_POST['last'],
    
// );
$txt = $z;
fwrite($myfile, print_r($txt, TRUE));
//$txt = "World\n";
//fwrite($myfile, $txt);
fclose($myfile);
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
    
    <!-- <form action="test.php" method="post">
    
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
    </form> -->

    <form action="test.php" method="POST">
    <input type="text" name="name">
    <input type="text" name="last">
        <button name="save">save</button>
    </form>

</body>
</html>