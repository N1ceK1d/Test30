<?php
require('conn.php');

$first_name = $_POST['first_name'];
$phone = $_POST['phone'];
$employees_count = isset($_POST['employees_count']) ? $_POST['employees_count'] : 0 ;

$sql = "INSERT INTO UsersData (first_name, phone, employees_count, user_time)
VALUES ('$first_name', '$phone', $employees_count, NOW())";

if($conn->query($sql))
{
    header("Location: ../pages/end.php"); 
}
?>