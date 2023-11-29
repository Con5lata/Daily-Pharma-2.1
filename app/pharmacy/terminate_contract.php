<?php
require_once("connect.php");

if (isset($_GET["contractID"]) && isset($_GET["email"])) {
    $contractID = $_GET["contractID"];
    $supervisorEmail = $_GET["email"];

    $result = $conn->query(
        "UPDATE contracts SET Status = 'Pending' WHERE Contract_ID = '$contractID'"
    );

    if ($result === TRUE) {
        echo "<script>
            alert('Contract termination is underway. Please contact your supervisor via $supervisorEmail for further information.')
            window.location.href = 'pharmacyView.php';
            exit;
            </script>";
    } else {
        // Handle the case when the update fails (you can add appropriate error handling)
        echo "Error terminating the contract.";
    }
}
?>
