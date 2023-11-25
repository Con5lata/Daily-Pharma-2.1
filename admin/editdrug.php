

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPLATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <title>Admin View - Add New Drug</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container my-5">
        <h2>New Drug</h2>

        <?php
    
       if (!isset($_SESSION["userid"]) || !isset($_SESSION["user"])) {
           header("Location: ../admin/editdrug.php");
           exit;
       }
       
       if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           // ... (your existing code for processing form submission)
       
           // Update the drug information in the database
           $sql = "
           UPDATE `drugs`
           SET
               `Drug_Name` = '$drug_name',
               `Drug_Description` = '$drug_desc',
               `Drug_Quantity` = '$drug_quantity',
               `Drug_Expiration_Date` = '$drug_expiry',
               `Drug_Manufacturing_Date` = '$drug_manuf',
               `Drug_Company` = '$drug_company'
           WHERE `Drug_ID` = $drug_id";
       
           $result = $conn->query($sql);
       
           if (!$result) {
               $errorMessage = "Invalid Query: " . $conn->error;
           }else {
            echo "
            <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                </div>
            </div>";
        }
        
               $successMessage = "Drug updated successfully";
               header("Location: managedrugs.php");
               exit;
           }
       
       ?>
       
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Drug Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Drug_Name" value="<?php echo $drug_name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Drug Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Drug_Description" value="<?php echo $drug_description; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Drug Quantity</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="Drug_Quantity" value="<?php echo $drug_company; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Drug Manufacturing Date</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="Drug_Manufacturing_Date" value="<?php echo $drug_price; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Drug Expiration Date</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="Drug_Expiration_Date" value="<?php echo $drug_formula; ?>">
                </div>
            </div>
                <input type="hidden" name="Drug_Company" value="<?php echo $ID ;?>">
        </div>
        <div class= "row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" href="managedrugs.php">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="managedrugs.php" role="button">Cancel</a>
                </div>
            </div>
    </form>
</body>
