<?php
require("conn.php");
$decision_id = $_POST['decision_id'];
$target_directory = "../files/files_$decision_id/";

if ($_FILES && $_FILES["filename"]["error"] == UPLOAD_ERR_OK) {
    if (!file_exists($target_directory)) {
        mkdir($target_directory, 0777, true); // Создаем папку, если она не существует
    }

    $target_file = $target_directory . basename($_FILES["filename"]["name"]);
    if (!file_exists($target_file)) {
        $name = $_FILES["filename"]["name"];
        if ($conn->query("INSERT INTO Decisions_File (file_name, decision_id) VALUES ('$name', $decision_id)")) {
            move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file);
            header("Location: ../pages/_admin/decisions.php");
        }
    } else {
        echo "File exist";
        header("Location: ../pages/_admin/decisions.php?error=1");
    }
}
?>
