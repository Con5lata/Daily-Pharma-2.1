<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drug catalog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="categories">
        <H1>Selelct a category</H1>
        <ul>
        <?php $section = isset($_GET['cat']) ? $_GET['cat'] : null; ?>

            <li class="antibiotics" <?php if($section=="antibiotics"){echo "on";}?>><a href="viewDrugs.php?cat=antibiotics">Antibiotics</a></li>
            <li class="painrelievers"<?php if($section=="painrelievers"){echo "on";}?>><a href="viewDrugs.php?cat=painrelievers">Pain relievers</a></li>
            <li class="antifungal" <?php if($section=="antifungal"){echo "on";}?>><a href="viewDrugs.php?cat=antifungal">Antifungal</a></li>
            <li class="immunotherapy" <?php if($section=="immunotherapy"){echo "on";}?>><a href="viewDrugs.php?cat=immunotherapy">Immunotherapy</a></li>
            <li class="immunosuppressants" <?php if($section=="immunosuppressants"){echo "on";}?>><a href="viewDrugs.php?cat=immunosuppressants">Immunosuppressants</a></li>
            <li class="antiparasitic" <?php if($section=="antiparasitic"){echo "on";}?>><a href="viewDrugs.php?cat=antiparasitic">AntiParasitic</a></li>
        </ul>
    </div>
    <style>
        
.categories{
    width:100%;
            margin:auto;
            padding: 35px 0;
            display:flex;
            align-items: center;
            justify-content:space-between;
            background-color:purple;
}
.categories ul li::after{
            content:'';
            height: 3px;
            width:0;
            background: rgba(227, 226, 231, 0.4);
            position: absolute;
            left:0;
            bottom:-10px;
            transition: 0.5s;

        }
        .categories ul li:hover::after{
            width: 100%;
        }
        .categories ul li{
            list-style: none;
            display: inline-block;
            margin: 0 20px;
            position: relative;
        }
        .categories ul li a{

            text-decoration:double;
            color: aqua;
            text-transform: capitalize;

        }
        . body img{
            height: 50px;
            width:30px;
        }
        img {
    border: 0;   
    -ms-interpolation-mode: bicubic;  
}
/* Style the categories menu */
.categories {
    list-style: none;
    margin: 0;
    padding: 0;
}

.categories a {
    text-decoration: none;
   /* color: #333;*/
    font-weight: bold;
    padding: 10px 20px;
    display: block;
   /* background-color: #f5f5f5;
    border: 1px solid #ddd;
    border-radius: 5px;*/
    margin-bottom: 5px;
    transition: background-color 0.3s ease-in-out;
    text-transform: capitalize;
}

.categories a:hover {
    text-decoration: underline;
    border-bottom: 1px solid blue;
    color: blue;
}
/* Reset some default browser styles */
body, h1, h2, ul, li, p, a {
    margin: 0;
    padding: 0;
}

/* Style the container for the categories and product list */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Style the categories menu */
.categories {
    background-color: #f5f5f5;
    padding: 20px;
    border-radius: 5px;
}

.categories h1 {
    font-size: 24px;
    margin-bottom: 10px;
}

.categories ul {
    list-style: none;
    padding: 0;
}

.categories li {
    margin: 5px 0;
}

/* Style the product listings */
.product {
    background-color: #fff;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    margin: 10px;
    padding: 10px;
    text-align: center;
}

.product img {
    width: 30px;
    height: 50px;
    margin-bottom: 10px;
}

.product p {
    font-size: 16px;
    margin: 0;
}

.product a {
    display: inline-block;
    padding: 5px 10px;
    background-color: #0073e6;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 10px;
    font-weight: bold;
}

/* Style the header*/ 
header {
    background-color: #333;
    color: #fff;
    padding: 20px 0;
    text-align: center;
}

header h1 {
    font-size: 36px;
}

/* Style the footer */
footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
}

/* Responsive styles (adjust as needed) */
@media (max-width: 768px) {
    .container {
        padding: 10px;
    }
    .categories {
        padding: 10px;
    }
    .product {
        margin: 10px 0;
    }
    
}
.details {
    background:url(Grey_background.jpg);
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }
    body{
        background:url(Grey_background.jpg);
    }
*/


    </style>
<div class="details">

<?php
include '../patients/connect.php';
$PageTitle="All drugs";
$section=null;

