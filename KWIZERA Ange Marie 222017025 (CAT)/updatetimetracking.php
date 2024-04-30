<?php
// Connection details
include('database_connection.php');


// Check if time_id is set
if(isset($_REQUEST['time_id'])) {
    $tid = $_REQUEST['time_id'];
    
    $stmt = $connection->prepare("SELECT * FROM timetracking WHERE time_id=?");
    $stmt->bind_param("i", $tid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['employee_id'];
        $z = $row['clock_in_time'];
        $w = $row['clock_out_time'];
    } else {
        echo "Time tracking entry not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update timetracking</title>
</head>

<html>
<body>
    <form method="POST">
        <label for="empid">Employee ID:</label>
        <input type="number" name="empid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="cit">Clock In Time:</label>
        <input type="datetime-local" name="cit" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="cot">Clock Out Time:</label>
        <input type="datetime-local" name="cot" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $employee_id = $_POST['empid'];
    $clock_in_time= $_POST['cit'];
    $clock_out_time = $_POST['cot'];
    
    // Validate inputs
    if (!is_numeric($employee_id)) {
        echo "Invalid employee ID.";
        exit;
    }
    // You can add more validation for clock_in_time and clock_out_time if needed
    
    // Update the payroll in the database
    $stmt = $connection->prepare("UPDATE timetracking SET employee_id=?, clock_in_time=?, clock_out_time=? WHERE time_id=?");
    $stmt->bind_param("sssi", $employee_id, $clock_in_time, $clock_out_time, $tid);
    if ($stmt->execute()) {
        // Redirect to timetracking.php
        header('Location: timetracking.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating data: " . $stmt->error;
    }
}
?>
