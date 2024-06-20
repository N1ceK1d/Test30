<?php
require("../php/conn.php");

// Функция для получения общего количества баллов и максимально возможных баллов по блоку
function getBlockScores($block_id, $conn) {
    $block_scores = ['total' => 0, 'max' => 0];
    // Получаем все вопросы для блока
    $questions = $conn->query("SELECT question_id FROM QuestionsBlocks WHERE block_id = " . $block_id);
    while ($question = mysqli_fetch_assoc($questions)) {
        // Для каждого вопроса получаем выбранный ответ
        $selected_answer_id = $_POST['question'][$question['question_id']];
        // Получаем баллы для выбранного ответа
        $answer = $conn->query("SELECT points FROM Answers WHERE id = " . $selected_answer_id);
        if ($answer_row = mysqli_fetch_assoc($answer)) {
            // Суммируем баллы
            $block_scores['total'] += $answer_row['points'];
        }
    }
    // Получаем максимально возможные баллы для блока
    $max_points_query = $conn->query("SELECT max_points FROM Blocks WHERE id = " . $block_id);
    if ($max_points_row = mysqli_fetch_assoc($max_points_query)) {
        $block_scores['max'] = $max_points_row['max_points'];
    }
    return $block_scores;
}

// Массив для хранения баллов всех блоков
$all_block_scores = [];

// Подсчет результатов для каждого блока и заполнение массива
$blocks = $conn->query("SELECT * FROM Blocks");
while ($block = mysqli_fetch_assoc($blocks)) {
    $block_id = $block['id'];
    $scores = getBlockScores($block_id, $conn);
    $all_block_scores[$block_id] = $scores; // Используем id в качестве ключа массива
    // Выводим результаты по каждому блоку
    // echo "Блок: " . $block_id . " - Набранные баллы: " . $scores['total'] . " из " . $scores['max'] . "<br>";
}

// Находим минимальное количество баллов
$min_score = min(array_column($all_block_scores, 'total'));

// // Выводим все блоки с минимальным количеством баллов
// foreach ($all_block_scores as $block_name => $scores) {
//     if ($scores['total'] == $min_score) {
//         echo "Блок с минимальным количеством баллов: " . $block_name . " - Набранные баллы: " . $scores['total'] . " из " . $scores['max'] . "<br>";
//     }
// }

// Переменная для хранения общего количества баллов
$total_score = 0;

// Перебираем блоки и суммируем баллы
foreach ($all_block_scores as $block_scores) {
    $total_score += $block_scores['total'];
}

// Выводим общее количество баллов

$total = 0;
foreach ($_POST['question'] as $key => $value) {
    $point = mysqli_fetch_assoc($conn->query("SELECT * FROM Answers WHERE id = $value"))['points'];
    $total += $point;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Конец теста</title>
    <link rel="icon" href="../favicon.ico">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../js/jquery.mask.js"></script>
</head>
<body class='bg-light'>
    <div class="container">
        <div class="end-test border my-1 mx-auto w-75">
            <div class="header bg-primary text-white text-center p-1">
                <h2>Тест пройден</h2>
            </div>
            <div class="body p-1 bg-white w-100">
                <h2>Тест: Анализ найма и управления персоналом</h2><br>
                <p>Всего: <label class='bg-primary text-white p-1 rounded'><?php echo $total ?> / 30</label></p>
                <p>Спасибо за ваши ответы!</p>
                <p><b>Результаты теста:</b></p>
                <?php foreach ($all_block_scores as $block_name => $scores) : ?>
                    <?php if ($scores['total'] == $min_score) :?>
                        <div class="result-item bg-light border rounded p-1 my-1">
                            <?php $res = mysqli_fetch_assoc($conn->query("SELECT * FROM ResultsTexts INNER JOIN Blocks ON ResultsTexts.id = Blocks.id WHERE Blocks.id = $block_name"));?>
                            <p><?= $res['result_text']; ?></p>
                        </div>
                    <?php endif; ?>
                <?php endforeach;?>
                <p><b>Возможные решения:</b></p>
                <?php foreach ($all_block_scores as $block_name => $scores) : ?>
                    <?php if ($scores['total'] == $min_score) :?>
                        <div class="result-item bg-light border rounded p-1 my-1">
                            <?php $res = mysqli_fetch_assoc($conn->query("SELECT *, Decisions.id as decision_id FROM Decisions INNER JOIN Blocks ON Decisions.id = Blocks.id WHERE Blocks.id = $block_name"));?>
                            <p><?= $res['decision_text']; ?></p>
                            <a href="about_decisions.php?decision_id=<?= $res['decision_id']; ?>">Подробнее</a>
                        </div>
                    <?php endif; ?>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</body>
</html>