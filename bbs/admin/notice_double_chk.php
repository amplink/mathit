<?php
include_once('_common.php');
$title = $_GET['title'];
$sql = "select * from `notify` where `title`='$title';";
$result = sql_query($sql);
$res = mysqli_fetch_array($result);
if($res['id']) echo "1";
else echo "0";

?>