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
    <title>Контакты</title>
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap-icons/font/bootstrap-icons.css">
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../js/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Анализ найма и управления персоналом</h1>
        <h2>Контактные данные</h2>
        <?php require("../../php/admin_header.php") ?>
        <div class="questions">
            <form action="../../php/update_contact.php" method="post">
                <input class='btn btn-primary' type="submit" value="Применить изменения">
                <?php $contacts = mysqli_fetch_assoc($conn->query("SELECT * FROM Company_Info")); ?>
                    <div class="question-item border rounded p-1 my-1 bg-light">
                        <h2>Контактные данные</h2>
                        <div class="mb-3">
                            <label>Телефон:</label>
                            <input class='form-control text_value my-1 w-25' readonly='true' value='<?= $contacts['phone'] ?>' name='phone' />
                        </div>
                        <div class="mb-3">
                            <label>WhatsApp:</label>
                            <input class='form-control text_value my-1 w-25' readonly='true' value='<?= $contacts['whats_app'] ?>' name='whatsapp' />
                        </div>
                        <div class="mb-3">
                            <label>Telegramm:</label>
                            <input class='form-control text_value my-1 w-25' readonly='true' value='<?= $contacts['tg_link'] ?>' name='tg' />
                        </div>
                        <i class="bi bi-pencil-fill text-primary change_text" role='button'></i>
                    </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(() => {
            $('.questions').on('click', (event) => {
                if($(event.target).hasClass('change_text')) {
                    let question_input = $(event.target).siblings('.mb-3').children('input');
                    question_input.attr('readonly', !question_input.attr('readonly'));
                    if(!question_input.attr('readonly')) {
                        $(event.target).addClass('text-danger');
                        $(event.target).removeClass('text-primary');
                        question_input.addClass('border border-primary');
                    } else {
                        $(event.target).addClass('text-primary');
                        $(event.target).removeClass('text-danger');
                        question_input.removeClass('border border-primary');
                    }
                }
            })
        })
    </script>
</body>
</html>