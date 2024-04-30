<?php
// Connection details
include('database_connection.php');


// Check if tax_id is set
if(isset($_REQUEST['tax_id'])) {
    $tid = $_REQUEST['tax_id'];
    
    $stmt = $connection->prepare("SELECT * FROM tax WHERE tax_id=?");
    $stmt->bind_param("i", $tid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['tax_id'];
        $y = $row['tax_name'];
        $z = $row['tax_rate'];
        $w = $row['tax_category'];
    } else {
        echo "tax not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update tax</title>
</head>

<html>
<body>
    <form method="POST">
        <label for="tname">tax_name:</label>
        <input type="text" name="tname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="trate">tax_rate:</label>
        <input type="number" name="trate" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="tcat">tax_category:</label>
        <input type="text" name="tcat" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $tax_name = $_POST['tname'];
    $tax_rate = $_POST['trate'];
    $tax_category = $_POST['tcat'];
    
    // Update the tax in the database
    $stmt = $connection->prepare("UPDATE tax SET tax_name=?, tax_rate=?, tax_category=? WHERE tax_id=?");
    $stmt->bind_param("sssi", $tax_name, $tax_rate, $tax_category, $tid);
    $stmt->execute();
    
    // Redirect to tax.php
    header('Location: tax.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
