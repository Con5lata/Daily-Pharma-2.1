<?php 

session_start();
require_once("connect.php");

$username = $_SESSION["userid"];
$user = $_SESSION["user"];
$ID = $_SESSION["user"]["Pharmacy_ID"];


//read the row of the selected client from the database table 
$sql = $conn->prepare("SELECT * FROM pharmacy WHERE `Pharmacy_ID` = ?");
$sql->bind_param("i", $ID);
$sql->execute();
$row = $sql->get_result()->fetch_assoc();

if (!$row) {
    header("location: pharmacyView.php");
    exit;
}


$ID = $row["Pharmacy_ID"];
$name = $row["Pharmacy_Name"];
$email = $row["Pharmacy_Email"];
$phone = $row["Pharmacy_Phone"];
$address = $row["Pharmacy_Address"];

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPLATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <title>USERS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<header>
        <div class="logo">
            <a href="../index.html">DailyPharma</a>
        </div>

        <div class="navbar">
            <nav class= navbar id="navbar">
                <a href="../index.html">Home</a>
                <a href="#about">Features</a>
                <a href="#footer">Contact Us</a>
                <a href="../logout.php" class="btn-login-popup" >Logout</a>                
            </nav>
        </div>

        <i class="uil uil-bars navbar-toggle" onclick="toggleOverlay()"></i>

        <div id="menu" onclick="toggleOverlay()">
            <div id="menu-content">
                <a href="../index.html">Home</a>
                <a href="#about">Features</a>
                <a href="#footer">Contact Us</a>
                <a href="../logout.php">Logout</a>
            </div>
        </div>
    </header>

    <div class= "container my-5">
        <h2>User Information</h2>
        <div class="item"></div>
        <form method ="post">
        <div class="row mb-3">
                <label class="col-sm-3 col-form label">ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Pharmacy_ID" value="<?php echo $ID?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Pharmacy_Name" value="<?php echo $name?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Pharmacy_Phone" value="<?php echo $phone?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Pharmacy_Email" value="<?php echo $email?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Pharmacy_Address" value="<?php echo $address?>" readonly >
                </div>
        </form>
    </div>
</body>