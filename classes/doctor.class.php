<?php 

class Doctor extends Database {

    public function getDocData($sql) {

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = new Getdoctor($row);
            if(!empty($data)) {
                return $data;
            } else {
                return false;
            }
        }
    }
}

