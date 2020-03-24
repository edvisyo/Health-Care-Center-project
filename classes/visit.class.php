<?php

class Visit extends Database {

    public function getVisitInfo($sql) {

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = new Getvisit($row);
                if(!empty($data)) {
                    return $data;
                } else {
                    return false;
                }
            }
        }
    }
