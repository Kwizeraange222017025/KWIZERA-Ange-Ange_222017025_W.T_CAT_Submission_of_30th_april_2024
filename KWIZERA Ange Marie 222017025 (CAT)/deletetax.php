<?php
// Connection details
include('database_connection.php');

// Function to show delete confirmation
function showDeleteConfirmation($tax_id) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($tax_id)">Confirm</button>
            <button onclick="returnToTax()">Back</button>
        </div>
    </div>
    <script>
    function confirmDeletion(tax_id) {
        window.location.href = '?tax_id=' + tax_id + '&confirm=yes';
    }
    function returnToTax() {
        window.location.href = 'tax.php';
    }
    </script>
HTML;
}

// Check if tax_id is set and is numeric
if(isset($_REQUEST['tax_id']) && is_numeric($_REQUEST['tax_id'])) {
    $tax_id = $_REQUEST['tax_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM tax WHERE tax_id=?");
    $stmt->bind_param("i", $tax_id);
    
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Record deleted successfully.";
        } else {
            echo "No record found with the specified tax_id.";
        }
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "tax_id is not set or is not a valid numeric value.";
}

$connection->close();
?>
