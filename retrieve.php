<?php
include 'auth.php';
include 'connect.php'; // Apni connection file ka naam check karein

// SQL Query: Table se saara data nikalnay ke liye
$sql = "SELECT * FROM my_jobs";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Application Tracker</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="list-page">
<a href="logout.php" class="logout">Logout</a>

    <h2>My Job Applications List</h2>
    <p><a href="index.php">+ Add New Job</a></p>

    <table>
        <tr>
            <th>ID</th>
            <th>Company</th>
            <th>Position</th>
            <th>Platform</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php
        // Agar table mein data mojood hai
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["ID"] . "</td>"; // Table image ke mutabiq ID capital hai
                echo "<td>" . $row["company_name"] . "</td>";
                echo "<td>" . $row["job_title"] . "</td>";
                echo "<td>" . $row["source_platform"] . "</td>";
                echo "<td>" . $row["application_status"] . "</td>";
                // Delete form for each record
                echo "<td>
                        <form action='delete.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='id' value='" . $row["ID"] . "'>
                            <button type='submit' class='delete-btn' onclick='return confirm(\"Kya aap waqai delete karna chahtay hain?\")'>Delete</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No record is found.</td></tr>";
        }
        ?>
    </table>

</body>
</html>

<?php mysqli_close($conn); ?>