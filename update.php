<?php
// 1. Connection File Name: Isay 'connect.php' karein agar aapki file ka wahi naam hai
include 'auth.php';
include 'connect.php';
echo "<link rel='stylesheet' href='style.css'><div class='result-card'>"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form se data receive karna
    $id = $_POST['id'];
    $new_status = $_POST['application_status'];

    // 2. Security: Prepared Statement ka istemal (Cybersecurity perspective)
    // 3. Case Sensitivity: Table image ke mutabiq column 'ID' capital hai
    $stmt = $conn->prepare("UPDATE my_jobs SET application_status = ? WHERE ID = ?");
    $stmt->bind_param("si", $new_status, $id); // "s" for string (status), "i" for integer (id)

    if ($stmt->execute()) {
        echo "<h2>Status Updated!</h2>";
        echo "Job application (ID: $id) ka status ab <b>$new_status</b> ho chuka hai.<br>";
        echo "<a href='retrieve.php'>Updated list dekhein</a>";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}

echo "</div>";
mysqli_close($conn);
?>