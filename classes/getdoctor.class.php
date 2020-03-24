<?php 

class Getdoctor {

    private $id,
            $logged_in_id,
            $name,
            $lastname,
            $specialization,
            $other_specialization;

    public function __construct($dbRows) {

        $this->id = $dbRows['id'];
        $this->logged_in_id = $dbRows['prisijungimas_id'];
        $this->name = $dbRows['vardas'];
        $this->lastname = $dbRows['pavarde'];
        $this->specialization = $dbRows['specializacija'];
        $this->other_specialization = $dbRows['kita_specializacija'];
    }


    public function getId() {
        return $this->id;
    }

    public function getLoggedinId() {
        return $this->logged_in_id;
    }

    public function getName() {
        return $this->name;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getSpecialization() {
        return $this->specialization;
    }

    public function getOtherSpecialization() {
        return $this->other_specialization;
    }
}