<?php
require('conn.php');

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$middle_name = $_POST['middle_name'];
$phone = $_POST['phone'];
$company_name = $_POST['company_name'];

$sql = "INSERT INTO UsersData (first_name, last_name, middle_name, phone, company_name, user_time)
VALUES ('$first_name', '$last_name', '$middle_name', '$phone', '$company_name', NOW())";

if($conn->query($sql))
{
    header("Location: ../pages/endTest.php"); 
}
?>