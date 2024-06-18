<?php
    session_start();
    if(!isset($_SESSION['admin_id']))
    {
        header("Location: login.php");
    }
    require("../../php/conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вопросы</title>
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap-icons/font/bootstrap-icons.css">
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../js/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Анализ найма и управления персоналом</h1>
        <h2>Вопросы</h2>
        <?php require("../../php/admin_header.php") ?>
        <div class="questions">
            <form action="../../php/update_questions.php" method="post">
                <input class='btn btn-primary' type="submit" value="Применить изменения">
                <?php foreach ($conn->query("SELECT * FROM Questions") as $row): ?>
                    <div class="question-item border rounded p-1 my-1 bg-light">
                        <h2>Вопрос №<?= $row['id'] ?></h2>
                        <input class='form-control text_value' readonly='true' value='<?= $row['question_text'] ?>' name='question[<?= $row['id'] ?>]' />
                        <i class="bi bi-pencil-fill text-primary change_text" role='button'></i>
                    </div>
                <?php endforeach; ?>
                <input class='btn btn-primary' type="submit" value="Применить изменения">
            </form>
        </div>
    </div>
    <script src="../../js/change_text.js"></script>
</body>
</html>