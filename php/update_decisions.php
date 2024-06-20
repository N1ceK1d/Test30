<?php
require('conn.php');

foreach ($_POST['decision'] as $key => $value) {
    $conn->query("UPDATE Decisions SET decision_text = '$value' WHERE id = $key");
}

foreach ($_POST['decision_text'] as $key => $value) {
    $conn->query("UPDATE Decisions SET decision_descriprion = '$value' WHERE id = $key");
}

header("Location: ../pages/_admin/decisions.php");