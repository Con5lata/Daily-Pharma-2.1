<?php include "../inc/view_header.php";


?>

    <!-- Above fold -->
    <div class="image-container" id="about">
        <div class="Overlay-image">
        </div>
        <div class="content">
            <div class="image-slide">
                <div class="image-desc active">
                    <h2>Manage Our Users</h2>
                    <p> Manage the users in our system.</p>
                </div>
            </div>
        </div>
    </div>


    <div class="item"></div>
        <div class="title-text">
            <p>Users</p>
            <h1>Who uses our system?</h1>
        </div>

        <div class="container my-5" id="about">
            <h2>List of Patients</h2>
            <br> <a class='btn btn-danger btn-sm' href='addpatients.php'>Add New Patient</a></br>
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
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    require_once("../connect.php");

                    $resultsPerPage = 5;
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($currentPage - 1) * $resultsPerPage;

                    $countQuery = "SELECT COUNT(*) AS total FROM patients";
                    $countResult = $conn->query($countQuery);
                    $countRow = $countResult->fetch_assoc();
                    $totalResults = $countRow['total'];
                    $totalPages = ceil($totalResults / $resultsPerPage);

                    $sql = "SELECT * FROM patients LIMIT $offset, $resultsPerPage";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $conn->error);
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
                            <td>$row[Status]</td>
                            <td>
                                <a class='btn btn-danger btn-sm' href='patientedit.php?SSN=" . $row["Patient_SSN"] ."'>Edit</a>
                            </td>
                            
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>

            <nav aria-label="Page navigation">
                <ul class="pagination">
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    $activeClass = ($i == $currentPage) ? 'active' : '';
                    echo "<li class='page-item $activeClass'><a class='page-link' href='adminView.php?page=$i'>$i</a></li>";
                }
                ?>
                </ul>
            </nav>
        </div>

        <div class="item"></div>

        <div class="container my-5" id="about">
            <h2>List of Doctors</h2>
            <br> <a class='btn btn-danger btn-sm' href='adddoctors.php'>Add New Doctor</a></br>
            <br>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>SSN</th>       
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Speciality</th>
                        <th>Experience</th>                   
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    require_once("../connect.php");

                    $resultsPerPage = 5;
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($currentPage - 1) * $resultsPerPage;

                    $countQuery = "SELECT COUNT(*) AS total FROM doctors";
                    $countResult = $conn->query($countQuery);
                    $countRow = $countResult->fetch_assoc();
                    $totalResults = $countRow['total'];
                    $totalPages = ceil($totalResults / $resultsPerPage);

                    $sql = "SELECT * FROM doctors LIMIT $offset, $resultsPerPage";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $conn->error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>$row[Doctor_SSN]</td>                
                            <td>$row[Doctor_Name]</td>
                            <td>$row[Doctor_Phone]</td>
                            <td>$row[Doctor_Speciality]</td>
                            <td>$row[Doctor_Experience]</td>
                            <td>$row[Status]</td>
                            <td>
                                <a class='btn btn-danger btn-sm' href='doctoredit.php?SSN=" . $row["Doctor_SSN"] ."'>Edit</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>

            <nav aria-label="Page navigation">
                <ul class="pagination">
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    $activeClass = ($i == $currentPage) ? 'active' : '';
                    echo "<li class='page-item $activeClass'><a class='page-link' href='adminView.php?page=$i'>$i</a></li>";
                }
                ?>
                </ul>
            </nav>
        </div>

        <div class="item"></div>
        <div class="container my-5" id="about">
            <h2>List of Pharmacies</h2>
            <br>
            <br> <a class='btn btn-danger btn-sm' href='addpharmacy.php'>Add New Pharmacy</a></br>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>       
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>                   
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    require_once("../connect.php");

                    $resultsPerPage = 5;
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($currentPage - 1) * $resultsPerPage;

                    $countQuery = "SELECT COUNT(*) AS total FROM pharmacy";
                    $countResult = $conn->query($countQuery);
                    $countRow = $countResult->fetch_assoc();
                    $totalResults = $countRow['total'];
                    $totalPages = ceil($totalResults / $resultsPerPage);

                    $sql = "SELECT * FROM pharmacy LIMIT $offset, $resultsPerPage";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $conn->error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>$row[Pharmacy_ID]</td>                
                            <td>$row[Pharmacy_Name]</td>
                            <td>$row[Pharmacy_Email]</td>
                            <td>$row[Pharmacy_Phone]</td>
                            <td>$row[Pharmacy_Address]</td>
                            <td>$row[Status]</td>
                            <td>
                            <a class='btn btn-danger btn-sm' href='pharmacyedit.php?id=" . $row["Pharmacy_ID"] ."'>Edit</a>
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
                    echo "<li class='page-item $activeClass'><a class='page-link' href='adminView.php?page=$i'>$i</a></li>";
                }
                ?>
                </ul>
            </nav>
        </div>
        
        <div class="item"></div>
        
        <div class="container my-5" id="about">
            <h2>List of Companies</h2>
            <br>
            <br> <a class='btn btn-danger btn-sm' href='addcompanies.php'>Add New Company</a></br>
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
                    echo "<li class='page-item $activeClass'><a class='page-link' href='adminView.php?page=$i'>$i</a></li>";
                }
                ?>
                </ul>
            </nav>
        </div>
        

    <!--Footer-->
    <section id="footer">
        <div class="title-text">
            <p>CONTACT US</p>
            <h1>Any Queries?</h1>
        </div>

        <div class="footer-row">
            <div class="footer-left">
                <h1>Contact information</h1>
                <div class="contact-link">

                    <div class="contact-info">
                        <i class="uil uil-twitter"></i>
                        <span>@DailyPharma</span>
                    </div>

                    <div class="contact-info">
                        <i class="uil uil-instagram"></i>
                        <span>@TheDailyPharma</span>
                    </div>

                    <div class="contact-info">
                        <i class="uil uil-facebook"></i>
                        <span>@DailyPharma</span>
                    </div>

                    <div class="contact-info">
                        <i class="uil uil-linkedin"></i>
                        <span>@DailyPharma - Medical Website</span>
                    </div>

                    <div class="contact-info">
                        <i class="uil uil-at"></i>
                        <span>DailyPharma@gmail.com</span>
                    </div>

                    <div class="contact-info">
                        <i class="uil uil-calling"></i>
                        <span>0769690000</span>
                    </div>

                </div>
            </div>

            <div class="footer-right">
                <div class="quick-links">
                    <h1>Quick Links</h1>
                    <ul>
                      <li><a href="index.html">Home</a></li>
                      <li><a href="#service">About Us</a></li>
                      <li><a href="#feature">Features</a></li>
                      <li><a href="#">FAQ</a></li>
                      <li><a href="#">Privacy Policy</a></li>
                      <li><a href="#">Terms and Conditions</a></li>
                    </ul>
                  </div>
            </div>
        </div>

        <div class="additional-info">
            <p>&copy; 2023 DailyPharma. All rights reserved.</p>
        </div>
    </section>


    <script src="script.js"></script>
    <script src="script1.js"></script>
    <script src="script4.js"></script>
    
</body>
</html>