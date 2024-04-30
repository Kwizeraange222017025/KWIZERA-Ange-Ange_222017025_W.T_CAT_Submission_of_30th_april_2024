<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {
    // Connection details
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "cloudbasedpayroll_management_system";

    // Creating connection
    $connection = new mysqli($host, $user, $pass, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'employees' => "SELECT first_name FROM employees WHERE first_name LIKE '%$searchTerm%'",

        'payroll' => "SELECT payroll_id FROM payroll WHERE payroll_id LIKE '%$searchTerm%'",

        'timetracking' => "SELECT clock_out_time FROM timetracking WHERE clock_out_time LIKE '%$searchTerm%'",

        'tax' => "SELECT tax_name FROM tax WHERE tax_name LIKE '%$searchTerm%'",
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table: $table</h3>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
