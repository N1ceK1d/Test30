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
    $block_name = $block['name'];
    $scores = getBlockScores($block_id, $conn);
    $all_block_scores[$block_name] = $scores;
    // Выводим результаты по каждому блоку
    echo "Блок: " . $block_name . " - Набранные баллы: " . $scores['total'] . " из " . $scores['max'] . "<br>";
}

// Находим минимальное количество баллов
$min_score = min(array_column($all_block_scores, 'total'));

// Выводим все блоки с минимальным количеством баллов
foreach ($all_block_scores as $block_name => $scores) {
    if ($scores['total'] == $min_score) {
        echo "Блок с минимальным количеством баллов: " . $block_name . " - Набранные баллы: " . $scores['total'] . " из " . $scores['max'] . "<br>";
    }
}

// Переменная для хранения общего количества баллов
$total_score = 0;

// Перебираем блоки и суммируем баллы
foreach ($all_block_scores as $block_scores) {
    $total_score += $block_scores['total'];
}

// Выводим общее количество баллов
echo "Общее количество баллов: " . $total_score . "<br>";
?>
