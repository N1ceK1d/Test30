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
    <title>Результаты</title>
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap-icons/font/bootstrap-icons.css">
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../js/jquery-3.7.1.min.js"></script>
    <style>
        textarea {
            resize: none; /* Запрещаем изменять размер */
        } 
    </style>
</head>
<body>
    <div class="container">
        <h1>Анализ найма и управления персоналом</h1>
        <h2>Решения</h2>
        <?php require("../../php/admin_header.php") ?>
        <div class="questions">
            <form action="../../php/update_decisions.php" method="post">
                <input class='btn btn-primary' type="submit" value="Применить изменения">
                <?php foreach ($conn->query("SELECT *, Decisions.id as decision_id FROM Decisions INNER JOIN Blocks on Decisions .block_id = Blocks.id;") as $row): ?>
                    <div class="question-item border rounded p-1 my-1 bg-light">
                        <p><b><?= $row['name'] ?></b></p>
                        <p><b>Название решения</b></p>
                        <textarea type='area' class='form-control text_value' readonly='true' name='decision[<?= $row['decision_id'] ?>]'><?= $row['decision_text'] ?></textarea>
                        <p><b>Описание решения</b></p>
                        <textarea type='area' class='form-control text_value' readonly='true' name='decision_text[<?= $row['decision_id'] ?>]'><?= $row['decision_descriprion'] ?></textarea>
                        <i class="bi bi-pencil-fill text-primary change_text" role='button'></i>
                        <!-- Добавляем вывод файлов -->
                        <p><b>Файлы</b></p>
                        <div class="files row w-100 mx-auto">
                            <?php
                            $files = $conn->query("SELECT * FROM Decisions_File WHERE decision_id = {$row['decision_id']}");
                            foreach ($files as $file):
                                $file_extension = pathinfo($file['file_name'], PATHINFO_EXTENSION);
                                $icon_class = 'bi-file-earmark'; // Класс иконки по умолчанию
                                if ($file_extension == 'pptx') {
                                    $icon_class = 'bi-file-earmark-ppt';
                                } elseif ($file_extension == 'docx') {
                                    $icon_class = 'bi-file-earmark-word';
                                }
                                // И так далее для других типов файлов
                            ?>
                                <div class="file-item border col-2 text-center">
                                    <i class="bi <?= $icon_class ?> text-center"></i>
                                    <br>
                                    <a href="../../files/<?= $file['file_name'] ?>" download="<?= $file['file_name'] ?>">
                                        <span><?= $file['file_name'] ?></span>
                                    </a>
                                    <br>
                                    <i class="bi bi-trash-fill text-danger" role='button' data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="<?php echo $file['id'];?>"></i>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class='btn btn-primary my-1' type='button' data-bs-toggle="modal" data-bs-target="#exampleModal3" data-bs-whatever="<?php echo $row['decision_id'];?>">Загрузить файлы</button>
                        <!-- Конец вывода файлов -->
                    </div>
                <?php endforeach; ?>
                <input class='btn btn-primary' type="submit" value="Применить изменения">
            </form>
        </div>
    </div>
    <!--Modal Start-->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Удаление компании</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../../php/deleteFile.php">
                        <input type="hidden" name="file_id" value="" class='file_id'>
                        <div class="mb-3">
                            <p>Вы уверены, что хотите удалить этот файл?</p>
                        </div>
                        <button type="submit" class="btn btn-danger">Удалить</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Modal End-->
    <!--Modal Start-->
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Удаление компании</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../../php/add_files.php" enctype="multipart/form-data">
                        <input type="hidden" name="decision_id" value="" class='decision_id'>
                        <input type="file" class='form-control my-1' name="filename" id="">
                        <button type="submit" class="btn btn-primary">Загрузить</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Modal End-->
    <script src="../../js/change_text.js"></script>
    <script>
        var exampleModal = document.getElementById('exampleModal2')
        exampleModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var recipient = button.getAttribute('data-bs-whatever');

            var modalBodyInput = exampleModal.querySelector('.modal-body #recipient-name ')
            console.log(recipient);
            exampleModal.querySelector('.modal-body .file_id').value = recipient;
        })

        var exampleModal2 = document.getElementById('exampleModal3')
        exampleModal2.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var recipient = button.getAttribute('data-bs-whatever');

            var modalBodyInput = exampleModal2.querySelector('.modal-body #recipient-name ')
            console.log(recipient);
            exampleModal2.querySelector('.modal-body .decision_id').value = recipient;
        })
    </script>
</body>
</html>
