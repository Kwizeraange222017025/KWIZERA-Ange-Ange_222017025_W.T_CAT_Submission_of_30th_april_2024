<?php
// Connection details
include('database_connection.php');


// Check if employee_id is set
if(isset($_REQUEST['employee_id'])) {
    $eid = $_REQUEST['employee_id'];
    
    $stmt = $connection->prepare("SELECT * FROM employees WHERE employee_id=?");
    $stmt->bind_param("i", $eid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['employee_id'];
        $y = $row['first_name'];
        $z = $row['last_name'];
        $w = $row['date_of_birth'];
    } else {
        echo "Employee not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update employees</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update Form of employees</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="fname">First Name:</label>
        <input type="text" name="fname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="lname">Last Name:</label>
        <input type="text" name="lname" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="db">Date of Birth:</label>
        <input type="date" name="db" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $date_of_birth = $_POST['db'];
    
    // Update the employee in the database
    $stmt = $connection->prepare("UPDATE employees SET first_name=?, last_name=?, date_of_birth=? WHERE employee_id=?");
    $stmt->bind_param("sssi", $first_name, $last_name, $date_of_birth, $eid);
    $stmt->execute();
    
    // Redirect to employees.php
    header('Location: employees.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
