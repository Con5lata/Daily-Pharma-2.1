<?php

if (isset($_GET["ID"]) && isset($_GET["pharID"])) {
    $pharID = $_GET["pharID"];
    $ID = $_GET["ID"];

    require_once("connect.php");
    $sql = "SELECT * FROM drugs WHERE Drug_Company = '$pharID' AND Drug_ID = '$ID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $deleteQuery = "DELETE FROM drugs WHERE Drug_Company = '$pharID' AND Drug_ID = '$ID'";

        if ($conn->query($deleteQuery) === TRUE) {
            echo "<script>alert('Successful deletion of drug')
            window.location.href = 'companyView.php';
            </script>";
        } else {
            echo "<script>alert('Error in deletion of drug. Try Again')
            window.location.href = 'companyView.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Error occured during deletion. Please contact related company.')
            window.location.href = 'companyView.php';
            exit;
            </script>";
    }
} else {
    header("Location: companyView.php");
    exit;
}
?>
