<?php
require('conn.php');
$user_id = $_POST['user_id'];

$sql = "DELETE FROM UsersData WHERE id = $user_id";
if($conn->query($sql))
{
    header("Location: ../pages/_admin/users_data.php");
}