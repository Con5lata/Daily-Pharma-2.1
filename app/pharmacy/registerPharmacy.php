<?php

// Establish a PHP session (if needed)
session_start();

// Establish a connection to the database
require_once("../connect.php");

// Initialize the error message
$error = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
         // Sanitize and retrieve form data
    $pharmacyName = trim($_POST['Pharmacy_Name']);
    $pharmacyAddress = trim($_POST['Pharmacy_Address']);
    $pharmacyEmail = trim($_POST['Pharmacy_Email']);
    $pharmacyPhone = trim($_POST['Pharmacy_Phone']);
    $password = trim($_POST['Password']);
    $confirmPassword = trim($_POST['Confirm_Password']);

    // Validate the form data (you can add more validation if needed)
    if (empty($pharmacyName) || empty($pharmacyAddress) || empty($pharmacyEmail) || empty($pharmacyPhone) || empty($password) || empty($confirmPassword)) {
        $error = 'Please fill in all the required fields.';
    } elseif ($password !== $confirmPassword) {
        $error = 'Password and Confirm Password do not match.';
    }

    if (empty($error)) {
        // Prepare and execute the database insert statement
        $query = $conn->prepare("INSERT INTO `pharmacy`(`Pharmacy_Name`, `Pharmacy_Email`, `Pharmacy_Phone`, `Pharmacy_Address`, `Password`) VALUES (?, ?, ?, ?, ?)");
        $query->bind_param('ssiss', $pharmacyName, $pharmacyEmail, $pharmacyPhone, $pharmacyAddress, $password);
        if ($query->execute()) {
            $pharmacyID = mysqli_insert_id($conn);
            echo "<script>alert('Your Pharmacy ID: $pharmacyID'); window.location.href = '../login.html';</script>";
            exit;
        } else {
            $error = 'Error registering the user. Please try again later.';
        }
        $query->close();
    }
} 

if(!empty($error)){
    echo "<script>alert('$error');</script>";
    echo "<script>window.location.href = '../register.html';</script>";
    exit;
}

?>