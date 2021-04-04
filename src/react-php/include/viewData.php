<?php 



class View extends Subscription {

    
    public function validate($email) {
        $emailError = "";
        $isValid = true;
        $lastThreeChars = substr($email, -3);
        if(empty($email)) {
            $isValid = false;
            $emailError = "(BE) Email address is required";
        } else if ($lastThreeChars == ".co") {
            $isValid = false;
            $emailError = "(BE) We are not accepting subscriptions from Colombia emails";
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $isValid = false;
            $emailError = "(BE) Please provide a valid email address";
        } else {
            $emailError = "Valid email address";
        }
        $this->error = $emailError;
        return $isValid;
    }

    public function insertData($email) {
        if($this->validate($email)) {
            $this->postData($email);
        } else {
            echo $this->error;
        }   
    }

    public function deleteEmail($id) {
        $this->deleteData($id);
    }

    public function showEmails() {
        $datas = $this->getData();
        echo "<table id='email'>";
        
        foreach($datas as $data) {            
            $this->addEmailProviders($data[email]);
        }
        echo "</table>";
    }

    public function showProviders() {
        $providers = $this->getEmailProviders();
        foreach($providers as $provider) {
            echo "<button class='buttons' onClick=displaySortedEmails('$provider')>".$provider."</button>";
        }
        echo "<button class='buttons' onClick=displayAllEmails()>Reset</button>";
        echo "<button class='buttons' onClick=sortEmails()>Sort by name</button>";
    }

    // this function is pretty messy )
    public function showSortedData(){
        $subString = $_GET["title"];
        $datas = $this->getData();
        $sortedList = $this->sortEmails();

        echo "<table id='email'>";
        echo "<tr'>";
        echo "<th>ID</th>";
        echo "<th>Email Address</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        
        if ($subString == "sort") {
            foreach($sortedList as $data) {

                echo "<tr>";
                echo "<td>".$data[id]."</td>";
                echo "<td>".$data[email]."</td>";
                echo "<td><a href=index.php?delete=".$data[id].">Delete</a></td>";
                echo "</tr>";
                
            }
        } else if ($subString !== null) {
            foreach($datas as $data) {
                if($this->parseEmail($data[email]) == $subString) {

                    echo "<tr>";
                    echo "<td>".$data[id]."</td>";
                    echo "<td>".$data[email]."</td>";
                    echo "<td><a href=index.php?delete=".$data[id].">Delete</a></td>";
                    echo "</tr>";
                }
            } 
        } else {
            foreach($datas as $data) {
                echo "<tr>";
                echo "<td>".$data[id]."</td>";
                echo "<td>".$data[email]."</td>";
                $this->addEmailProviders($data[email]);
                echo "<td><a href=index.php?delete=".$data[id].">Delete</a></td>";
                echo "</tr>";
            }
        }
        echo "</table>";            
    }

}


?>