<?php 

class Database {

    private $db_host,
            $db_user,
            $db_password,
            $db_name;



    public function connect() {

        static $con;

        $this->db_host = "localhost";
        $this->db_user = "root";
        $this->db_password = "";
        $this->db_name = "spc";
        
        try { 

            $dsn = 'mysql:host=' .$this->db_host. ';dbname=' .$this->db_name;
            //$pdo = new PDO($dsn, $this->db_user, $this->db_password);
            //echo "Connected!";
            //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if(!$con) {
                $con = new PDO($dsn, $this->db_user, $this->db_password);
            }

            //return $pdo;
            return $con;

        } catch(PDOException $e) {
            echo "Database connection ERROR: " .$e->getMessage();
        }
    } 
    
    

    public function getData($sql) {

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
            return $row;
        }
    }


    public function countData($sql) {

        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute();
        $rows = $stmt->rowCount($result);
        return $rows;
    }
    

    public function changePassword($password, $id, $current_password) {

        $stmt = $this->connect()->prepare("UPDATE prisijungimas SET password= '$password' WHERE id= '$id' AND password= '$current_password'");
        $stmt->execute();
        if($stmt->execute()) {
            return TRUE;
        } else {
            return false;
            die($this->connect());
        }
    }


    public function searchPatient($search) {

        $stmt = $this->connect()->prepare("SELECT * FROM pacientai WHERE vardas LIKE '%$search%' OR pavarde LIKE '%$search%' OR gimimo_data LIKE '%$search%' OR asmens_kodas LIKE '%$search%'");
        //$stmt = $this->connect()->prepare("SELECT * FROM pacientas_gydytojas WHERE vardas LIKE '%$search%' OR pavarde LIKE '%$search%' OR gimimo_data LIKE '%$search%' AND gydytojo_id= '$doc_id'");
        $stmt->execute();
        while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
            return $row;
        }
    }

}