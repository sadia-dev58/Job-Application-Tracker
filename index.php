<?php include 'auth.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Application Tracker</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <a href="logout.php" class="logout">Logout</a>

    <h2>Job Application Tracker</h2>

    <form method="POST" action="insert.php">
        <h3>Add New Job Entry</h3>
        <label>Company Name:</label>
        <input type="text" name="company_name" placeholder="e.g. Google" required>

        <label>Job Title:</label>
        <input type="text" name="job_title" placeholder="e.g. Frontend Intern" required>

        <label>Source Platform:</label>
        <select name="source_platform">
            <option value="LinkedIn">LinkedIn</option>
            <option value="Indeed">Indeed</option>
            <option value="Rozee.pk">Rozee.pk</option>
            <option value="Referral">Referral/Friend</option>
        </select>

        <label>Job URL:</label>
        <input type="url" name="job_url" placeholder="https://linkedin.com/jobs/..." required>

        <label>Application Status:</label>
        <select name="application_status">
            <option value="Applied">Applied</option>
            <option value="Interviewing">Interviewing</option>
            <option value="Offered">Offered</option>
            <option value="Rejected">Rejected</option>
        </select>

        <button type="submit" name="submit" class="btn-insert">Save Application</button>
    </form>

    <hr>

    <form method="POST" action="update.php">
        <h3>Update Application Status</h3>
        <label>Job ID (Check from list):</label>
        <input type="number" name="id" placeholder="Enter ID to update" required>

        <label>New Status:</label>
        <select name="application_status">
            <option value="Applied">Applied</option>
            <option value="Interviewing">Interviewing</option>
            <option value="Offered">Offered</option>
            <option value="Rejected">Rejected</option>
        </select>

        <button type="submit" class="btn-update">Update Status</button>
    </form>

    <hr>

    <form method="POST" action="delete.php">
        <h3>Delete Application</h3>
        <label>Job ID to Remove:</label>
        <input type="number" name="id" placeholder="Enter ID to delete" required>
        <button type="submit" class="btn-delete">Remove Permanently</button>
    </form>

    <hr>

    <form method="GET" action="retrieve.php">
        <h3>View Job Pipeline</h3>
        <button type="submit" class="btn-retrieve">Show All Applications</button>
    </form>

</body>

</html>