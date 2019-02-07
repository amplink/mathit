<?php

include_once ('_common.php');

$chk_list = $_POST['answer_chk'];

for($i=0; $i<count($chk_list); $i++) {
    $val = explode("|", $chk_list[$i]);
    $book_type = $val[0];
    $unit = $val[1];
    $grade = $val[2];
    $semester = $val[3];
    $level = $val[4];

    $sql = "delete from `answer_master` where `book_type`='$book_type' and `grade` = '$grade' and `unit` = '$unit' and `semester` = '$semester' and `level` = '$level';";
    sql_query($sql);
}
echo "<script>alert('삭제가 완료되었습니다.');</script>";
echo "<script>location.href='./answer_manegement.php';</script>";
?>