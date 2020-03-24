<?php

class Pagination extends Database {

    private $table,
            $name,
            $lastname,
            $birthdate,
            $totalRecords,
            $limit = 4;

    public function __construct($table, $name, $lastname, $birthdate) {
        $this->table = $table;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->birthdate = $birthdate;
        $this->set_total_records($name, $lastname, $birthdate);
    }        

    public function set_total_records($name, $lastname, $birthdate) {
        $sql  = "SELECT id FROM receptai WHERE pacientas_vardas= '$name' AND pacientas_pavarde= '$lastname' AND pacientas_gimimo_data= '$birthdate'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $this->totalRecords = $stmt->rowCount();
    }

    public function getRecords($name, $lastname, $birthdate) {
        $start = 0;
        if($this->currentPage() > 1) {
            $start = ($this->currentPage() * $this->limit) - $this->limit;
        }
        $query = "SELECT * FROM $this->table WHERE pacientas_vardas= '$name' AND pacientas_pavarde= '$lastname' AND pacientas_gimimo_data= '$birthdate'  ORDER BY recepto_israsymo_data DESC LIMIT $start, $this->limit";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function currentPage() {
        return isset($_GET['page']) ? (int)$_GET['page']:1;
    }

    public function getPageNumbers() {
        return ceil($this->totalRecords / $this->limit);
    }

    public function prevPage() {
        return ($this->currentPage() - 1);
    }

    public function nextPage($page) {
        return ($this->currentPage($page) + 1);
    }

    public function isActive($page) {
        return ($page == $this->currentPage($page)) ? 'active' : '';
    }
}
