<!DOCTYPE html>
<html>
<head>
    <title>Search Prescription Result</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h2> Prescription Result</h2>

    <?php
    // Establish a connection to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "users";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the search parameter
    $patient_ssn = $_GET['patient_ssn'];

    // Prepare the SQL statement
    $sql = "SELECT * FROM prescriptions WHERE Patient_SSN = '$patient_ssn'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>Prescription ID</th>";
        echo "<th>Patient SSN</th>";
        echo "<th>Doctor SSN</th>";
        echo "<th>Drug Name</th>";
        echo "<th>Prescription Amount</th>";
        echo "<th>Prescription Dosage</th>";
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Prescription_ID"] . "</td>";
            echo "<td>" . $row["Patient_SSN"] . "</td>";
            echo "<td>" . $row["Doctor_SSN"] . "</td>";
            echo "<td>" . $row["Drug_Name"] . "</td>";
            echo "<td>" . $row["Prescription_Amt"] . "</td>";
            echo "<td>" . $row["Prescription_Dosage"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No prescriptions found for the provided Patient SSN.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
