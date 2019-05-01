<?php
include_once ('_common.php');
$seq = $_POST['no'];

$sql = "DELETE FROM upload_photo WHERE seq = $seq AND student_id = '$_SESSION[s_id]'";
mysqli_query($connect_db, $sql);
