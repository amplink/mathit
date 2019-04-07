<?php
include_once ('_common.php');

$d_uid = $_GET['d_uid'];
$c_uid = $_GET['c_uid'];

$link = "/api/math/class_stu?client_no=".$_SESSION['client_no']."&d_uid=".$d_uid."&c_uid=".$c_uid;
$r = api_calls_get($link);
for($i=1; $i<count($r); $i++) {
    ?>
        <tr onclick="student_select(<?=$r[$i][0]?>)">
            <td ><input type="checkbox" name="student_list[]" value="<?=$r[$i][2]?>@<?=$r[$i][1]?>" checked><span><?=$r[$i][2]?></span></td>
        </tr>
    <?
}
?>