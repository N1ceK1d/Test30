<?php
  require("php/conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тест</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="icon" href="favicon.ico">
</head>
<body>
    <div class="container">
        <div class="test-intro p-1 my-1 mx-auto w-75">
            <form class="test-button text-center" method='POST' action='pages/test.php'>
              <button class='btn btn-primary' data-bs-toggle="modal" data-bs-target="#exampleModal">Начать тест</button>
            </form>
        </div>
    </div>
</body>
</html>