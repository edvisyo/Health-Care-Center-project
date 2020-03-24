<?php 

class Admin extends Database {


    public function getData($table) {

        try {

            $stmt = $this->connect()->prepare("SELECT * FROM .$table");
            $stmt->execute();
            while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                return $row;
            }    

        } catch(PDOException $e) {
            return "Data selecting ERROR: " .$e->getMessage();
        }
    }


    public function insertData($table, $values) {

        try {

            $string = "INSERT INTO ".$table."(";
            $string .= implode(",", array_keys($values)) . ') VALUES (';
            $string .= "'" . implode("','", array_values($values)) . "')";
            //return $string;
            $result = $this->connect()->query($string);

        } catch(PDOException $e) {
            return "Data inserting Error: " .$e->getMessage();
        }

    }


    public function insertData2($table, $role_id, $email, $password) {

        $sql = "INSERT INTO $table (role_id, email, password)VALUES(:role_id, :email, :password)";
        $result = $this->connect()->prepare($sql);
        $result->execute(array(':role_id' => $role_id, ':email' => $email, ':password' => $password));

        if($result) {
            return TRUE;
        } else {
            return false;
        }
    }


    // public function insertData2($table, $values) {

    //     try {

    //         $string = "INSERT INTO ".$table."(";
    //         $string .= implode(",", array_keys($values)) . ') VALUES (';
    //         $string .= "'" . implode("','", array_values($values)) . "')";
    //         //return $string;
    //         $result = $this->connect()->query($string);

    //     } catch(PDOException $e) {
    //         return "Data inserting Error: " .$e->getMessage();
    //     }

    // }


    // public function doubleInsert($table, $values) {

    //     try {

    //         $string = "INSERT INTO ".$table."(";
    //         $string .= implode(",", array_keys($values)) . ') VALUES (';
    //         $string .= "'" . implode("','", array_values($values)) . "')";
    //         $string2 = "INSERT INTO ".$table."(";
    //         $string2 .= implode(",", array_keys($values)) . ') VALUES (';
    //         $string2 .= "'" . implode("','", array_values($values)) . "')";
    //         //return $string;
    //         $result = $this->connect()->prepare($string && $string2);
    //         $result->execute(array($string && $string2));

    //     } catch(PDOException $e) {
    //         return "Data inserting Error: " .$e->getMessage();
    //     }

    // }


    public function lastId() {
            return $this->connect()->lastInsertId();
        }


}
