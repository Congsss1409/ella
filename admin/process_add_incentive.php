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
    $emp_id = $_POST['emp_id'];
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
        // Success response
        $response = array(
            'status' => 'success',
            'title' => 'Success',
            'message' => 'Incentive added successfully.'
        );
    } else {
        // Error response
        $response = array(
            'status' => 'error',
            'title' => 'Error',
            'message' => 'Error: ' . mysqli_error($conn)
        );
    }

    // Return JSON response
    echo json_encode($response);
}

// Close database connection
mysqli_close($conn);
?>
