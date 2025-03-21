<?php
session_start(); 
require 'db.php'; // Database connection

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate text areas
    if (empty($_POST['q1']) || preg_match('/[0-9]/', $_POST['q1'])) {
        $errors['q1'] = "Question 1 must not contain any numbers.";
    }
    if (empty($_POST['q2']) || preg_match('/[0-9]/', $_POST['q2'])) {
        $errors['q2'] = "Question 2 must not contain any numbers.";
    }

    // Validate text fields
    if (empty($_POST['q3']) || preg_match('/[0-9]/', $_POST['q3'])) {
        $errors['q3'] = "Question 3 must not contain numbers.";
    }

    if (empty($_POST['q4']) || !filter_var($_POST['q4'], FILTER_VALIDATE_EMAIL)) {
        $errors['q4'] = "Question 4 must be a valid email address.";
    }
    
    // Validate radio buttons
    if (empty($_POST['q5'])) {
        $errors['q5'] = "Please select an option for Question 5.";
    }
    if (empty($_POST['q6'])) {
        $errors['q6'] = "Please select an option for Question 6.";
    }

    // Validate single selection checkboxes
    for ($i = 7; $i <= 15; $i++) {
        if (empty($_POST["q$i"]) || !is_array($_POST["q$i"]) || count($_POST["q$i"]) > 1) {
            $errors["q$i"] = "Select only one option for Question $i.";
        }
    }
    
    if (empty($errors)) {
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO tbl_responses (k_des, k_goals, k_email, k_na, k_gender, k_code, k_sub, k_food, k_pet, k_sport, k_season, k_drink, k_motiv, k_week, k_top) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sssssssssssssss",
            $_POST['q1'], $_POST['q2'], $_POST['q4'], $_POST['q3'], $_POST['q5'], $_POST['q6'],
            $_POST['q7'][0], $_POST['q8'][0], $_POST['q9'][0], $_POST['q10'][0], $_POST['q11'][0],
            $_POST['q12'][0], $_POST['q13'][0], $_POST['q14'][0], $_POST['q15'][0]
        );

        if ($stmt->execute()) {
            $_SESSION['success'] = "Survey submitted successfully!";
            header("Location: display.php");
            exit();
        } else {
            $errors['db'] = "Error saving data. Please try again.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Survey Form</h2>
        <?php if (!empty($errors['db'])): ?>
            <p class="error"><?= $errors['db'] ?></p>
        <?php endif; ?>

        <form method="post" action="">
            <div class="question-container">
                <label>1. What is one achievement you are most proud of?</label>
                <textarea name="q1"><?= htmlspecialchars($_POST['q1'] ?? '') ?></textarea>
                <span class="error"><?= $errors['q1'] ?? '' ?></span>
            </div>

            <div class="question-container">
                <label>2. What is your favorite way to relax?</label>
                <textarea name="q2"><?= htmlspecialchars($_POST['q2'] ?? '') ?></textarea>
                <span class="error"><?= $errors['q2'] ?? '' ?></span>
            </div>

            <div class="question-container">
                <label>3. Enter your name:</label>
                <input type="text" name="q3" value="<?= htmlspecialchars($_POST['q3'] ?? '') ?>">
                <span class="error"><?= $errors['q3'] ?? '' ?></span>
            </div>

            <div class="question-container">
    <label>4. Enter your email:</label>
    <input type="email" name="q4" value="<?= htmlspecialchars($_POST['q4'] ?? '') ?>">
    <div class="error"><?= $errors['q4'] ?? '' ?></div>
</div>

<div class="question-container">
    <label>5. Choose your gender:</label>
    <div class="radio-group">
        <label><input type="radio" name="q5" value="Male" <?= (isset($_POST['q5']) && $_POST['q5'] === 'Male') ? 'checked' : '' ?>> Male</label>
        <label><input type="radio" name="q5" value="Female" <?= (isset($_POST['q5']) && $_POST['q5'] === 'Female') ? 'checked' : '' ?>> Female</label>
    </div>
    <div class="error"><?= $errors['q5'] ?? '' ?></div>
</div>

<div class="question-container">
    <label>6. Do you enjoy trying new foods?</label>
    <div class="radio-group">
        <label><input type="radio" name="q6" value="Yes" <?= (isset($_POST['q6']) && $_POST['q6'] === 'Yes') ? 'checked' : '' ?>> Yes</label>
        <label><input type="radio" name="q6" value="No" <?= (isset($_POST['q6']) && $_POST['q6'] === 'No') ? 'checked' : '' ?>> No</label>
    </div>
    <div class="error"><?= $errors['q6'] ?? '' ?></div>
</div>


            <?php 
            $questions = [
      "7. What is your favorite book genre?" => ["Fiction", "Non-Fiction", "Mystery", "Fantasy"],
      "8. How do you stay informed about current events?" => ["News Websites", "Social Media", "TV", "Podcasts"],
      "9. What is your dream vacation destination?" => ["Beach", "Mountains", "City", "Countryside"],
      "10. How do you prefer to communicate?" => ["Text", "Phone Call", "Email", "In-Person"],
      "11. What is your favorite type of cuisine?" => ["Italian", "Chinese", "Mexican", "Indian"],
      "12. How do you feel about remote work?" => ["Prefer it", "Neutral", "Dislike it", "No experience"],
      "13, is your biggest source of stress?" => ["Work", "Relationships", "Finances", "Health"],
      "14. What is your favorite way to relax?" => ["Meditation", "Watching TV", "Reading", "Spending time with family"],
      "15. What motivates you to achieve your goals?" => ["Personal Growth", "Financial Stability", "Recognition", "Helping Others"]
            ];

            $q_num = 7;
            foreach ($questions as $q_text => $options): ?>
                <div class="question-container">
                    <label><?= $q_text ?></label>
                    <div class="checkbox-group">
                        <?php foreach ($options as $option): ?>
                            <label>
                                <input type="checkbox" name="q<?= $q_num ?>[]" value="<?= $option ?>" <?= (isset($_POST["q$q_num"]) && in_array($option, $_POST["q$q_num"])) ? 'checked' : '' ?>>
                                <span><?= $option ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                    <span class="error"><?= $errors["q$q_num"] ?? '' ?></span>
                </div>
            <?php $q_num++; endforeach; ?>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>