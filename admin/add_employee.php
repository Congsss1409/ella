<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <!-- Bootstrap CSS -->
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
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Add Employee</h2>
                        <form method="post" action="process_add_employee.php">
                            <div class="mb-3">
                                <label for="emp_name" class="form-label">Employee Name:</label>
                                <input type="text" class="form-control" id="emp_name" name="emp_name" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Employee</button>
                            <a href="index.php" class="btn btn-success btn-block">Go to Dashboard</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript (optional if you need Bootstrap features that require JS) -->
    <script src="bootstrap.bundle.min.js"></script>
</body>
</html>
