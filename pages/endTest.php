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

$total = 0;
foreach ($_POST['question'] as $key => $value) {
    $point = mysqli_fetch_assoc($conn->query("SELECT * FROM Answers WHERE id = $key"))['points'];
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
                <p>
                Спасибо за ваши ответы!<br><br>
                Результаты теста:<br><br>
                
                
                
                
                
                
                </p>
            </div>
        </div>
        <div class="mb-3 text-center">
            <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">Узнать больше</button>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Заполните анкету</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="../php/addPerson.php" method="post" class=''>
                <div class="mb-3">
                    <label for="">Фамилия</label>
                    <input class='form-control' type="text" name="last_name">
                </div>
                <div class="mb-3">
                    <label for="">Имя</label>
                    <input class='form-control' type="text" name="first_name">
                </div>
                <div class="mb-3">
                    <label for="">Отчество</label>
                    <input class='form-control' type="text" name="middle_name">
                </div>
                <div class="mb-3">
                    <label for="">Номер телефона</label>
                    <input class='form-control phone' type="text" name="phone">
                </div>
                <div class="mb-3">
                    <label for="">Название компании</label>
                    <input class='form-control' type="text" name="company_name">
                </div>
                <input type="submit" class='btn btn-primary' value="Оставить заявку">
            </form>
          </div>
        </div>
      </div>
    </div>
    <script>
        $(document).ready(() => {
            $('.phone').mask('+7 (000) 000 00-00');
        })
    </script>
</body>
</html>

<?php
function getResult();
?>