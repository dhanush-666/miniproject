<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
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
    input[type="email"],
    input[type="tel"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    button[type="submit"] {
        background-color: #007BFF;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 3px;
        cursor: pointer;
    }

    .form-container input[type="submit"] {
            background-color: #007BFF; /* Button background color */
            color: #fff; /* Button text color */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: rigth 10px;
        }

        /* Submit button hover effect */
        .form-container input[type="submit"]:hover {
            background-color: #0056b3; /* Button background color on hover */
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
        <h2>Edit Customer</h2>
        <?php
        // Include your database connection code here
        $db_host = "localhost";
        $db_user = "root";
        $db_pass = "";
        $db_name = "test";

        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form submission for editing here
            $customerId = $_POST['customerId'];
            $customerName = $_POST['customerName'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            // Create SQL query to update the record
            $updateQuery = "UPDATE customers SET customerName='$customerName', address='$address', email='$email', phone='$phone' WHERE customerId=$customerId";

            // Execute the update query
            if ($conn->query($updateQuery) === TRUE) {
                header("Location: customer1.php?id=$customerId");
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } elseif (isset($_GET['id'])) {
            // Retrieve the record to be edited
            $customerId = $_GET['id'];
            $sql = "SELECT * FROM customers WHERE customerId=$customerId";
            $result = $conn->query($sql);

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                // Display the record data in the form for editing
                ?>
                <form method="POST" action="edit.php">
                    <input type="hidden" name="customerId" value="<?php echo $row['customerId']; ?>">
                    <label for="customerName">Name:</label>
                    <input type="text" name="customerName" id="customerName" value="<?php echo $row['customerName']; ?>" required><br><br>

                    <label for="address">Address:</label>
                    <input type="text" name="address" id="address" value="<?php echo $row['address']; ?>" required><br><br>

                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?php echo $row['email']; ?>" required><br><br>

                    <label for="phone">Phone Number:</label>
                   <input type="tel" name="phone" id="phone" value="<?php echo $row['phone']; ?>" required><br><br>
  
                    <button type="submit" name="submit">Update</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="sucess.php" class="manage-button">customer details</a>

                </form>
                <?php
            } else {
                echo "Record not found.";
            }
        } else {
            echo "Invalid request.";
        }

        $conn->close();
        ?>
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
