<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Recognition Management System</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .header-logo {
            width: 150px;
        }
        header {
            background-color: #343a40;
            color: #ffffff;
            padding: 20px 0;
        }
        header h1 {
            font-size: 28px;
            font-weight: bold;
            margin: 0;
        }
        .container {
            margin-top: 20px;
        }
        .btn {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .table {
            background-color: #ffffff;
        }
        .table th,
        .table td {
            border-color: #dee2e6;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <img src="bomba.png" alt="Logo" class="header-logo">
                </div>
                <div class="col text-end">
                    <h1>Social Recognition Management System</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <a href="add_employee.php" class="btn btn-primary mb-3">Add Employee</a>
        <a href="../index.php" class="btn btn-danger mb-3">Log Out</a>
        <?php
            // Database connection
            $conn = mysqli_connect("localhost", "root", "", "social");

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Display employees
            $sql = "SELECT * FROM employees";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<table class='table table-bordered'>";
                echo "<thead><tr><th>Employee ID</th><th>Name</th><th>Actions</th></tr></thead>";
                echo "<tbody>";
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row['emp_id']."</td>";
                    echo "<td>".$row['emp_name']."</td>";
                    echo "<td><a href='view_details.php?id=".$row['emp_id']."' class='btn btn-info btn-sm'>View Details</a> ";
                    echo "<a href='add_incentive.php?id=".$row['emp_id']."' class='btn btn-success btn-sm'>Add Incentive</a> ";
                    echo "<a href='delete_employee.php?id=".$row['emp_id']."' class='btn btn-danger btn-sm'>Delete</a></td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p class='mt-3'>No employees found.</p>";
            }

            mysqli_close($conn);
        ?>
    </div>

    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>
