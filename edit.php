<?php
session_start();
require 'db.php';

// Check if an ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request.");
}

$id = $_GET['id'];

// Fetch existing data
$sql = "SELECT * FROM tbl_responses WHERE r_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Record not found.");
}

$row = $result->fetch_assoc();
$stmt->close();

// Handle form submission (Update the record)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $r_des = $_POST['q1'];
    $r_goals = $_POST['q2'];
    $r_email = $_POST['q4'];
    $r_na = $_POST['q3'];
    $r_gender = $_POST['q5'];
    $r_code = $_POST['q6'];

    // Ensure that checkboxes are properly handled
    $r_sub = isset($_POST['q7']) ? implode(", ", $_POST['q7']) : "";
    $r_food = isset($_POST['q8']) ? implode(", ", $_POST['q8']) : "";
    $r_pet = isset($_POST['q9']) ? implode(", ", $_POST['q9']) : "";
    $r_sport = isset($_POST['q10']) ? implode(", ", $_POST['q10']) : "";
    $r_season = isset($_POST['q11']) ? implode(", ", $_POST['q11']) : "";
    $r_drink = isset($_POST['q12']) ? implode(", ", $_POST['q12']) : "";
    $r_motiv = isset($_POST['q13']) ? implode(", ", $_POST['q13']) : ""; 
    $r_week = isset($_POST['q14']) ? implode(", ", $_POST['q14']) : "";  
    $r_top = isset($_POST['q15']) ? implode(", ", $_POST['q15']) : "";  

    $update_sql = "UPDATE tbl_responses SET 
        r_des=?, r_goals=?, r_email=?, r_na=?, r_gender=?, r_code=?, 
        r_sub=?, r_food=?, r_pet=?, r_sport=?, r_season=?, r_drink=?, 
        r_motiv=?, r_week=?, r_top=? WHERE r_id=?";
        
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssssssssssssssi", 
        $r_des, $r_goals, $r_email, $r_na, $r_gender, $r_code, 
        $r_sub, $r_food, $r_pet, $r_sport, $r_season, $r_drink, 
        $r_motiv, $r_week, $r_top, $id);

    if ($update_stmt->execute()) {
        $_SESSION['success'] = "Record updated successfully!";
        header("Location: display.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $update_stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Survey</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
        <h2>Edit Survey Response</h2>
        <form method="post" action="">

            <div class="question-container">
                <label>1. Describe yourself:</label>
                <textarea name="q1"><?= htmlspecialchars($row['r_des']) ?></textarea>
            </div>

            <div class="question-container">
                <label>2. What are your goals?</label>
                <textarea name="q2"><?= htmlspecialchars($row['r_goals']) ?></textarea>
            </div>

            <div class="question-container">
                <label>3. Enter your name:</label>
                <input type="text" name="q3" value="<?= htmlspecialchars($row['r_na']) ?>">
            </div>

            <div class="question-container">
                <label>4. Enter your email:</label>
                <input type="email" name="q4" value="<?= htmlspecialchars($row['r_email']) ?>">
            </div>

            <div class="question-container">
                <label>5. Choose your gender:</label>
                <label><input type="radio" name="q5" value="Male" <?= ($row['r_gender'] === 'Male') ? 'checked' : '' ?>> Male</label>
                <label><input type="radio" name="q5" value="Female" <?= ($row['r_gender'] === 'Female') ? 'checked' : '' ?>> Female</label>
            </div>

            <div class="question-container">
                <label>6. Do you like coding?</label>
                <label><input type="radio" name="q6" value="Yes" <?= ($row['r_code'] === 'Yes') ? 'checked' : '' ?>> Yes</label>
                <label><input type="radio" name="q6" value="No" <?= ($row['r_code'] === 'No') ? 'checked' : '' ?>> No</label>
            </div>

            <?php 
$questions = [ 
    "7. What is your favorite subject?" => ["r_sub", ["IT308", "MS309"]],
    "8. What is your favorite food?" => ["r_food", ["Pizza", "Burger", "Salad", "Chicken"]],
    "9. What is your favorite pet?" => ["r_pet", ["Dog", "Cat", "Bird", "Rabbit"]],
    "10. What is your favorite sport?" => ["r_sport", ["Volleyball", "Badminton", "Basketball"]],
    "11. What is your favorite season?" => ["r_season", ["Winter", "Summer", "Spring"]],
    "12. What do you like to drink?" => ["r_drink", ["Soda", "Juice", "Water"]],
    "13. What motivates you?" => ["r_motiv", ["Success", "Passion", "Money"]],
    "14. What is your favorite day of the week?" => ["r_week", ["Monday", "Friday", "Sunday"]],
    "15. What is your favorite topic?" => ["r_top", ["Tech", "Science", "Art"]]
];

foreach ($questions as $question => $data): 
    list($column_name, $options) = $data; // Extract column name and options
    $selected_values = explode(", ", $row[$column_name] ?? ""); 
?>
    <div class="question-container">
        <label><?= $question ?></label>
        <div class="checkbox-group">
            <?php foreach ($options as $option): ?>
                <label>
                    <input type="checkbox" name="q<?= array_search($question, array_keys($questions)) + 7 ?>[]" 
                        value="<?= $option ?>" 
                        <?= in_array($option, $selected_values) ? 'checked' : '' ?>>
                    <?= $option ?>
                </label>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>