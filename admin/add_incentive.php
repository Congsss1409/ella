
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Incentive</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">
</head>
<body>
<script src="sweetalert2.all.min.js"></script>
    <div class="container">
        <h2 class="mt-4">Add Incentive</h2>
        <?php
    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "social");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process form data
        $emp_id = $_GET['id'];
        $incentive = $_POST['incentive'];

        // Retrieve existing incentives from the database
        $sql = "SELECT actions FROM employees WHERE emp_id='$emp_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $existing_actions = $row['actions'];

        // Append the new incentive to the existing incentives
        if (!empty($existing_actions)) {
            $new_actions = $existing_actions . ", Added incentive: " . $incentive;
        } else {
            $new_actions = "Added incentive: " . $incentive;
        }

        // Update the actions field in the database
        $update_sql = "UPDATE employees SET actions='$new_actions' WHERE emp_id='$emp_id'";
        if (mysqli_query($conn, $update_sql)) {
            // Success message using SweetAlert2
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Incentive added successfully.'
                    });
                  </script>";
        } else {
            // Error message using SweetAlert2
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error: " . mysqli_error($conn) . "'
                    });
                  </script>";
        }
    }
    // Close database connection
    mysqli_close($conn);
?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="incentive" class="form-label">Incentive:</label>
                <input type="text" class="form-control" id="incentive" name="incentive" required>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
            <a href="index.php" class="btn btn-secondary">Back to Index</a> <!-- Link to index page -->
        </form>
    </div>

    <!-- Bootstrap JavaScript (optional if you need Bootstrap features that require JS) -->
    <script src="bootstrap.bundle.min.js"></script>
    <script src="sweetalert2.all.min.js"></script>
</body>
</html>
