<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>employees Page</title>

  <style>
  .dropdown {
    position: relative;
    display: inline-block;
    margin-right: 10px;
  }
  .dropdown-contents {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    left: 0;
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
    background-color: #seagreen;
  }
  footer {
    text-align: center;
    padding: 15px;
    background-color: green;
  }
  header {
    background-color: green;
    padding: 20px;
  }
  </style>
</head>
<body bgcolor="darkred">
<header>
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
</body>
</html>

<?php
// Connection details
include('database_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO employees (employee_id, first_name, last_name, date_of_birth) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $eid, $fn, $ln, $dob);

    // Set parameters and execute
    $eid = $_POST['employee_id'];
    $fn = $_POST['first_name'];
    $ln = $_POST['last_name'];
    $dob = $_POST['date_of_birth'];

    if ($stmt->execute()) {
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
// SQL query to fetch data from the employees table
$sql = "SELECT * FROM employees";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of employees</title>
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
    <center><h2>Table of employees</h2></center>
    <table border="5">
        <tr>
            <th>employee_id </th>
            <th>first_name </th>
            <th>last_name </th>
            <th>date_of_birth </th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
       <?php
// Connection details
include('database_connection.php');

        // Prepare SQL query to retrieve all employees
        $sql = "SELECT * FROM employees";
        $result = $connection->query($sql);

        // Check if there are any employees
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $pid = $row['employee_id']; // Fetch the employee_id
                echo "<tr>
                    <td>" . $row['employee_id'] . "</td>
                    <td>" . $row['first_name'] . "</td>
                    <td>" . $row['last_name'] . "</td>
                    <td>" . $row['date_of_birth'] . "</td>
                    <td><a style='padding:4px' href='deleteEmployee.php?employee_id=$pid'>Delete</a></td> 
                    <td><a style='padding:4px' href='updateEmployee.php?employee_id=$pid'>Update</a></td> 
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
