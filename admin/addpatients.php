<?php

//establish a php session
session_start();

require_once("../connect.php");

// Check if the user is logged in
if (!isset($_SESSION["userid"]) || !isset($_SESSION["user"])) {
    // Redirect to the login page if the user is not logged in
    header("Location: ../login.html");
    exit;
}

// Get the user information from the session variables
$ID = $_SESSION["userid"];
$user = $_SESSION["user"];
$username = $_SESSION["user"];

$SSN = "";
$Name = "";
$Email = "";
$Phone = "";
$Address = "";
$DOB = "";
$Gender = "";
$Status = "";

$errorMessage = "";
$successMessage = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $SSN = $_POST["SSN"];
    $Name = $_POST["Patient_Name"];
    $Email = $_POST["Patient_Email"];
    $Phone = $_POST["Patient_Phone"];
    $Address = $_POST["Patient_Address"];
    $DOB = $_POST["Patient_DOB"];
    $Gender = $_POST["Patient_Gender"];
    $Status =$_POST["Patient_Status"];


    do {
        $sql = "
        INSERT INTO `patients`(`Patient_SSN`, `Patient_Name`,`Patient_Email`, `Patient_Phone`, `Patient_Address`, `Patient_DOB`, `Patient_Gender`, `Status`)
         VALUES('$SSN', '$Name', '$Email', '$Phone',  '$Address', '$DOB', '$Gender', '$Status')";
        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid Query: " . $conn->error;
            break;
        }
        
        $SSN = "";
        $Name = "";
        $Email = "";
        $Phone = "";
        $Address = "";
        $DOB = "";
        $Gender = "";
        $Status = "";

        $successMessage = "Pateint added successfully";
        header("Location: adminView.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPLATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <title>ADMIN --Add New Patient </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container my-5">
        <h2>New Patient</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">SSN</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="SSN" value="<?php echo $SSN; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Patient Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Patient_Name" value="<?php echo $Name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Patient Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Patient_Address" value="<?php echo $Address; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Patient Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Patient_Email" value="<?php echo $Email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Patient Phone</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="Patient_Phone" value="<?php echo $Phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Patient Gender</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Patient_Gender" value="<?php echo $Gender; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Patient DOB</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="Patient_DOB" value="<?php echo $DOB; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Patient_Status</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Patient_Status" value="<?php echo $Status; ?>">
                </div>
            </div>



            
            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/users/companytable.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
