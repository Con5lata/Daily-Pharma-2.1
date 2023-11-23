<?php
// pharmacyView.php
include "../inc/view_header.php"
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../style.css">
    <title> DailyPharma - Pharmacy Home</title>
</head>
<body class="PharmacyView">

    <!--Header-->
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

            <?php
                echo '<div class="profile">';
                echo '<a href="profile.php">';
                echo '<i class="uil uil-user"></i>' . $username . '';
                echo '</a>';
                echo ' </div>';
            ?>
        
        </div>


        <i class="uil uil-bars navbar-toggle" onclick="toggleOverlay()"></i>

        <div id="menu" onclick="toggleOverlay()">
            <div id="menu-content">
                <a href="../index.html">Home</a>
                <a href="#about">Features</a>
                <a href="#footer">Contact Us</a>
                <a href="profile.php">Profile</a><!--Place username here-->
                <a href="../logout.php">Logout</a>
            </div>
        </div>
    </header>

    
    <!-- Drugs -->
    <div class="item">
        <div class="title-text">
            <p>Features</p>
            <h1>What do you need?</h1>
        </div>

    </div>

    <div class="drug_section">
        <div class="sidebar">
            <ul class="category-list">
                <li class="category-item active"><a href="hallucinogen.php" data-category="Hallucinogens">HALLUCINOGENS</li>
                <li class="category-item active"><a href="Anaesthetics.php" data-category="Anaesthetics">ANAESTHETICS</li>
                <li class="category-item active"><a href="#Narcotic-Analgesics" data-category="Narcotic-Analgesics">NARCOTIC ANALGESICS</li>
                <li class="category-item active"><a href="#Stimulants" data-category="stimulants">STIMULANTS </li>
                <li class="category-item active"><a href="#Depresants" data-category="Depresants">DEPRESANTS</li>
                <li class="category-item active"><A href="#Inhalants" data-category="Inhalants">INHALANTS</li>

            </ul>
        </div>

        <div class="main_content">

            <div class="category-content" id="Hallucinogens">
                <div class="container my-5">
                    <h2>Hallucinogens Offered</h2>            
                    
                </div>
            </div>   
        </div>
    </div>
</body>
   