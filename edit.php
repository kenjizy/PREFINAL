<?php
session_start();
require 'db.php';

// Check if an ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request.");
}

$id = $_GET['id'];

// Fetch existing data
$sql = "SELECT * FROM tbl_responses WHERE k_id = ?";
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
    $k_des = $_POST['q1'];
    $k_goals = $_POST['q2'];
    $k_email = $_POST['q4'];
    $k_na = $_POST['q3'];
    $k_gender = $_POST['q5'];
    $k_code = $_POST['q6'];

    // Ensure that checkboxes are properly handled
    $k_sub = isset($_POST['q7']) ? implode(", ", $_POST['q7']) : "";
    $k_food = isset($_POST['q8']) ? implode(", ", $_POST['q8']) : "";
    $k_pet = isset($_POST['q9']) ? implode(", ", $_POST['q9']) : "";
    $k_sport = isset($_POST['q10']) ? implode(", ", $_POST['q10']) : "";
    $k_season = isset($_POST['q11']) ? implode(", ", $_POST['q11']) : "";
    $k_drink = isset($_POST['q12']) ? implode(", ", $_POST['q12']) : "";
    $k_motiv = isset($_POST['q13']) ? implode(", ", $_POST['q13']) : ""; 
    $k_week = isset($_POST['q14']) ? implode(", ", $_POST['q14']) : "";  
    $k_top = isset($_POST['q15']) ? implode(", ", $_POST['q15']) : "";  

    $update_sql = "UPDATE tbl_responses SET 
        k_des=?, k_goals=?, k_email=?, k_na=?, k_gender=?, k_code=?, 
        k_sub=?, k_food=?, k_pet=?, k_sport=?, k_season=?, k_drink=?, 
        k_motiv=?, k_week=?, k_top=? WHERE k_id=?";
        
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssssssssssssssi", 
        $k_des, $k_goals, $k_email, $k_na, $k_gender, $k_code, 
        $k_sub, $k_food, $k_pet, $k_sport, $k_season, $k_drink, 
        $k_motiv, $k_week, $k_top, $k_id);

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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Survey Response</h2>
        <form method="post" action="">

            <div class="question-container">
                <label>1. What is one achievement you are most proud of?</label>
                <textarea name="q1"><?= htmlspecialchars($row['k_des']) ?></textarea>
            </div>

            <div class="question-container">
                <label>2. What is your favorite way to relax?</label>
                <textarea name="q2"><?= htmlspecialchars($row['k_goals']) ?></textarea>
            </div>

            <div class="question-container">
                <label>3. Enter your name:</label>
                <input type="text" name="q3" value="<?= htmlspecialchars($row['k_na']) ?>">
            </div>

            <div class="question-container">
                <label>4. Enter your email:</label>
                <input type="email" name="q4" value="<?= htmlspecialchars($row['k_email']) ?>">
            </div>

            <div class="question-container">
                <label>5. Choose your gender:</label>
                <label><input type="radio" name="q5" value="Male" <?= ($row['k_gender'] === 'Male') ? 'checked' : '' ?>> Male</label>
                <label><input type="radio" name="q5" value="Female" <?= ($row['k_gender'] === 'Female') ? 'checked' : '' ?>> Female</label>
            </div>

            <div class="question-container">
                <label>6. Do you enjoy trying new foods?</label>
                <label><input type="radio" name="q6" value="Yes" <?= ($row['k_code'] === 'Yes') ? 'checked' : '' ?>> Yes</label> 
                <label><input type="radio" name="q6" value="No" <?= ($row['k_code'] === 'No') ? 'checked' : '' ?>> No</label>
            </div>

            <?php 
$questions = [ 
    "7. What is your favorite book genre?" => ["k_sub", ["Fiction", "Non-Fiction", "Mystery", "Fantasy"]],
    "8. How do you stay informed about current events?" => ["k_food", ["News Websites", "Social Media", "TV", "Podcasts"]],
    "9. What is your dream vacation destination?" => ["k_pet", ["Beach", "Mountains", "City", "Countryside"]],
    "10. How do you prefer to communicate?" => ["k_sport", ["Text", "Phone Call", "Email", "In-Person"]],
    "11. What is your favorite type of cuisine?" => ["k_season", ["Italian", "Chinese", "Mexican", "Indian"]],
    "12. How do you feel about remote work?" => ["k_drink", ["Prefer it", "Neutral", "Dislike it", "No experience"]],
    "13. is your biggest source of stress?" => ["k_motiv", ["Work", "Relationships", "Finances", "Health"]],
    "14. What is your favorite way to relax?" => ["k_week", ["Meditation", "Watching TV", "Reading", "Spending time with family"]],
    "15. What motivates you to achieve your goals?" => ["k_top", ["Personal Growth", "Financial Stability", "Recognition", "Helping Others"]]
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