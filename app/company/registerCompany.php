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
         
    $companyName = trim($_POST['Company_Name']);
    $companyEmail = trim($_POST['Company_Email']);
    $companyPhone = trim($_POST['Company_Phone']);
    $password = trim($_POST['Password']);
    $confirmPassword = trim($_POST['Confirm_Password']);

    // Validate the form data (you can add more validation if needed)
    if (empty($companyName) || empty($companyEmail) || empty($companyPhone) || empty($password) || empty($confirmPassword)) {
        $error = 'Please fill in all the required fields.';
    } elseif ($password !== $confirmPassword) {
        $error = 'Password and Confirm Password do not match.';
    }

    if (empty($error)) {
        // Prepare and execute the database insert statement
        $query = $conn->prepare("INSERT INTO `company`(`Company_Name`, `Company_Email`, `Company_Phone`, `Password`) VALUES  (?, ?, ?, ?)");
        $query->bind_param('ssis', $companyName, $companyEmail, $companyPhone, $password);
        if ($query->execute()) {
            // Registration successful, redirect to login page
            header("Location: ../login.html");
            exit;
        } else {
            $error = 'Error registering the user. Please try again later.';
        }
        $query->close();
    }
}

if(!empty($error)){
    // Display the error message as an alert
    echo "<script>alert('$error');</script>";
    echo "<script>window.location.href = '../register.php';</script>";
    exit;
}

?>