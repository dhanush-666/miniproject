<?php
// Database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$database = "test";

// Initialize variables for date range filtering
$startDate = "";
$endDate = "";

// Create a connection to the MySQL database
$conn = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form has been submitted and filter dates are provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["startDate"]) && !empty($_POST["endDate"])) {
    // Get the user-entered start and end dates for filtering
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
} else {
    // Set default start and end dates
    $startDate = "2023-01-01";
    $endDate = "2023-12-31";
}

// Define the number of records per page
$recordsPerPage = 10;

// Calculate the current page number (default to page 1 if not set)
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the starting record for the current page
$startRecord = ($current_page - 1) * $recordsPerPage;

// Modify the SQL query to include LIMIT for pagination
$sql = "SELECT
            DATE(INVOICE_DATE) AS invoice_date,
            INVOICE_NO,
            INVOICE_DATE,
            CNAME,
            CADDRESS,
            CCITY,
            PNAME,
            GRAND_TOTAL
        FROM invoice
        WHERE DATE(INVOICE_DATE) BETWEEN '$startDate' AND '$endDate'
        ORDER BY DATE(INVOICE_DATE) ASC
        LIMIT $startRecord, $recordsPerPage";

// Execute the query
$result = mysqli_query($conn, $sql);

// Count the total number of records
$totalRecordsSql = "SELECT COUNT(*) AS total FROM invoice WHERE DATE(INVOICE_DATE) BETWEEN '$startDate' AND '$endDate'";
$totalRecordsResult = mysqli_query($conn, $totalRecordsSql);
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];

// Calculate the total number of pages
$totalPages = ceil($totalRecords / $recordsPerPage);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sales Report</title>
    <style>
        /* Add some basic CSS styles to format the table */
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 5px 10px;
            margin: 0 5px;
            border: 1px solid #ccc;
            text-decoration: none;
            color: #333;
        }

        .pagination a.active {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>

<body>
    <h1>Sales Report</h1>
    <form method="post">
        <label for="startDate">From Date:</label>
        <input type="date" id="startDate" name="startDate" value="<?php echo $startDate; ?>" required>
        <label for="endDate">To Date:</label>
        <input type="date" id="endDate" name="endDate" value="<?php echo $endDate; ?>" required>
        <input type="submit" value="Filter">
    </form>
    <table>
        <tr>
            <th>Invoice Number</th>
            <th>Invoice Date</th>
            <th>Customer Name</th>
            <th>Customer Address</th>
            <th>Customer City</th>
            <th>Product Name</th>
            <th>Grand Total</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['INVOICE_NO'] . "</td>";
            echo "<td>" . $row['INVOICE_DATE'] . "</td>";
            echo "<td>" . $row['CNAME'] . "</td>";
            echo "<td>" . $row['CADDRESS'] . "</td>";
            echo "<td>" . $row['CCITY'] . "</td>";
            echo "<td>" . $row['PNAME'] . "</td>";
            echo "<td>" . $row['GRAND_TOTAL'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <div class="pagination">
        <?php if ($current_page > 1) : ?>
            <a href="?page=<?php echo $current_page - 1; ?>">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a <?php echo ($i == $current_page) ? 'class="active"' : ''; ?> href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($current_page < $totalPages) : ?>
            <a href="?page=<?php echo $current_page + 1; ?>">Next</a>
        <?php endif; ?>
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

<?php
// Close the database connection
if (isset($conn)) {
    mysqli_close($conn);
}
?>