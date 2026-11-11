<?php
include 'auth.php';
include 'connect.php';
echo "<link rel='stylesheet' href='style.css'><div class='result-card'>"; // Filename check karein

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form se data receive karna
    $company = $_POST['company_name'];
    $title = $_POST['job_title'];
    $source = $_POST['source_platform'];
    $url = $_POST['job_url'];
    $status = $_POST['application_status'];

    // SQL Injection se bachnay ke liye Prepared Statement
    $stmt = $conn->prepare("INSERT INTO my_jobs (company_name, job_title, source_platform, job_url, application_status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $company, $title, $source, $url, $status);

    if ($stmt->execute()) {
        echo "<h2>Success!</h2>";
        echo "Job application for <b>$company</b> has been recorded.<br>";
        echo "<a href='index.php'>Go back towards form</a> or <a href='retrieve.php'>View the Applications</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
echo "</div>";
mysqli_close($conn);
?>