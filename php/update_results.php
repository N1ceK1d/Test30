<?php
require('conn.php');

foreach ($_POST['result'] as $key => $value) {
    $conn->query("UPDATE ResultsTexts SET result_text = '$value' WHERE id = $key");
}

header("Location: ../pages/_admin/results.php");