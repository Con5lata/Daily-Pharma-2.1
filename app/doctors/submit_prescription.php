<?php

require_once("../connect.php");

// Retrieve form data
$patient_ssn = $_POST['patient_ssn'];
$doctor_ssn = $_POST['doctor_ssn'];
$drug_ID = $_POST['Drug_ID'];
$prescription_amt = $_POST['prescription_amt'];
$prescription_dosage = $_POST['prescription_dosage'];
$prescription_inst = $_POST['prescription_inst'];

// Prepare the SQL statement
$sql = "INSERT INTO prescriptions (Patient_SSN, Doctor_SSN, Drug_ID, Prescription_Amount, Prescription_Dosage, Prescription_Instructions) VALUES ('$patient_ssn', '$doctor_ssn', '$drug_ID', '$prescription_amt', '$prescription_dosage', '$prescription_inst')";

if ($conn->query($sql) === TRUE) {
    $conn->close();
    
    echo "<script>
    alert('Prescription succesfully made. Pharmacy will deal with dispensing.')
    window.location.href = 'doctorView.php';
    exit;
    </script>";

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
