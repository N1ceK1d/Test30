<?php
require("conn.php");
if(isset($_POST['phone']))
{
    $conn->query("UPDATE Company_Info SET phone = '{$_POST['phone']}'");
}
if(isset($_POST['whatsapp']))
{
    $conn->query("UPDATE Company_Info SET whats_app = '{$_POST['whatsapp']}'");
}
if(isset($_POST['tg_link']))
{
    $conn->query("UPDATE Company_Info SET tg_link = '{$_POST['tg_link']}'");
}
header("Location: ../pages/_admin/contacts.php");