<?php
// Connection details
include('database_connection.php');


$y = $z = $w = "";

// Check if payroll_id is set
if(isset($_REQUEST['payroll_id'])) {
    $pid = $_REQUEST['payroll_id'];
    
    $stmt = $connection->prepare("SELECT * FROM payroll WHERE payroll_id=?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['payroll_id'];
        $y = $row['employee_id'];
        $z = $row['pay_period_start_date'];
        $w = $row['pay_period_end_date'];
    } else {
        echo "payroll not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update payroll</title>
</head>

<html>
<body>
    <form method="POST">
        <label for="empid">employee_id:</label>
        <input type="number" name="empid" value="<?php echo htmlspecialchars(isset($y) ? $y : ''); ?>">
        <br><br>

        <label for="ppsd">pay_period_start_date:</label>
        <input type="date" name="ppsd" value="<?php echo htmlspecialchars(isset($z) ? $z : ''); ?>">
        <br><br>

        <label for="pped">pay_period_end_date:</label>
        <input type="date" name="pped" value="<?php echo htmlspecialchars(isset($w) ? $w : ''); ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $employee_id = $_POST['empid'];
    $pay_period_start_date = $_POST['ppsd'];
    $pay_period_end_date = $_POST['pped'];
    
    // Update the payroll in the database
    $stmt = $connection->prepare("UPDATE payroll SET employee_id=?, pay_period_start_date=?, pay_period_end_date=? WHERE payroll_id=?");
    $stmt->bind_param("issi", $employee_id, $pay_period_start_date, $pay_period_end_date, $pid); // Changed "sssi" to "issi"
    $stmt->execute();
    
    // Redirect to payroll.php
    header('Location: payroll.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
