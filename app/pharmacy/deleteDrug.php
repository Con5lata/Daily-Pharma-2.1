<?php

if (isset($_GET["ID"]) && isset($_GET["pharID"])) {
    $pharID = $_GET["pharID"];
    $ID = $_GET["ID"];

    require_once("connect.php");
    $sql = "SELECT * FROM drug_prices WHERE Pharmacy_ID = '$pharID' AND Drug_ID = '$ID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $deleteQuery = "DELETE FROM drug_prices WHERE Pharmacy_ID = '$pharID' AND Drug_ID = '$ID'";

        if ($conn->query($deleteQuery) === TRUE) {
            echo "<script>alert('Successful deletion of drug')
            window.location.href = 'pharmacyView.php';
            </script>";
        } else {
            echo "<script>alert('Error in deletion of drug. Try Again')
            window.location.href = 'pharmacyView.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Error occured during deletion. Please contact related company.')
            window.location.href = 'pharmacyView.php';
            exit;
            </script>";
    }
} else {
    header("Location: pharmacyView.php");
    exit;
}
?>
