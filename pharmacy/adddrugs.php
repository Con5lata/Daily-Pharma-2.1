<?php
include "../inc/view_header.php";
include "../inc/session_header.php";


$error = '';

$drug_description ='';
$drug_image = '';
$drug_name = '';
$drug_price = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $drug_name = $_POST["drug_name"];
   

    if (empty($drug_name)) {
        $error = "All fields are required";
    }

    if (empty($error)) {
        // Check if the drug already exists
        $checkQuery = "SELECT * FROM drugs WHERE Drug_Name = '$drug_name'";
        $result = $conn->query($checkQuery);

        if ($result->num_rows > 0) {
            echo "<script>alert('This drug already exists in your list.')</script>";
        } else {
            // Insert the new drug
            $insertQuery = "INSERT INTO drugs (Drug_Name, Drug_Description, Drug_Image) VALUES ('$drug_name','$drug_description', '$drug_image')";
            if ($conn->query($insertQuery) === TRUE) {
                echo "<script>alert('Drug added successfully'); window.location.href = 'pharmacyView.php';</script>";
            } else {
                $error = "Error in drug addition: " . $conn->error;
            }
        }
    }
}

if (!empty($error)) {
    echo "<script>alert('$error'); window.location.href = 'adddrugs.php';</script>";
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPLATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <title>Available Drugs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="C:\xampp\htdocs\Internet-Application-\inc\style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <style>
body{background: linear-gradient(#019587, #fff);}    
    </style>
    
    <div class="container my-5">
        <h2 style="margin-bottom: 20px;">New Drug</h2>

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
                <label class="col-sm-3 col-form-label">Drug Category</label>
                <div class="col-sm-6">
                    <select name="drug_description" class="form-control" required>
                        <?php
                        // Fetch drug descriptions from the drugs table
                        $sql = "SELECT DISTINCT `Drug_Description` FROM drugs";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row["Drug_Description"] . '">' . $row["Drug_Description"] . '</option>';
                            }
                        } else {
                            echo '<option value="">No drug descriptions found</option>';
                        }
                        $result->close();
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Drug Image</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control" name="drug_image" accept="image/*">
                </div>
                <div class="col-sm-3">
                    <img id="chosenImage" src="#" alt="Chosen Image" style="max-height: 100px; display: none;">
                </div>
                <script>
                    document.querySelector('input[name="drug_image"]').addEventListener('change', function(event) {
                        const chosenImage = document.getElementById('chosenImage');
                        const file = event.target.files[0];

                        if (file) {
                            const reader = new FileReader();

                            reader.onload = function(e) {
                                chosenImage.src = e.target.result;
                                chosenImage.style.display = 'block';
                            }

                            reader.readAsDataURL(file);
                        } else {
                            chosenImage.src = '#';
                            chosenImage.style.display = 'none';
                        }
                    });
                </script>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Drug Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="Drug_Name" name="drug_name" required>
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
                    <a class="btn btn-outline-primary" href="pharmacyView.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>
