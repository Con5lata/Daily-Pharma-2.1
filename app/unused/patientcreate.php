<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";

// Create connection 
$connection = new mysqli($servername, $username, $password, $database);

$SSN = "";
$Name = "";
$Email = "";
$Phone = "";
$Address = "";
$DOB = "";
$Physician = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $SSN = $_POST["SSN"];
    $Name = $_POST["Name"];
    $Email = $_POST["Email"];
    $Phone = $_POST["Phone"];
    $Address = $_POST["Address"];
    $DOB = $_POST["DOB"];
    $Physician = $_POST["Physician"];

    do {
        if (empty($SSN) || empty($Name) || empty($Email) || empty($Phone) || empty($Address) || empty($DOB) || empty($Physician)) {
            $errorMessage = "All fields are required";
            break;
        }
         // Calculate age based on date of birth
         $dobDateTime = new DateTime($DOB);
         $currentDateTime = new DateTime();
         $ageInterval = date_diff($dobDateTime, $currentDateTime);
         $age = $ageInterval->y;

        // Add new user to the database
        $sql = "INSERT INTO patients (Patient_SSN, Patient_Name, Patient_Email, Patient_Phone, Patient_Address, Patient_Ages, Patient_Physician) " .
            "VALUES ('$SSN', '$Name', '$Email', '$Phone', '$Address', '$DOB', '$Physician')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid Query: " . $connection->error;
            break;
        }

        $SSN = "";
        $Name = "";
        $Email = "";
        $Phone = "";
        $Address = "";
        $DOB = "";
        $Physician = "";

        $successMessage = "User added successfully";
        header("location: /users/patientindex.php");
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
    <title> PATIENTS </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Patient</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismisible fade show' role='alert'>
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
                    <input type="text" class="form-control" name="SSN" value="<?php echo $SSN ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Name" value="<?php echo $Name ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Email" value="<?php echo $Email ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Phone" value="<?php echo $Phone ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Address" value="<?php echo $Address ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">DOB</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="DOB" value="<?php echo $DOB ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Physician</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Physician" value="<?php echo $Physician ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismisible fade show' role='alert'>
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
                    <a class="btn btn-outline-primary" href="/users/patientindex.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
