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
    <title>Заявки</title>
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap-icons/font/bootstrap-icons.css">
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../js/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Анализ найма и управления персоналом</h1>
        <h2>Оставленные заявки</h2>
        <?php require("../../php/admin_header.php") ?>
        <div class="questions">
            <form action="../../php/update_questions.php" method="post">
                <?php foreach ($conn->query("SELECT * FROM UsersData ORDER BY user_time DESC") as $row): ?>
                    <div class="question-item border rounded p-1 my-1 bg-light w-75">
                        <h2><?= $row['last_name']." ".$row['first_name']." ".$row['middle_name']; ?></h2>
                        <p>Телефон: <?= $row['phone']; ?></p>
                        <p>Компания: <?= $row['company_name']; ?></p>
                        <i class='bi bi-trash-fill text-danger' role='button' data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="<?php echo $row['id'];?>"></i>
                    </div>
                <?php endforeach; ?>
            </form>
        </div>
    </div>
    <script src="../../js/change_text.js"></script>
</body>
</html>
<!--Modal Start-->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Удаление компании</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../../php/deleteUser.php">
                    <input type="hidden" name="user_id" value="" class='user_id'>
                    <div class="mb-3">
                        <p>Вы уверены, что хотите удалить эту заявку?</p>
                    </div>
                    <button type="submit" class="btn btn-danger">Удалить</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Modal End-->
<script>
    var exampleModal = document.getElementById('exampleModal2')
    exampleModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var recipient = button.getAttribute('data-bs-whatever');

        var modalBodyInput = exampleModal.querySelector('.modal-body #recipient-name ')
        console.log(recipient);
        exampleModal.querySelector('.modal-body .user_id').value = recipient;
    })
</script>