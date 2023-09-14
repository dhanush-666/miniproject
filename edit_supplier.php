<!DOCTYPE html>
<html>

<head>
    <title>Edit Supplier</title>
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

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
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
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }

        /* "Manage" button hover effect */
        .manage-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
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

    // Check if an 'id' parameter is passed in the URL
    if (isset($_GET["id"])) {
        $supplier_id = $_GET["id"];

        // Check if the form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the updated supplier information from the form
            $id = $_POST["id"];
            $name = $_POST["name"];
            $supplier_address = $_POST["supplier_address"];
            $supplier_phoneno = $_POST["supplier_phoneno"];
            $supplier_productname = $_POST["supplier_productname"];
            $product_price = $_POST["product_price"];

            // Update the supplier details in the database
            $sql = "UPDATE suppliers SET name = '$name', supplier_address = '$supplier_address', supplier_phoneno = '$supplier_phoneno', supplier_productname = '$supplier_productname', product_price = '$product_price' WHERE id = $id";
            if ($conn->query($sql) === TRUE) {
                // Redirect to the success page with the supplier ID as a parameter
                header("Location: update_sucess.php?id=$id");
                exit();
            } else {
                echo "Error updating supplier: " . $conn->error;
            }
        }

        // Query to retrieve the supplier information based on 'id'
        $sql = "SELECT id, name, supplier_address, supplier_phoneno, supplier_productname, product_price FROM suppliers WHERE id = $supplier_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
            <div class="container">
                <h2>Edit Supplier</h2>
                <form method="POST" action="edit_supplier.php?id=<?php echo $supplier_id; ?>">
                    <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" value="<?php echo $row["name"]; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="supplier_address">Supplier Address:</label>
                        <input type="text" name="supplier_address" value="<?php echo $row["supplier_address"]; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="supplier_phoneno">Supplier Phone No:</label>
                        <input type="text" name="supplier_phoneno" value="<?php echo $row["supplier_phoneno"]; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="supplier_productname">Supplier Product Name:</label>
                        <input type="text" name="supplier_productname" value="<?php echo $row["supplier_productname"]; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="product_price">Product Price:</label>
                        <input type="number" name="product_price" value="<?php echo $row["product_price"]; ?>" required>
                    </div>
                    <input type="submit" value="Update Supplier">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="supplier_details.php" class="manage-button">Supplier Details</a>
                </form>
            </div>
    <?php
        } else {
            echo "Supplier not found.";
        }
    } else {
        echo "Supplier ID not provided.";
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
