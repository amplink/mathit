<?php
include_once ('_common.php');
?>
<table>
    <thead>
    <tr>
        <th>학생명</th>
        <th>1회</th>
        <th>2회</th>
        <th>3회</th>
        <th>총점</th>
    </tr>
    </thead>
    <tbody>
<?php
$d_uid = $_GET['d_uid'];
$c_uid = $_GET['c_uid'];

$link = "/api/math/class_stu?client_no=".$_SESSION['client_no']."&d_uid=".$d_uid."&c_uid=".$c_uid;
$r = api_calls_get($link);
for($i=1; $i<count($r); $i++) {
    $k = $i + 1;
    $kk = $k + 1;
    ?>
        <tr>
            <td><span><?=$r[$i][2]?></span>
                <input type="hidden" name="student_name[]" value="<?=$r[$i][2]?>">
                <input type="hidden" name="student_id[]" value="<?=$r[$i][1]?>">
            </td>
            <td><input type="text" name="score_add1[]" onchange="set_plus(<?=$i?>)" id="score_add<?=$i?>"><span>점</span></td>
            <td><input type="text" name="score_add2[]" onchange="set_plus(<?=$i?>)" id="score_add<?=$k?>"><span>점</span></td>
            <td><input type="text" name="score_add3[]" onchange="set_plus(<?=$i?>)"  style="width: 100px;" id="score_add<?=$kk?>"><span>점</span></td>
            <td><span id="plus<?=$i?>"></span></td>
        </tr>
    <?php
}
?>
    </tbody>
</table>
