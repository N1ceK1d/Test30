<?php
require("../php/conn.php");
$decision_id = $_GET['decision_id'];
$decision_data = mysqli_fetch_assoc($conn->query("SELECT * FROM Decisions WHERE id = $decision_id"));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Описание решения</title>
    <link rel="icon" href="../favicon.ico">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap-icons/font/bootstrap-icons.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../js/jquery.mask.js"></script>
</head>
<body class='bg-light'>
<div class="container">
        <div class="end-test border my-1 mx-auto w-75">
            <div class="header bg-primary text-white text-center p-1">
                <h2>Описание результата</h2>
            </div>
            <div class="body p-1 bg-white w-100">
                <p><?= $decision_data['decision_text']; ?></p>
                <hr>
                <p><?= $decision_data['decision_descriprion']; ?></p>
                <hr>
                <?php
                $files = $conn->query("SELECT * FROM Decisions_File WHERE decision_id = {$decision_data['id']}");
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
            <p class='text-center'>Или вы можете позвонить нам по телефону <a href="tel:+7 (000)000 00-00">+7 (000)000 00-00</a></p>
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
                    <label for="">Имя</label>
                    <input class='form-control' required='true' type="text" name="first_name">
                </div>
                <div class="mb-3">
                    <label for="">Номер телефона</label>
                    <input class='form-control phone' required='true' type="text" name="phone">
                </div>
                <div class="mb-3">
                    <label for="">Количество сотрудников</label>
                    <input class='form-control' required='true' type="number" name="employees_count" min='1'>
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