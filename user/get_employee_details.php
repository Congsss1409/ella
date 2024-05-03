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
