<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPLATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <title> Doctor View - Add New Patient </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Patients</h2>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>SSN</th>       
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>                   
                    <th>Age</th>
                </tr>
            </thead>
            <tbody>
                <?php

                require_once("../connect.php");


                $resultsPerPage = 5;
                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($currentPage - 1) * $resultsPerPage;

                $countQuery = "SELECT COUNT(*) AS total FROM clients";
                $countResult = $connection->query($countQuery);
                $countRow = $countResult->fetch_assoc();
                $totalResults = $countRow['total'];
                $totalPages = ceil($totalResults / $resultsPerPage);

                $sql = "SELECT * FROM patients LIMIT $offset, $resultsPerPage";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$row[Patient_SSN]</td>                
                        <td>$row[Patient_Name]</td>
                        <td>$row[Patient_Email]</td>
                        <td>$row[Patient_Phone]</td>
                        <td>$row[Patient_Gender]</td>
                        <td>$row[Patient_Age]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='doctorNewPatient.php?id=$row[Patient_SSN]'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='patientdelete.php?id=$row[Patient_SSN]'>Delete</a>
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
    echo "<li class='page-item $activeClass'><a class='page-link' href='patientindex.php?page=$i'>$i</a></li>";
}
?>

