<?php
include_once ('_common.php');

$sql = "select * from `answer_master` where `book_type`='$book_type' and `grade` = '$grade' and `unit` = '$unit' and `semester` = '$semester' and `level` = '$level';";
$result = mysqli_query($connect_db, $sql);
$res = mysqli_fetch_array($result);

if($res) {
    echo 1;
}else {
    echo 0;
}

?>