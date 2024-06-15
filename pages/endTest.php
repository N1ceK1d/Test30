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
    // echo "Блок: " . $block_name . " - Набранные баллы: " . $scores['total'] . " из " . $scores['max'] . "<br>";
}

// Находим минимальное количество баллов
$min_score = min(array_column($all_block_scores, 'total'));

// Выводим все блоки с минимальным количеством баллов
foreach ($all_block_scores as $block_name => $scores) {
    if ($scores['total'] == $min_score) {
        // echo "Блок с минимальным количеством баллов: " . $block_name . " - Набранные баллы: " . $scores['total'] . " из " . $scores['max'] . "<br>";
    }
}

// Переменная для хранения общего количества баллов
$total_score = 0;

// Перебираем блоки и суммируем баллы
foreach ($all_block_scores as $block_scores) {
    $total_score += $block_scores['total'];
}

// Выводим общее количество баллов

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
</head>
<body class='bg-light'>
    <div class="container">
        <div class="end-test border my-1 mx-auto w-75">
            <div class="header bg-primary text-white text-center p-1">
                <h2>Тест пройден</h2>
            </div>
            <div class="body p-1 bg-white w-100">
                <h2>Тест: Анализ найма и управления персоналом</h2><br>
                <p>Всего: <label class='bg-primary text-white p-1 rounded'><?php echo $total_score ?> / 30</label></p>
                <p>
                Спасибо за ваши ответы!<br><br>
                Результаты теста:<br><br>
                <b>Если у вас 5 баллов и меньше, то:</b><br><br>
                В  компании  плохое  управление  персоналом  и  наймом.  Вам  срочно  нужно  менять  подход. Возможности  роста  и  развития  компании  ограничены.  В  компании  большие  потери  и  недостаток  дохода.<br><br>
                <b>Если у вас 6 - 10 баллов, то:</b><br><br>
                В  компании  слабое  управление  персоналом  и  наймом.  Нужны  безотлагательные  действия  по  улучшению. Компания  теряет  возможности  дохода.<br><br>
                <b>Если у вас 11 - 15 баллов, то:</b><br><br>
                В  компании  трудности  в  управлении  персоналом  и  наймом. Нужно  изменить  подход  к  управлению. Компания  теряет  больше,  чем  могла  бы  зарабатывать.<br><br>
                <b>Если у вас 16-20 баллов, то:</b><br><br>
                В  компании  дела  с  управлением  персоналом  и  наймом  обстоят  не  лучшим  образом.  Компания теряет не  мало  денег  на  недостатках  в  управлении  персоналом. Измените  подход  для  возможности  роста  и  развития  компании.<br><br>
                <b>Если у вас 21 - 25 баллов, то:</b><br><br>
                В  компании  не  плохо  обстоят  дела  с  наймом  и  управлением  персоналом. Но  вы  не  используете  хорошие  возможности  и  инструменты  управления,  которые  могут  значительно  увеличить  компании  доход,  возможности  роста  и  развития.<br><br>
                <b>Если у вас 26 баллов и больше, то:</b><br><br>
                В  вашей  компании  персонал  хорошо  управляем  и  компания  не  испытывает  проблем  с  наймом. На  вас  можно  ровняться  другим!<br><br>
                </p>
            </div>
        </div>
    </div>
</body>
</html>