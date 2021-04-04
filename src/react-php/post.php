<?php 

header('Access-Control-Allow-Origin: http://localhost:3000');

include 'include/database.php';
include 'include/postData.php';
include 'include/viewData.php';

$userEmail = $_POST['email'];
$emails = new View();
$emails->insertData($userEmail);
    
?>