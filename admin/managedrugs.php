<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dug Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
    body{
        background-color:  #0ea83d;
    }
    .category-content {
        padding: 20px;
        background-color: white

    }

    h2 {
        color: black;
        text-align: center;
        font-family: 'Times New Roman', Times, serif;
        
    }

    .search-container {
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
      
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
    }

    th {
        background-color: #343a40;
        color: white;
    }

    tbody tr:hover {
        background-color: #f8f9fa;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }
    
</style>

</head>
<body>
    
</html>
<div class="category-content" id="Manage-Prescriptions">
    <div class="container my-5">
        <h2>DRUGS AVAILABLE IN THE SYSTEM</h2>
        <form method="GET" action="search_prescription.php">
            <div class="search-container">
                <label for="drug_id">Search By Drug ID</label>
                <input type="text" id="drug_id" name="drug_id" required>
                <input type="submit" value="Search">
            </div>
        </form>

        <br> <a class='btn btn-danger btn-sm' href='adddrugs.php'>Add New Drug</a></br>
        

        <table class="table">
            <thead>
                <tr>
                    <th>Drug ID</th>
                    <th>Drug Name</th>
                    <th>Drug Category</th>
                    <th>Drug Quantity</th>
                    <th>Drug Manufacturing Date</th>
                    <th>Drug Expiration Date</th>
                    <th>Drug Company</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Establish a connection to the database
                require_once("../connect.php");

                // Retrieve drug data from the database
                $sql = "SELECT * FROM drugs";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                     echo "<tr>
                            <td>$row[Drug_ID]</td>
                            <td>$row[Drug_Name]</td>
                            <td>$row[Drug_Description]</td>
                            <td>$row[Drug_Quantity]</td> 
                            <td>$row[Drug_Manufacturing_Date]</td>
                            <td>$row[Drug_Expiration_Date]</td>
                            <td>$row[Drug_Company]</td>
                            <td>
                                <a class='btn btn-danger btn-sm' href='editdrug.php'>Edit</a>
                            </td>
                         </tr>";
                             
                    }
                }
                 else {
                    echo "<tr><td colspan='7'>No drugs found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>