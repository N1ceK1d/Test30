<?php
require("conn.php");
$file_id = $_POST['file_id'];

foreach ($conn->query("SELECT * FROM Decisions_File WHERE id = $file_id") as $row) {
    // Проверяем, существует ли файл
    if (file_exists("../files/".$row['file_name'])) {
        // Пытаемся удалить файл
        if (unlink("../files/".$row['file_name'])) {
            echo "Файл успешно удален.";
        } else {
            echo "Ошибка при удалении файла.";
        }
    } else {
        echo "Файл не найден.";
    }
}

if($conn->query("DELETE FROM Decisions_File WHERE id = $file_id"))
{
    header("Location: ../pages/_admin/decisions.php");
}