<?php
//establish a php session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["userid"]) || !isset($_SESSION["user"])) {
    // Redirect to the login page if the user is not logged in
    header("Location: ../login.html");
    exit;
}

// Get the user information from the session variables
$username = $_SESSION["userid"];
$user = $_SESSION["user"];
$ID = $_SESSION["user"]["Pharmacy_ID"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPLATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <title> Pharmacy View - Add New Contract </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="PharmacyView">

    <header>
        <div class="logo">
            <a href="../index.html">DailyPharma</a>
        </div>

        <div class="navbar">
            <nav class= navbar id="navbar">
                <a href="../index.html">Home</a>
                <a href="#about">Features</a>
                <a href="#footer">Contact Us</a>
                <a href="../logout.php" class="btn-login-popup">Logout</a>    
            </nav>
    
            <?php
                echo '<div class="profile">';
                echo '<a href="../profile.html">';
                echo '<i class="uil uil-user"></i>' . $username . '';
                echo '</a>';
                echo '</div>';
            ?>
        </div>

        <i class="uil uil-bars navbar-toggle" onclick="toggleOverlay()"></i>

        <div id="menu" onclick="toggleOverlay()">
            <div id="menu-content">
                <a href="../index.html">Home</a>
                <a href="#about">Features</a>
                <a href="#footer">Contact Us</a>
                <a href="../profile.html">Profile</a><!--Place username here-->
                <a href="../logout.php">Logout</a>
            </div>
        </div>
    </header>

    <div class="container my-5">
        <h2>List of Companies</h2>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>       
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>                   
                </tr>
</thead>
<tbody>
    <?php

    require_once("../connect.php");

    $supervisorsResult = $conn->query("SELECT * FROM supervisors");
    $supervisors = array();
    while ($supervisorRow = $supervisorsResult->fetch_assoc()) {
        $supervisors[] = $supervisorRow;
    }

    $resultsPerPage = 5;
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($currentPage - 1) * $resultsPerPage;

    $countQuery = "SELECT COUNT(*) AS total FROM company";
    $countResult = $conn->query($countQuery);
    $countRow = $countResult->fetch_assoc();
    $totalResults = $countRow['total'];
    $totalPages = ceil($totalResults / $resultsPerPage);

    $sql = "SELECT * FROM company LIMIT $offset, $resultsPerPage";
    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query: " . $conn->error);
    }

    while ($row = $result->fetch_assoc()) {
        echo "
        <tr>
            <td>$row[Company_ID]</td>                
            <td>$row[Company_Name]</td>
            <td>$row[Company_Email]</td>
            <td>$row[Company_Phone]</td>
            <td>$row[Status]</td>
            <td>
                <form action='newContract.php' method='post'>
                    <input type='hidden' name='companyID' value='$row[Company_ID]'>
                    <input type='hidden' name='companyName' value='$row[Company_Name]'>
                    <input type='hidden' name='companyEmail' value='$row[Company_Email]'>
                    <input type='hidden' name='companyPhone' value='$row[Company_Phone]'>
                    <input type='hidden' name='status' value='$row[Status]'>
                    <div class='form-group'>
                        <select class='form-control' name='supervisorID' required>
                            <option value='' disabled selected>Select a Supervisor</option>";
                            foreach ($supervisors as $supervisor) {
                                echo "<option value='$supervisor[Supervisor_ID]'>$supervisor[Supervisor_Name]</option>";
                            }
        echo "
                        </select>
                    </div>
                    <button type='submit' class='btn btn-success btn-sm'>Form Contract</button>
                </form>
            </td>
        </tr>
        ";
    }
    ?>
</tbody>
        </table>

        <nav aria-label="Page navigation">
            <ul class="pagination">
            <?php
for ($i = 1; $i <= $totalPages; $i++) {
    $activeClass = ($i == $currentPage) ? 'active' : '';
    echo "<li class='page-item $activeClass'><a class='page-link' href='companyList.php?page=$i'>$i</a></li>";
}
?>

