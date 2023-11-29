<?php
$servername ="localhost";
$username ="root";
$password="";
$database="users";

//create connection 
$connection= new mysqli($servername, $username, $password, $database);

$name="";
$drug_name="";
$drug_price="";
$address="";
$phone ="";

$errorMessage = "";
$successMessage="";

if( $_SERVER['REQUEST_METHOD'] =='POST' ){

    $name = $_POST["name"];
    $drug_name = $_POST["drug_name"];
    $drug_price= $_POST["drug_price"];
    $address = $_POST["address"];
    $phone =$_POST["phone"];

    do{
        if ( empty($name) || empty($drug_name) || empty($drug_price) || empty($address) || empty($phone)){
            $errorMessage ="All the fieds are required";
            break;
        }
        //add new user to database 
        $sql = "INSERT INTO pharmacy (name, drug_name, drug_price, phone, address)" .
               "VALUES ('$name', '$drug_name', '$drug_price', '$phone', '$address')";
        $result = $connection->query($sql);
            
    if (!$result) {
        $errorMessage = "Invalid Query: " . $connection->error;
        break;
    }
        $name="";
        $drug_name="";
        $drug_price="";
        $address="";
        $phone ="";

        $successMessage = "User added succesfully";
        header("location: /users/pharmacyindex.php"); 
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
    <title>USERS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <div class= "container my-5">
        <h2>New Pharmacy</h2>

        <?php
        if( !empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismisible fade show' role='alert'>
                 <strong>$errorMessage <?strong>
                 <button type='button' class='btn-close' data-bs-dismiss='alert' aria -label='Close'></label>
                 </div>
                 ";
        }
        ?>
        <form method ="post">
        
            <div class="row mb-3">
                <label class="col-sm-3 col-form label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form label">Drug Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="drug_name" value="<?php echo $drug_name?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form label">Drug Price</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="drug_price" value="<?php echo $drug_price?>">
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone?>">
                </div>
            </div>



            <?php
            if (!empty($successMessage) ){
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismisible fade show' role='alert'>
                            <strong>$successMessage <?strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria -label='Close'></label>
                            </div>
                    </div>
                 </div>
                 ";
            }
            ?>
            <div class= "row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/users/pharmacyindex.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>