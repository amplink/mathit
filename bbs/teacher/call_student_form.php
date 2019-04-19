<?php
include_once ('_common.php');
?>
    <table>
    <thead>
    <tr>
        <th>학생명</th>
        <th>1회</th>
        <th>2회</th>
        <th>평균 점수</th>
    </tr>
    </thead>
    <tbody>
<?php
$d_uid = $_GET['d_uid'];
$c_uid = $_GET['c_uid'];

$link = "/api/math/class_stu?client_no=".$_SESSION['client_no']."&d_uid=".$d_uid."&c_uid=".$c_uid;
$r = api_calls_get($link);
$cnt = 1;
for($i=1; $i<count($r); $i++) {
    $k = $cnt;
?>
        <tr>
            <td><span><?=$r[$i][2]?></span>
                <input type="hidden" name="student_name[]" value="<?=$r[$i][2]?>">
                <input type="hidden" name="student_id[]" value="<?=$r[$i][1]?>">
            </td>
            <td><input type="text" name="score_add1[]" onchange="set_avg1(<?=$k?>)" id="score_add<?=$cnt?>"><span>점</span></td>
            <?php
            $cnt++;
            ?>
            <td><input type="text" name="score_add2[]" onchange="set_avg1(<?=$k?>)" id="score_add<?=$cnt?>"><span>점</span></td>
            <td><span id="avg<?=$i?>"></span></td>
        </tr>
<?php
    $cnt++;
}
?>
    </tbody>
</table>