if(isset($_GET['cat'])){
    if($_GET['cat']=="antibiotics"){
        $PageTitle="antibiotics";
        $section="antibiotics";
        echo "<div class='category-container'>";
         
         echo "<h1>".$PageTitle."</h1>";
    echo "<h2>".$section."</h2>";

        $sql="SELECT * FROM drugs WHERE Drug_Category='antibiotic'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product">';
               // $imageData= $row["Drug_Image"];
                //header('Content-Type:image/jpeg');
                //echo $imageData;
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row["Drug_Image"]) . '" alt="' . $row["Drug_Name"] . '">';
               // echo '<img src="data:image/png;base64,' . base64_encode($row["Drug_Image"]) . '" alt="' . $row["Drug_Name"] . '">';
                echo '<p>' . $row["Drug_Name"] . '</p>';
                echo '<a href="details.php?drug_id=' . $row["Drug_ID"] . '">View Details</a>';
                echo '</div>';
           

        }
    }
    }
    if($_GET['cat']=="painrelievers"){
        $PageTitle="pain relievers";
    $section="pain relievers";
    echo "<div class='category-container'>";
    echo "<h1>".$PageTitle."</h1><br>";
    echo "<h2>".$section."</h2>";

        $sql="SELECT * FROM drugs WHERE Drug_Category='Pain reliever'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product">';
              //  $imageData= $row["Drug_Image"];
                //header('Content-Type:image/jpeg');
               // echo $imageData;
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row["Drug_Image"]) . '" alt="' . $row["Drug_Name"] . '">';
               // echo '<img  src="data:image/png;base64,' . base64_encode($row["Drug_Image"]) . '" alt="' . $row["Drug_Name"] . '">';
                echo '<p>' . $row["Drug_Name"] . '</p>';
                echo '<a href="details.php?drug_id=' . $row["Drug_ID"] . '">View Details</a>';
                echo '</div>';

        }
    }
    }
    if($_GET['cat']=="immunotherapy"){
        $PageTitle="immunotherapy";
    $section="Immunotherapy drugs";
    echo "<div class='category-container'>";
    echo "<h1>".$PageTitle."</h1><br>";
    echo "<h2>".$section."</h2>";
        $sql="SELECT * FROM drugs WHERE Drug_Category='Immunotherapy'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product">';
                //$imageData= $row["Drug_Image"];
                //header('Content-Type:image/jpeg');
                //echo $imageData;
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row["Drug_Image"]) . '" alt="' . $row["Drug_Name"] . '">';
               // echo '<img src="data:image/png;base64,' . base64_encode($row["Drug_Image"]) . '" alt="' . $row["Drug_Name"] . '">';
               // echo '<img src="' . $row["Drug_Image"] . '" alt="' . $row["Drug_Name"] . '">';
                echo '<p>' . $row["Drug_Name"] . '</p>';
                echo '<a href="details.php?drug_id=' . $row["Drug_ID"] . '">View Details</a>';
                echo '</div>';

        }
    }
    }
    if($_GET['cat']=="immunosuppressants"){
        $PageTitle="immunosuppressants";
    $section="immunosuppressants";
    echo "<div class='category-container'>";
    echo "<h1>".$PageTitle."</h1><br>";
    echo "<h2>".$section."</h2>";


        $sql="SELECT * FROM drugs WHERE Drug_Category='Immunosuppressants'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product">';
               /* $imageData= $row["Drug_Image"];
                header('Content-Type:image/jpeg');
                echo $imageData;*/
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row["Drug_Image"]) . '" alt="' . $row["Drug_Name"] . '">';
                //echo '<img src="data:image/png;base64,' . base64_encode($row["Drug_Image"]) . '" alt="' . $row["Drug_Name"] . '">';
                //echo '<img src="' . $row["Drug_Image"] . '" alt="' . $row["Drug_Name"] . '">';
                echo '<p>' . $row["Drug_Name"] . '</p>';
                echo '<a href="details.php?drug_id=' . $row["Drug_ID"] . '">View Details</a>';
                echo '</div>';

        }
    }
    }
    if($_GET['cat']=="antiparasitic"){
        $PageTitle="antiparasitic";
    $section="Antiparasitic drugs";
    echo "<div class='category-container'>";
    echo "<h1>".$PageTitle."</h1><br>";
    echo "<h2>".$section."</h2>";
        $sql="SELECT * FROM drugs WHERE Drug_Category='Antiparasitic'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product">';
                //$imageData= $row["Drug_Image"];
                //header('Content-Type:image/jpeg');
                //echo $imageData;
                //echo '<img src="' . $row["Drug_Image"] . '" alt="' . $row["Drug_Name"] . '">';
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row["Drug_Image"]) . '" alt="' . $row["Drug_Name"] . '">';
               // echo '<img src="data:image/png;base64,' . base64_encode($row["Drug_Image"]) . '" alt="' . $row["Drug_Name"] . '">';
                echo '<p>' . $row["Drug_Name"] . '</p>';
                echo '<a href="details.php?drug_id=' . $row["Drug_ID"] . '">View Details</a>';
                echo '</div>';

        }
    }
    }
    if($_GET['cat']=="antifungal"){
        $PageTitle="antifungal";
    $section="Antifungal drugs";
    echo "<div class='category-container'>";
    echo "<h1>".$PageTitle."</h1><br>";
    echo "<h2>".$section."</h2>";
        $sql="SELECT * FROM drugs WHERE Drug_Category='Antifungal'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product">';
               // $imageData= $row["Drug_Image"];
                //header('Content-Type:image/jpeg');
                //echo $imageData;
              //  echo '<img src="' . $row["Drug_Image"] . '" alt="' . $row["Drug_Name"] . '">';
              echo '<img src="data:image/jpeg;base64,' . base64_encode($row["Drug_Image"]) . '" alt="' . $row["Drug_Name"] . '">';
             // echo '<img src="data:image/png;base64,' . base64_encode($row["Drug_Image"]) . '" alt="' . $row["Drug_Name"] . '">';
                echo '<p>' . $row["Drug_Name"] . '</p>';
                echo '<a href="details.php?drug_id=' . $row["Drug_ID"] . '">View Details</a>';
                echo '</div>';

        }
    }
    }
}

?>
</div>
</body>
</html>