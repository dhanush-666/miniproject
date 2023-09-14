<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .center {
            text-align: center;
            margin-top: 20px; /* Adjust the margin as needed */
        }

        .center a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .center a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Customer Details</h2>
        <table>
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Perform database connection to retrieve all customer information
            $db_host = "localhost";
            $db_user = "root";
            $db_pass = "";
            $db_name = "test";

            $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM customers";
            $result = $conn->query($sql);

            if ($result === false) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            } else {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["customerName"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["phone"] . "</td>";
                    echo "<td class='action-links'>";
                echo "<a href='edit.php?id=" . $row['customerId'] . "'>Edit</a>  "; // Edit link
                echo "<a href='delete.php?id=" . $row['customerId'] . "' onclick='return confirm(\"Are you sure you want to delete this customer?\")'>Delete</a>"; // Delete link with confirmation
                echo "</td>";
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
