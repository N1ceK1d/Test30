<?php
session_start();
session_destroy();
$admin = $_GET['admin'];

header("Location: ../pages/_admin/login.php");
