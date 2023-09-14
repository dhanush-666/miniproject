<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Details</title>
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
</head>
<body>
    <div class="container">
        <h2>Supplier Details</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Supplier Address</th>
                    <th>Supplier Phone No</th>
                    <th>Supplier Product Name</th>
                    <th>Product Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Perform database connection to retrieve supplier information
                $db_host = "localhost";
                $db_user = "root";
                $db_pass = "";
                $db_name = "test";

                $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT id, name, supplier_address, supplier_phoneno, supplier_productname, product_price FROM suppliers"; // Updated query
                $result = $conn->query($sql);

                if ($result === false) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                } else {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["supplier_address"] . "</td>";
                        echo "<td>" . $row["supplier_phoneno"] . "</td>";
                        echo "<td>" . $row["supplier_productname"] . "</td>";
                        echo "<td>" . $row["product_price"] . "</td>";
                        echo "<td><a href='edit_supplier.php?id=" . $row["id"] . "'>Edit</a></td>"; // Edit link
                        echo "<td><a href='delete_supplier.php?id=" . $row["id"] . "'>Delete</a></td>"; // Delete link
                        echo "</tr>";
                    }
                }

                $conn->close();
                ?>
            </tbody>
        </table>
        <div class="center">
            <a href="footer.html">Go Back!!!</a>
        </div>
    </div>
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
