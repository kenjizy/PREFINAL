<?php
session_start();
require 'db.php'; // Ensure connection to database

// Check if ID is set in URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid Request!");
}

$id = intval($_GET['id']); // Convert to integer for security

// Fetch specific response by ID
$sql = "SELECT * FROM tbl_responses WHERE r_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Check if record exists
if ($result->num_rows === 0) {
    die("No record found!");
}

$row = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Response</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1c1c1c; /* Dark background */
            color: #f5f5f5; /* Light text color */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Center vertically */
        }

        .table-container {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 20px; /* Adjusted margin */
        }

        table {
            width: 80%;
            border-collapse: collapse;
            background-color: #2c2c2c; /* Darker table background */
        }

        th, td {
            border: 1px solid #444; /* Dark border */
            padding: 10px;
            text-align: left;
            color: #f5f5f5; /* Light text color */
        }

        th {
            background-color: #e74c3c; /* Red background for headers */
            color: white;
        }

        .table-header {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            background-color: #e74c3c; /* Red background for header */
            color: white;
            padding: 15px; /* Added padding for better spacing */
        }

        .button-container {
            text-align: center;
            padding: 10px;
        }

        .button-container a {
            display: inline-block;
            background: #e74c3c; /* Red background */
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
            font-size: 16px;
        }

        .button-container a:hover {
            background: #c0392b; /* Darker red on hover */
        }
    </style>
</head>
<body>
    <div class="table-container">
        <table>
            <tr>
                <th colspan="6" class="table-header">View Questions Details</th>
            </tr>
            <tr>
                <th>ID</th>
                <td><?= $row['r_id'] ?></td>
                <th>Description</th>
                <td><?= htmlspecialchars($row['r_des']) ?></td>
                <th>Goals</th>
                <td><?= htmlspecialchars($row['r_goals']) ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= htmlspecialchars($row['r_email']) ?></td>
                <th>Name</th>
                <td><?= htmlspecialchars($row['r_na']) ?></td>
                <th>Gender</th>
                <td><?= htmlspecialchars($row['r_gender']) ?></td>
            </tr>
            <tr>
                <th>Code</th>
                <td><?= htmlspecialchars($row['r_code']) ?></td>
                <th>Subject</th>
                <td><?= htmlspecialchars($row['r_sub']) ?></td>
                <th>Food</th>
                <td><?= htmlspecialchars($row['r_food']) ?></td>
            </tr>
            <tr>
                <th>Pet</th>
                <td><?= htmlspecialchars($row['r_pet']) ?></td>
                <th>Sport</th>
                <td><?= htmlspecialchars($row['r_sport']) ?></td>
                <th>Season</th>
                <td><?= htmlspecialchars($row['r_season']) ?></td>
            </tr>
            <tr>
                <th>Drink</th>
                <td><?= htmlspecialchars($row['r_drink']) ?></td>
                <th>Motivation</th>
                <td><?= htmlspecialchars($row['r_motiv']) ?></td>
                <th>Week</th>
                <td><?= htmlspecialchars($row['r_week']) ?></td>
            </tr>
            <tr>
                <th>Top</th>
                <td colspan="5"><?= htmlspecialchars($row['r_top']) ?></td>
            </tr>
            <tr>
                <td colspan="6" class="button-container">
                    <a href="display.php">Back to Results</a>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>