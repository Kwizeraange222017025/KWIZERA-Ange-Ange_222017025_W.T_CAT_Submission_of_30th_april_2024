<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>tax Page</title>

  <style>
  .dropdown {
    position: relative;
    display: inline-block; /* Corrected: changed "inline" to "inline-block" */
    margin-right: 10px;
  }
  .dropdown-contents {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    left: 0; /* Aligning dropdown contents to the left */
  }
  .dropdown:hover .dropdown-contents {
    display: block;
  }
  .dropdown-contents a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }
  .dropdown-contents a:hover {
    background-color: #f1f1f1;
  }
    footer{
    text-align: center;
    padding: 15px;
    background-color:green;
}
header{
    background-color:green;
    padding: 20px;
}


  </style>
</head>
<header>
<body bgcolor="black">
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline-block; margin-right: 10px;"><a href="./home.html" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">HOME</a></li>
    <li style="display: inline-block; margin-right: 10px;"><a href="./about.html" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">ABOUT</a></li>
    <li style="display: inline-block; margin-right: 10px;"><a href="./contact.html" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">CONTACT</a></li>
    <li style="display: inline-block; margin-right: 10px;"><a href="./employees.php" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">EMPLOYEE</a></li>
    <li style="display: inline-block; margin-right: 10px;"><a href="./payroll.php" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">PAYROLL</a></li>
    <li style="display: inline-block; margin-right: 10px;"><a href="./timetracking.php" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">TIMETRACKING</a></li>
    <li style="display: inline-block; margin-right: 10px;"><a href="./tax.php" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">TAX</a></li>
    <li class="dropdown">
      <a href="#" style="padding: 10px; color: white; background-color: hotpink; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li>
  </ul>
  <!-- <div class="col-3 offset">-->
  <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
</header>
  <center>
    <section id="home" style="display: block;">
		<h1>tax</h1>
<form method="post" action="tax.php">

<label for="tax_id">tax_id:</label>
<input type="number" id="tax_id" name="tax_id"/><br><br>

<label for="tax_name ">tax_name:</label>
<input type="text" id="tax_name" name="tax_name"/><br><br>

<label for="tax_rate">tax_rate:</label>
<input type="number" id="tax_rate" name="tax_rate"/><br><br>

<label for="tax_category">tax_category:</label>
<input type="text" id="tax_category" name="tax_category"/><br><br>


<input type="submit" name="tax" value="INSERT"/><br>
<?php
// Connection details
include('database_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO tax(tax_id, tax_name, tax_rate, tax_category) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $tid, $tn, $tr, $tc);
    // Set parameters and execute
    $tid = $_POST['tax_id'];
    $tn = $_POST['tax_name'];
    $tr = $_POST['tax_rate'];
    $tc = $_POST['tax_category'];
   
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>

<?php
// Connection details
include('database_connection.php');
// SQL query to fetch data from the tax table
$sql = "SELECT * FROM tax";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of tax</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of tax</h2></center>
    <table border="5">
        <tr>
            <th>tax_id </th>
            <th>tax_name </th>
            <th>tax_rate </th>
            <th>tax_category </th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
       <?php
// Connection details
include('database_connection.php');

        // Prepare SQL query to retrieve all tax
        $sql = "SELECT * FROM tax";
        $result = $connection->query($sql);

        // Check if there are any tax
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $tid = $row['tax_id']; // Fetch the tax_id
                echo "<tr>
                    <td>" . $row['tax_id'] . "</td>
                    <td>" . $row['tax_name'] . "</td>
                    <td>" . $row['tax_rate'] . "</td>
                    <td>" . $row['tax_category'] . "</td>
                    <td><a style='padding:4px' href='deletetax.php?tax_id=$tid'>Delete</a></td> 
                    <td><a style='padding:4px' href='updatetax.php?tax_id=$tid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table

	<footer>
  <marquee><i style="color: green;">&copy; 2024</i><b>WEB TECHNOLOGY CAT</b></marquee>
</footer>
</body>
</html>