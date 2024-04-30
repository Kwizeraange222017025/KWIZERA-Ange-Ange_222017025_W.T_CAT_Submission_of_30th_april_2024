<?php
// Connection details
include('database_connection.php');

// Function to show delete confirmation
function showDeleteConfirmation($tid) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($tid)">Confirm</button>
            <button onclick="returnToTimetracking()">Back</button>
        </div>
    </div>
    <script>
    function confirmDeletion(tid) {
        window.location.href = '?time_id=' + tid + '&confirm=yes';
    }
    function returnToTimetracking() {
        window.location.href = 'timetracking.php';
    }
    </script>
HTML;
}

// Check if time_id is set and is numeric
if(isset($_REQUEST['time_id']) && is_numeric($_REQUEST['time_id'])) {
    $tid = $_REQUEST['time_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM timetracking WHERE time_id=?");
    $stmt->bind_param("i", $tid);
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Record deleted successfully.";
        } else {
            echo "No record found with the specified time_id.";
        }
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "time_id is not set or is not a valid numeric value.";
}

$connection->close();
?>
