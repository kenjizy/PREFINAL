<?php
session_start();
require 'db.php'; // Ensure this file connects to your database

// Fetch all responses from the database
$sql = "SELECT * FROM tbl_responses ORDER BY r_id ASC"; // Order by ID ascending
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Results</title>
    <link rel="stylesheet" href="display.css">
</head>
<body>
    <div class="container">
        <h2>Survey Results</h2>
        
        <div class="table-container">
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Description</th>
                        <th>Goals</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Code</th>
                        <th>Subject</th>
                        <th>Food</th>
                        <th>Pet</th>
                        <th>Sport</th>
                        <th>Season</th>
                        <th>Drink</th>
                        <th>Motivation</th>
                        <th>Week</th>
                        <th>Top</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $count = 1; // Start numbering from 1
                    while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['r_id'] ?></td>
                            <td><?= htmlspecialchars($row['r_des']) ?></td>
                            <td><?= htmlspecialchars($row['r_goals']) ?></td>
                            <td><?= htmlspecialchars($row['r_email']) ?></td>
                            <td><?= htmlspecialchars($row['r_na']) ?></td>
                            <td><?= htmlspecialchars($row['r_gender']) ?></td>
                            <td><?= htmlspecialchars($row['r_code']) ?></td>
                            <td><?= htmlspecialchars($row['r_sub']) ?></td>
                            <td><?= htmlspecialchars($row['r_food']) ?></td>
                            <td><?= htmlspecialchars($row['r_pet']) ?></td>
                            <td><?= htmlspecialchars($row['r_sport']) ?></td>
                            <td><?= htmlspecialchars($row['r_season']) ?></td>
                            <td><?= htmlspecialchars($row['r_drink']) ?></td>
                            <td><?= htmlspecialchars($row['r_motiv']) ?></td>
                            <td><?= htmlspecialchars($row['r_week']) ?></td>
                            <td><?= htmlspecialchars($row['r_top']) ?></td>
                            <td>
    <div class="action-buttons">
        <a href="view.php?id=<?= $row['r_id'] ?>" class="view">View</a>
        <a href="edit.php?id=<?= $row['r_id'] ?>" class="edit">Edit</a>
        <a href="delete.php?id=<?= $row['r_id'] ?>" class="delete">Delete</a>
    </div>
</td
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="back-button-container">
            <a href="index.php">Add Questions</a>
        </div>
    </div>
</body>
</html>