<?php 

class Login extends Database {

    public function LoginUser($email, $password) {

        try {

        $stmt = $this->connect()->prepare("SELECT * FROM prisijungimas WHERE email= :email AND password= :password");
        $stmt->execute(array('email' => $email, 'password' => $password));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0) {
            if($row['role_id'] == 1) {
                $_SESSION['username'] = $row['email'];
                $_SESSION['loggedInId'] = $row['id'];
                header("Location: pages/admin.page.php");
            } else if($row['role_id'] == 3) {
                $_SESSION['username'] = $row['email'];
                $_SESSION['loggedInId'] = $row['id'];
                header("Location: pages/doctor.page.php");
            } else if($row['role_id'] == 2) {
                $_SESSION['username'] = $row['email'];
                $_SESSION['loggedInId'] = $row['id'];
                header("Location: pages/patient.page.php");
            } else {
                if($row['role_id'] == 4) {
                    $_SESSION['username'] = $row['email'];
                    $_SESSION['loggedInId'] = $row['id'];
                    header("Location: pages/pharmacist.page.php");
                }
            }
            
        } return true;

        } catch(PDOException $e) {
            echo "User Login Failure: " .$e->getMessage();
            return false;
        }
    }
}