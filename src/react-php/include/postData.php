<?php 


class Subscription extends Database {

    private $error;
    private $arrayOfProviders = array();
    

    protected function postData($userEmail) {
        
        $query = "INSERT INTO subscriptions (email) VALUES ('$userEmail')";
        if($this->connectToDb()->query($query)) {
            echo true;
        } else {
            echo "Connection Error";
        }
        
    }

    protected function parseEmail($emailAddress) {
        $lastAtPos = strripos($emailAddress, "@");
        $lastDotPos = strripos($emailAddress, ".");
        $parsed = substr($emailAddress , $lastAtPos+1, $lastDotPos - $lastAtPos-1);
        return $parsed;
    }

    protected function addEmailProviders($emailAddress) {
        
        $provider = $this->parseEmail($emailAddress);
        if(!in_array($provider, $this->arrayOfProviders)) {
            $this->arrayOfProviders[] = $provider;
            //echo "Added".PHP_EOL;
            
        } 
        //echo $provider;
        //return $this->arrayOfProviders[0];
    }

    protected function getEmailProviders() {
        return $this->arrayOfProviders;
    }

    protected function deleteData($id) {
        $query = "DELETE FROM subscriptions WHERE id='$id'";
        $sql = $this->connectToDb()->query($query);
        if($sql == true) {
            header("Location: index.php?msg3=delete");
        } else {
            echo "Record doesn't delete";
        }
    }

    protected function getData() {
        $sql = "SELECT * FROM subscriptions";
        $result = $this->connectToDb()->query($sql);
        $numRows = $result->num_rows;

        if($numRows > 0) {
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }

    protected function sortEmails() {
        $sql = "SELECT * FROM subscriptions ORDER BY email ASC";
        $result = $this->connectToDb()->query($sql);
        
        $numRows = $result->num_rows;
        if($numRows > 0) {
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }
}

?>

