<?php
// Connection details
$host = "localhost";
$user = "ange";
$pass = "1234";
$database = "cloudbasedpayroll_management_system";

// Creating connection
$connection = new mysql($host, $user, $pass, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement to prevent SQL injection
    $sql = "SELECT * FROM user WHERE email=?"; 
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify the hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            
            header("Location: home.html");
            exit();
        } else {
            echo "Invalid email or password";
        }
    } else {
        echo "User not found";
    }
}

$connection->close();
?>
