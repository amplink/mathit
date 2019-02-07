<?php

$user_id = $_POST['user_id'];
$user_pw = $_POST['user_pw'];



session_start();
$_SESSION['uid'] = $user_id;

?>
<!--<meta http-equiv='refresh' content='0;url=index.php'>-->