<?php
// Connection details
include('database_connection.php');

// Function to show delete confirmation
function showDeleteConfirmation($pid) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($pid)">Confirm</button>
            <button onclick="returnToPayroll()">Back</button>
        </div>
    </div>
    <script>
    function confirmDeletion(pid) {
        window.location.href = '?payroll_Id=' + pid + '&confirm=yes';
    }
    function returnToPayroll() {
        window.location.href = 'payroll.php';
    }
    </script>
HTML;
}

// Check if payroll_Id is set
if(isset($_REQUEST['payroll_Id'])) {
    $pid = $_REQUEST['payroll_Id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM payroll WHERE payroll_Id=?");
    $stmt->bind_param("i", $pid);
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Record deleted successfully.<br><br>";
            echo "<a href='payroll.php'>OK</a>";
        } else {
            echo "No records deleted. Payroll ID not found.";
        }
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Payroll ID is not set.";
}

$connection->close();
?>
