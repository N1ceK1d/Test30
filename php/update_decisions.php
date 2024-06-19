<?php
require('conn.php');

foreach ($_POST['decision'] as $key => $value) {
    $conn->query("UPDATE Decisions SET decision_text = '$value' WHERE id = $key");
}

header("Location: ../pages/_admin/decisions.php");