<?php
include_once ('_common.php');

$d_uid = $_GET['d_uid'];
$c_uid = $_GET['c_uid'];
$s_uid = $_GET['s_uid'];
$d_order = $_GET['d_order'];

$link = "/api/math/class_stu?client_no=".$_SESSION['client_no']."&d_uid=".$d_uid."&c_uid=".$c_uid;
$r = api_calls_get($link);
for($i=1; $i<count($r); $i++) {
    ?>
    <tr onclick="student_select(<?=$r[$i][0]?>);call_homework_list(<?=$d_uid?>, <?=$c_uid?>, <?=$s_uid?>, '<?=$d_order?>', '<?=$r[$i][1]?>')">
        <td ><input type="checkbox" name="student_list[]" value="<?=$r[$i][2]?>@<?=$r[$i][1]?>" checked><span><?=$r[$i][2]?></span></td>
    </tr>
    <?
}
?>