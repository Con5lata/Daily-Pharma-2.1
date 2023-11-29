<?php 
 if ( isset($_GET["name"]) ) {
    $name = $_GET["name"];

    $servername ="localhost";
    $username ="root";
    $password="";
    $database="users";
    
    //create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM pharmacy WHERE name = '$name' ";
    $connection->query($sql); 

}

header("location: pharmacyindex.php");
exit;
 ?>