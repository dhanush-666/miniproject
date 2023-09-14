<?php
// Include your database connection code here
$hostname = "localhost";
$username = "root";
$password = "";
$database = "test";

$connection = mysqli_connect($hostname, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Create SQL query to delete the record
    $deleteQuery = "DELETE FROM products WHERE id=$delete_id"; // Replace 'demo' with your table name

    // Execute the delete query
    $result = mysqli_query($connection, $deleteQuery);

    if ($result) {
        header("Location:product_details.php");
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($connection);
?>
<a href="product_details.php">Back to Display Data</a>