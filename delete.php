<?php
// 1. File Name Check: Ensure it matches your connection file
include 'auth.php';
include 'connect.php';
echo "<link rel='stylesheet' href='style.css'><div class='result-card'>"; 

// 2. Data Validation: Check if 'id' exists and is a number
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    
    $id = $_POST['id'];

    // 3. SQL Case-Sensitivity: Your table image shows "ID" in capital letters
    // 4. Security: Use mysqli_real_escape_string to prevent basic SQL injection
    $safe_id = mysqli_real_escape_string($conn, $id);
    $sql = "DELETE FROM my_jobs WHERE ID='$safe_id'";

    if (mysqli_query($conn, $sql)) {
        echo "<h2>Record Deleted!</h2>";
        echo "Job application (ID: $id) has been removed from your tracker.<br>";
        echo "<a href='retrieve.php'>Go back to the list</a>";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid ID provided.";
}

echo "</div>";
mysqli_close($conn);
?>