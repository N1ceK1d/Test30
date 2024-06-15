<?php
    require("php/conn.php");
    $questions = $conn->query("SELECT * FROM Questions;");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Анализ найма и управления персоналом</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Анализ найма и управления персоналом</h1>
    <div id="liveAlertPlaceholder"></div>
        <form class="questions mx-auto p-1" method='POST' action='pages/endTest.php'>
            <?php foreach($questions as $question):?>
                <div class="question bg-light border rounded p-1 w-75 my-1">
                    <p class='question-text'><b><?= $question['id'] ?>. </b><?= $question['question_text'] ?></p>
                    <div class="answers row">
                        <?php foreach ($conn->query("SELECT * FROM Answers WHERE question_id = ".$question['id']." ORDER BY id;") as $answer):?>
                            <div class="answer-item">
                                <input type="radio" class='check_input' name="question[<?= $question['id'] ?>]" value="<?= $answer['id'] ?>">
                                <label><?= $answer['answer_text'] ?> (<?= $answer['points'] ?>)</label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <input class='end_test_btn btn btn-primary' type="button" value="Закончить тест">
        </form>
    </div>
    <script src="js/test.js"></script>
</body>
</html>