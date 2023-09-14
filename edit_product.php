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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated product information from the form
    $id = $_POST["id"];
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];

    // Update the product details in the database
    $sql = "UPDATE products SET product_name = '$product_name', product_price = '$product_price' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: product1.php?id=$id");
    } else {
        echo "Error updating product: " . $conn->error;
    }
} else {
    // Check if an 'edit_id' parameter is passed in the URL
    if (isset($_GET["edit_id"])) {
        $edit_id = $_GET["edit_id"];

        // Query to retrieve the product information based on 'edit_id'
        $sql = "SELECT id, product_name, product_price FROM products WHERE id = $edit_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Edit Product</title>
                <!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .manage-button {
            display: inline-block;
            background-color: #007BFF; /* Button background color */
            color: #fff; /* Button text color */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none; /* Remove underlines from links */
        }
/* "Manage" button hover effect */
.manage-button:hover{
    background-color: #0056b3; /* Button background color on hover */

}
    </style>
            </head>
            <body>
                <div class="container">
                    <h2>Edit Product</h2>
                    <form method="POST" action="edit_product.php">
                        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                        <label for="product_name">Product Name:</label>
                        <input type="text" name="product_name" value="<?php echo $row["product_name"]; ?>" required><br><br>
                        <label for="product_price">Product Price:</label>
                        <input type="number" name="product_price" value="<?php echo $row["product_price"]; ?>" required><br><br>
                        <input type="submit" value="Update Product">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="product_details.php" class="manage-button">product details</a>
                    </form>
                </div>
            
            <?php
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Invalid request.";
    }
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

</body>
</html>
