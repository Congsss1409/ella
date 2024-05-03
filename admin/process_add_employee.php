<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
    <script src="sweetalert2.all.min.js"></script>
    <?php
    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "social");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Process form data
    $emp_name = $_POST['emp_name'];

    // Insert new employee into the database
    $sql = "INSERT INTO employees (emp_name) VALUES ('$emp_name')";
    if (mysqli_query($conn, $sql)) {
        // Success message using SweetAlert2
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'New employee added successfully.'
                }).then((result) => {
                    // Redirect to a page after success if needed
                    window.location = 'index.php';
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

    // Close database connection
    mysqli_close($conn);
?>

        <!-- JavaScript for auto-refresh and redirect -->
        <script>
            // Delayed refresh and redirect
            setTimeout(function() {
                window.location.href = "index.php"; // Redirect to index page after 3 seconds
            }, 1000); // 3000 milliseconds = 3 seconds
        </script>
    </div>

    <!-- Bootstrap JavaScript (optional if you need Bootstrap features that require JS) -->
    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>
