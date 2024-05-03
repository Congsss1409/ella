<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 60px; /* Adjust based on your navbar height */
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 10px 10px 0 0;
        }
        .btn-back {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-back:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Employee Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">Employee Details</h2>
            </div>
            <div class="card-body">
                <?php
                    // Database connection
                    $conn = mysqli_connect("localhost", "root", "", "social");

                    // Check connection
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    // Get employee ID from URL parameter
                    $emp_id = $_GET['id'];

                    // Retrieve employee details from the database
                    $sql = "SELECT * FROM employees WHERE emp_id='$emp_id'";
                    $result = mysqli_query($conn, $sql);

                    // Display employee details
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        echo "<p><strong>Employee ID:</strong> " . $row['emp_id'] . "</p>";
                        echo "<p><strong>Name:</strong> " . $row['emp_name'] . "</p>";

                        // Display incentives
                        if (!empty($row['actions'])) {
                            echo "<p><strong>Incentives:</strong></p>";
                            echo "<ul>";
                            $incentives = explode(", ", $row['actions']);
                            foreach ($incentives as $incentive) {
                                echo "<li>$incentive</li>";
                            }
                            echo "</ul>";
                        } else {
                            echo "<p>No incentives added for this employee.</p>";
                        }
                    } else {
                        echo "<p>Employee not found.</p>";
                    }

                    // Close database connection
                    mysqli_close($conn);
                ?>
            </div>
        </div>
        <!-- Back to index button -->
        <a href="dashboard.php" class="btn btn-back mt-3">Back to Dashboard</a>
    </div>

    <!-- Bootstrap JavaScript (optional if you need Bootstrap features that require JS) -->
    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>
