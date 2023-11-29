<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

$drugName = "";
$drugCompany = "";
$drugFormula = "";
$drugPrice = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $drugName = $_POST["drugName"];
    $drugCompany = $_POST["drugCompany"];
    $drugFormula = $_POST["drugFormula"];
    $drugPrice = $_POST["drugPrice"];

    do {
        if (empty($drugName) || empty($drugCompany) || empty($drugFormula) || empty($drugPrice)) {
            $errorMessage = "All fields are required";
            break;
        }

        // Add new drug to the database
        $sql = "INSERT INTO drugs (Drug_Name, Drug_Company, Drug_Formula, Drug_Price) " .
               "VALUES ('$drugName', '$drugCompany', '$drugFormula', '$drugPrice')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid Query: " . $connection->error;
            break;
        }

        $drugName = "";
        $drugCompany = "";
        $drugFormula = "";
        $drugPrice = "";

        $successMessage = "Drug added successfully";
        header("location: /users/drug_table.php");
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
    <title> DRUGS </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Drug</h2>

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
                <label class="col-sm-3 col-form-label">Drug Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="drugName" value="<?php echo $drugName; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Drug Company</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="drugCompany" value="<?php echo $drugCompany; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Drug Formula</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="drugFormula" value="<?php echo $drugFormula; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Drug Price</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="drugPrice" value="<?php echo $drugPrice; ?>">
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
                </div>
                    <button type="submit" class="btn btn-primary"href="/users/drugs_table.php" role="button">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/users/drugs_table.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
