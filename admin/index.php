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
        <!-- Button to trigger modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
            Add Employee
        </button>

        <!-- Modal for adding employee -->
        <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form to add employee -->
                        <form action="process_add_employee.php" method="POST">
                            <div class="mb-3">
                                <label for="empName" class="form-label">Employee Name</label>
                                <input type="text" class="form-control" id="empName" name="emp_name" required>
                            </div>
                            <!-- Add more fields as needed -->
                            <button type="submit" class="btn btn-primary">Add Employee</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="viewEmployeeModal" tabindex="-1" aria-labelledby="viewEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewEmployeeModalLabel">Employee Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="employeeDetails">
                <!-- Employee details will be loaded here using AJAX -->
            </div>
        </div>
    </div>
</div>

    <div class="container">
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
                    echo "<td><button type='button' class='btn btn-info btn-sm view-details-btn' data-bs-toggle='modal' data-bs-target='#viewEmployeeModal' data-id='".$row['emp_id']."'>View Details</button> ";

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="bootstrap.bundle.min.js"></script>
    <script>
    // JavaScript to load employee details dynamically when modal is shown
    $(document).on('click', '.view-details-btn', function() {
        var empId = $(this).data('id'); // Extract employee ID from data-id attribute
        var modal = $('#viewEmployeeModal');
        // AJAX request to fetch employee details
        $.ajax({
            type: 'GET',
            url: 'get_employee_details.php?id=' + empId,
            success: function(response) {
                modal.find('.modal-body').html(response); // Inject employee details into modal body
            }
        });
    });
</script>

    
</body>
</html>
