<?php
session_start();
require 'db.php'; // Ensure this file connects to your database

// Fetch all responses from the database
$sql = "SELECT * FROM tbl_responses ORDER BY k_id ASC"; // Order by ID ascending
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
                        <th>Achievements</th>
                        <th>Relax</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Foods</th>
                        <th>Books</th>
                        <th>Events</th>
                        <th>Vacation</th>
                        <th>Communicate</th>
                        <th>Cuisine</th>
                        <th>Work</th>
                        <th>Stress</th>
                        <th>Relax</th>
                        <th>Goals</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $count = 1; // Start numbering from 1
                    while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['k_id'] ?></td>
                            <td><?= htmlspecialchars($row['k_des']) ?></td>
                            <td><?= htmlspecialchars($row['k_goals']) ?></td>
                            <td><?= htmlspecialchars($row['k_email']) ?></td>
                            <td><?= htmlspecialchars($row['k_na']) ?></td>
                            <td><?= htmlspecialchars($row['k_gender']) ?></td>
                            <td><?= htmlspecialchars($row['k_code']) ?></td>
                            <td><?= htmlspecialchars($row['k_sub']) ?></td>
                            <td><?= htmlspecialchars($row['k_food']) ?></td>
                            <td><?= htmlspecialchars($row['k_pet']) ?></td>
                            <td><?= htmlspecialchars($row['k_sport']) ?></td>
                            <td><?= htmlspecialchars($row['k_season']) ?></td>
                            <td><?= htmlspecialchars($row['k_drink']) ?></td>
                            <td><?= htmlspecialchars($row['k_motiv']) ?></td>
                            <td><?= htmlspecialchars($row['k_week']) ?></td>
                            <td><?= htmlspecialchars($row['k_top']) ?></td>
                            <td>
    <div class="action-buttons">
        <a href="view.php?id=<?= $row['k_id'] ?>" class="view">View</a>
        <a href="edit.php?id=<?= $row['k_id'] ?>" class="edit">Edit</a>
        <a href="delete.php?id=<?= $row['k_id'] ?>" class="delete">Delete</a>
    </div>
</td
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="back-button-container">
            <a href="index.php">Add Another</a>
        </div>
    </div>
</body>
</html>