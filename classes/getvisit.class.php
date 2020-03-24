<?php

class Getvisit {

    private $id,
            $name,
            $lastname,
            $birthdate,
            $doctor_id,
            $doctor_name,
            $doctor_lastname,
            $visit_date,
            $visit_time,
            $tlk_10,
            $visit_summary,
            $visit_comp,
            $visit_rep;

    public function __construct($dbRows) {

        $this->id = $dbRows['id'];
        $this->name = $dbRows['pacientas_vardas'];
        $this->lastname = $dbRows['pacientas_pavarde'];
        $this->birthdate = $dbRows['pacientas_gimimo_data'];

        $this->doctor_id = $dbRows['gydytojas_id'];
        $this->doctor_name = $dbRows['gydytojas_vardas'];
        $this->doctor_lastname = $dbRows['gydytojas_pavarde'];
        $this->visit_date = $dbRows['vizito_data'];
        $this->visit_time = $dbRows['vizito_trukme'];
        $this->tlk_10 = $dbRows['tlk_10'];
        $this->visit_summary = $dbRows['vizito_aprasymas'];
        $this->visit_comp = $dbRows['kompensacija'];
        $this->visit_rep = $dbRows['pakartojimas'];
    }


    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getBirthdate() {
        return $this->birthdate;
    }

    public function getDocId() {
        return $this->doctor_id;
    }

    public function getDocName() {
        return $this->doctor_name;
    }   
    
    public function getDocLastname() {
        return $this->doctor_lastname;
    }

    public function getVisitDate() {
        return $this->visit_date;
    }

    public function getVisitTime() {
        return $this->visit_time;
    }

    public function getTlk() {
        return $this->tlk_10;
    }

    public function getVisitSummary() {
        return $this->visit_summary;
    }

    public function getVisitComp() {
        return $this->visit_comp;
    }

    public function getVisitRep() {
        return $this->visit_rep;
    }
}    