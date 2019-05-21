<?php
include_once ('_common.php');

$chk_list = $_POST['notice_chk'];

for($i=0; $i<count($chk_list); $i++) {
    $sql = "select * from `notify` where `id`='$chk_list[$i]';";
    $result = sql_query($sql);
    $res = mysqli_fetch_array($result);

    if($res['attach_file_url']) {
        unlink($res['attach_file_url'].$res['attach_file']);
        rmdir(substr($res['attach_file_url'],0, -1));
    }

    $sql = "delete from `notify` where `id` = '$chk_list[$i]';";
    sql_query($sql);
    $sql = "delete from `teacher_notice` where `title`='$chk_list[$i]';";
    sql_query($sql);
}
echo "<script>alert('삭제가 완료되었습니다.');</script>";
echo "<script>location.href='./notice_home.php';</script>";

?>