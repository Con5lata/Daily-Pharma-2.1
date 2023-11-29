<?php 
 if ( isset($_GET["id"]) ) {
    $id = $_GET["id"];

    $servername ="localhost";
    $username ="root";
    $password="";
    $database="users";
    
    //create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM doctors WHERE id=$id";
    $connection->query($sql); 

}

header("location: doctorsindex.php");
exit;
 ?>