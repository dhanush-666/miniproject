<?php
// Database connection
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "test";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve product information
$sql = "SELECT id, product_name, product_price FROM products";
$result = $conn->query($sql);

// Check for query errors
if ($result === false) {
    echo "Error: " . $sql . "<br>" . $conn->error;
} else {
    echo '<div class="container">';
    echo '<h2>Product Details</h2>';
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Product Name</th>';
    echo '<th>Product Price</th>';
    echo '<th>Action</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Loop through the result set and display products
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["product_name"] . "</td>";
        echo "<td>" . $row["product_price"] . "</td>";
        echo "<td><a href='edit_product.php?edit_id=" . $row["id"] . "'>Edit</a></td>";
        echo "<td><a href='delete_product.php?delete_id=" . $row["id"] . "'>Delete</a></td>";
        echo "</tr>";
    }

    echo '</tbody>';
    echo '</table>';
    echo '<div class="center">';
    echo '<a href="footer.html">Go Back</a>';
    echo '</div>';
    echo '</div>';
}

$conn->close();
?>
<script>
    // Fetch the footer HTML using a fetch request
    fetch('footer.html')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(footerHtml => {
            // Insert the footer HTML into the current page
            document.body.insertAdjacentHTML('beforeend', footerHtml);
        })
        .catch(error => {
            console.error('Error fetching footer:', error);
        });
</script>

<style>
    /* Style for the table */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        border: 1px solid #ccc;
        background-color: #fff;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    /* Center align the table within the container */
    .container {
        text-align: center;
    }

    /* Style for the "Go Back" button */
    .center {
        text-align: center;
        margin-top: 20px;
    }

    .center a {
        display: inline-block;
        padding: 10px 20px;
        background-color: #333;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .center a:hover {
        background-color: #555;
    }
</style>
