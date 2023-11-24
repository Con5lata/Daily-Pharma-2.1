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
$Phone = "";
$Specialty = "";
$Experience = "";
$Status = "";

$errorMessage = "";
$successMessage = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $SSN = $_POST["SSN"];
    $Name = $_POST["Doctor_Name"];
    $Phone = $_POST["Doctor_Phone"];
    $Specialty = $_POST["Doctor_Speciality"];
    $Experience = $_POST["Doctor_Experience"];
    $Status =$_POST["Doctor_Status"];


    do {
        $sql = "
        INSERT INTO `doctors`(`Doctor_SSN`,`Doctor_Name`, `Doctor_Phone`,`Doctor_Speciality`, `Doctor_Experience`, `Status`)
         VALUES('$SSN', '$Name', '$Phone',  '$Speciality', '$Experience', '$Status')";
        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid Query: " . $conn->error;
            break;
        }
        
        $SSN = "";
        $Name = "";
        $Phone = "";
        $Specialty = "";
        $Experience = "";
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
    <title>ADMIN --Add New Doctor </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container my-5">
        <h2>New Doctor</h2>

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
                <label class="col-sm-3 col-form-label">Doctor Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Doctor_Name" value="<?php echo $Name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Doctor Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Doctor_Phone" value="<?php echo $Phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Doctor Specialty</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Doctor_Specialty" value="<?php echo $Specialty; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Doctor Experience</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="Doctor_Experience" value="<?php echo $Experience; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Doctor Status</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Doctor_Status" value="<?php echo $Status; ?>">
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
                    <a class="btn btn-outline-primary" href="adminView.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
