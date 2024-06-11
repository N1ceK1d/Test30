<?php
  require("php/conn.php");
  $res = mysqli_fetch_assoc($conn->query("SELECT * FROM Companies LIMIT 1"));

  $company_id = $res['id'];

  if(isset($_GET['company_id']))
  {
    $company_id = base64_decode($_GET['company_id']);
  }
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