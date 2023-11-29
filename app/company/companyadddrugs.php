<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

$drug_name = "";
$drug_company = "";
$drug_formula = "";


$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $drug_name = $_POST["drug_name"];
    $drug_company = $_POST["drug_company"];
    $drug_formula = $_POST["drug_formula"];

    do {
        if (empty($drug_name) || empty($drug_company) || empty($drug_formula) ) {
            $errorMessage = "All fields are required";
            break;
        }
        // Add new drug to database
        $sql = "INSERT INTO drugs(Drug_Name, Drug_company, Drug_Formula)" .
            "VALUES ('$drug_name', '$drug_company', '$drug_formula')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid Query: " . $connection->error;
            break;
        }

        $drug_name = "";
        $drug_company = "";
        $drug_formula = "";
        $drug_price = "";

        $successMessage = "Drug added successfully";
        // Redirect to the drugs index page after successful addition
        header("Location: /users/companytable.php");
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
    <title>COMPANY'S DRUGS</title>
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
                    <input type="text" class="form-control" name="drug_name" value="<?php echo $drug_name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Drug Company</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="drug_company" value="<?php echo $drug_company; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Drug Formula</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="drug_formula" value="<?php echo $drug_formula; ?>">
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
