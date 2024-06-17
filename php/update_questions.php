<?php
require('conn.php');

foreach ($_POST['question'] as $key => $value) {
    $conn->query("UPDATE Questions SET question_text = '$value' WHERE id = $key");
}

header("Location: ../pages/_admin/questions.php");