<?php
include_once ('_common.php');

$class = $_GET['class'];

$link = "/api/math/class?client_no=".$_SESSION['client_no'];
$r = api_calls_get($link);

for($i=0; $i<count($r); $i++) {
    if($r[$i][4] == $class) {
        $d_uid = $r[$i][0];
        $c_uid = $r[$i][1];
    }
}

$link = "/api/math/class_stu?client_no=".$_SESSION['client_no']."&d_uid=".$d_uid."&c_uid=".$c_uid;
$r = api_calls_get($link);
for($i=1; $i<count($r); $i++) {
    $k = $i+1;
?>
<tr>
    <td><span><?=$r[$i][2]?></span>
	<input type="hidden" name="student_name[]" value="<?=$r[$i][2]?>">
	<input type="hidden" name="student_id[]" value="<?=$r[$i][1]?>">
	</td>
    <td><input type="text" name="score_add1[]" onchange="set_avg(<?=$i?>)" id="score_add<?=$i?>"><span>점</span></td>
    <td><input type="text" name="score_add2[]" onchange="set_avg(<?=$i?>)" id="score_add<?=$k?>"><span>점</span></td>
    <td><span id="avg<?=$i?>"></span></td>
</tr>
<?php
}
?>