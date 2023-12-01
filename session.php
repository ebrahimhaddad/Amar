<?php
include 'config.php';
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location:login.php");
    die();
}
$user_check = $_SESSION['login_user'];

$ses_sql = mysqli_query($db, "SELECT name, active, id from admin where username = '$user_check' ");
$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

$login_session = $row['name'];
$login_active = $row['active'];
$login_id = $row['id'];
?>