<?php
require("../php/conn.php");
$decision_id = $_GET['decision_id'];
$decision_data = "SELECT * FROM Decisions WHERE Decisions.id = $decision_id";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Описание решения</title>
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
                <h2>Описание результата</h2>
            </div>
            <div class="body p-1 bg-white w-100">
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
                    <label for="">Имя</label>
                    <input class='form-control' required='true' type="text" name="first_name">
                </div>
                <div class="mb-3">
                    <label for="">Номер телефона</label>
                    <input class='form-control phone' required='true' type="text" name="phone">
                </div>
                <div class="mb-3">
                    <label for="">Количество сотрудников</label>
                    <input class='form-control' required='true' type="number" name="company_name" min='1'>
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