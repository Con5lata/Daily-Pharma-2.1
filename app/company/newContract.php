<?php
session_start();
require_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("../connect.php");

    // Get the selected companyID, pharmacyID, and supervisorID from the POST data
    $pharmacyID = $_POST["pharmacyID"];
    $companyID = $_SESSION["user"]["Company_ID"];
    $supervisorID = $_POST["supervisorID"];


    // Check if a supervisor was selected
    if (empty($supervisorID)) {
        echo "<script>alert('No Supervisor selected')
        window.location.href = 'pharmacyView.php';
        </script>";
    }

    $startDate = date("Y-m-d");
    $endDate = date("Y-m-d", strtotime("+6 months"));

    // Perform the insert query to create a new contract
    $insertQuery = "INSERT INTO contracts (Company_ID, Pharmacy_ID, Supervisor_ID, Start_Date, End_Date) 
                    VALUES ('$companyID', '$pharmacyID', '$supervisorID', '$startDate', '$endDate')";

    if ($conn->query($insertQuery) === TRUE) {
        echo "<script>alert('Contract Formation In Progress.')
        window.location.href = 'companyView.php';
        </script>";
    } else {
        // If there was an error in the insert query, you can handle it as per your requirement
        die("Error: " . $conn->error);
    }
}
?>
