<?php 

class DB {

    private $con;


    public function __construct() {

        $this->con = mysqli_connect("localhost", "root", "", "sveikatos_prieziuros_centras");
        if(!$this->con) {
            echo "Connection Error: ".mysqli_connect_error($this->con);
        }
    }


    public function insertData($table, $values) {

        $string = "INSERT INTO ".$table."(";
        $string .= implode(",", array_keys($values)) . ') VALUES (';
        $string .= "'" . implode("','", array_values($values)) . "')";
        //return $string;
        if(mysqli_query($this->con, $string)) {
            return TRUE;
        } else {
            echo mysqli_error($this->con);
        }

    }
}