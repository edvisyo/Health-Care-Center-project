<?php

class Test {

    
    private $localhost,
            $dbname,
            $dbuser,
            $dbpass;

    public function connect() {
        static $db;

        $this->localhost = "localhost";
        $this->dbname = "spc";
        $this->dbuser = "root";
        $this->dbpass = "";

        $dsn = 'mysql:host='.$this->localhost. ';dbname='.$this->dbname;
        
        if(!$db) {
            $db = new PDO($dsn, $this->dbuser, $this->dbpass);
            echo "Connected";
        }
        return $db;
    }


    // public function insertData($role_id, $email, $password, $asmens_kodas, $vardas, $pavarde, $gimimo_data, $prisijungimas_id) {

    //     $sql = "INSERT INTO prisijungimas (role_id, email, password)VALUES(:role_id, :email, :password)";
    //     $result = $this->connect()->prepare($sql2);
    //     $sql->bindParam('role_id', $role_id);
    //     $sql->bindParam('email', $email);
    //     $sql->bindParam('password', $password);
    //     $sql2 = "INSERT INTO pacientai (asmens_kodas, vardas, pavarde, gimimo_data, prisijungimas_id)VALUES(:asmens_kodas, :vardas, :pavarde, :gimimo_data, :prisijungimas_id)";
    //     $result2 = $this->connect()->prepare($sql);
    //     $sql2->bindParam('asmens_kodas', $asmens_kodas);
    //     $sql2->bindParam('vardas', $vardas);
    //     $sql2->bindParam('pavarde', $pavarde);
    //     $sql2->bindParam('gimimo_data', $gimimo_data);
    //     $sql2->bindParam('prisijungimas_id', $prisijungimas_id);
    //     //$result->execute(array(':role_id' => $role_id, ':email' => $email, ':password' => $password));

    //     if($result->execute() AND $result2->execute()) {
    //         echo "OK";
    //         return TRUE;
    //     } else {
    //         echo "PROBLEMS";
    //         return false;
    //     }
    // }


    public function insertData($asmens_kodas, $vardas, $pavarde, $gimimo_data, $prisijungimas_id) {

        $sql = "INSERT INTO pacientai (asmens_kodas, vardas, pavarde, gimimo_data, prisijungimas_id)VALUES(:asmens_kodas, :vardas, :pavarde, :gimimo_data, :prisijungimas_id)";
        $result = $this->connect()->prepare($sql);
        $result->execute(array(':asmens_kodas' => $asmens_kodas, ':vardas' => $vardas, ':pavarde' => $pavarde, ':gimimo_data' => $gimimo_data, ':prisijungimas_id' => $prisijungimas_id));

        if($result) {
            return TRUE;
        } else {
            return false;
        }
    }


    public function insertData2($role_id, $email, $password) {

        $sql = "INSERT INTO prisijungimas (role_id, email, password)VALUES(:role_id, :email, :password)";
        $result = $this->connect()->prepare($sql);
        $result->execute(array(':role_id' => $role_id, ':email' => $email, ':password' => $password));

        if($result) {
            return TRUE;
        } else {
            return false;
        }
    }


    public function lastId() {
        return $this->connect()->lastInsertId();
    }
}