<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>payroll Page</title>

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
<body bgcolor="darkgreen">
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

		<h1>payroll</h1>
<form method="post" >

<label for="payroll_id">payroll_id:</label>
<input type="number" id="payroll_id" name="payroll_id"/><br><br>

<label for="employee_id ">employee_id:</label>
<input type="number" id="employee_id" name="employee_id"/><br><br>

<label for="pay_period_start_date">pay_period_start_date:</label>
<input type="date" id="pay_period_start_date" name="pay_period_start_date"/><br><br>

<label for="pay-period_end_date">pay-period_end_date:</label>
<input type="date" id="pay-period_end_date" name="pay-period_end_date"/><br><br>


<input type="submit" name="payroll" value="INSERT"/><br>

</form>
<?php
// Connection details
include('database_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO payroll(payroll_id, employee_id, pay_period_start_date, pay_period_end_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $pid, $empid, $pp, $ped);
    // Set parameters and execute
    $pid = $_POST['payroll_id'];
    $empid = $_POST['employee_id'];
    $pp = $_POST['pay_period_start_date'];
    $ped = $_POST['pay-period_end_date'];
   
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
// SQL query to fetch data from the payroll table
$sql = "SELECT * FROM Payroll";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of Payroll</title>
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
    <center><h2>Table of Payroll</h2></center>
    <table border="5">
        <tr>
            <th>payroll_id </th>
            <th>employee_id </th>
            <th>pay_period_start_date </th>
            <th>pay_period_end_date </th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
// Connection details
include('database_connection.php');

        // Prepare SQL query to retrieve all products
        $sql = "SELECT * FROM Payroll";
        $result = $connection->query($sql);

        // Check if there are any products
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $pid = $row['payroll_id']; // Fetch the Product_Id
                echo "<tr>
                    <td>" . $row['payroll_id'] . "</td>
                    <td>" . $row['employee_id'] . "</td>
                    <td>" . $row['pay_period_start_date'] . "</td>
                    <td>" . $row['pay_period_end_date'] . "</td>
                    <td><a style='padding:4px' href='deletepayroll.php?Product_Id=$pid'>Delete</a></td> 
                    <td><a style='padding:4px' href='updatepayroll.php?Product_Id=$pid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
<footer>
  <marquee><i style="color: green;">&copy; 2024</i><b>WEB TECHNOLOGY CAT</b></marquee>
</footer>
</body>
</html>