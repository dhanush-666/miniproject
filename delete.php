<?php
$db_host = "localhost"; // Replace with your MySQL hostname or IP address
$db_user = "root"; // Replace with your MySQL username
$db_pass = ""; // Replace with your MySQL password
$db_name = "test"; // Replace with the name of your MySQL database

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $customerId = $_GET['id'];

    $sql = "DELETE FROM customers WHERE customerId='$customerId'";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header("Location:sucess.php"); // Redirect to the customer list page
        exit();
    } else {
        echo "Error deleting customer: " . mysqli_error($conn);
    }
}
?>
