<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Employee</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
    <script src="sweetalert2.all.min.js"></script>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "social");
    $emp_id = $_GET['id'];
    $sql = "DELETE FROM employees WHERE emp_id='$emp_id'";
    if (mysqli_query($conn, $sql)) {
        // Success message using SweetAlert2
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Employee deleted successfully.'
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
    mysqli_close($conn);
?>

    </div>

    <!-- Bootstrap JavaScript (optional if you need Bootstrap features that require JS) -->
    <script src="bootstrap.bundle.min.js"></script>
    
    <!-- JavaScript for auto-refresh and redirect -->
    <script>
        // Delayed refresh and redirect
        setTimeout(function() {
            window.location.href = "index.php"; // Redirect to index page after 3 seconds
        }, 1000); // 3000 milliseconds = 3 seconds
    </script>
</body>
</html>
