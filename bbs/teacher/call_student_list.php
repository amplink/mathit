<?php
include_once ('_common.php');

$class = $_GET['class'];

$link = "/api/math/class?client_no=".$_SESSION['client_no'];
$r = api_calls_get($link);

$cnt = 0;
for($i=0; $i<count($r); $i++) {
    if($r[$i][4] == $class) {
        $d_uid[$cnt] = $r[$i][0];
        $c_uid[$cnt] = $r[$i][1];
        $s_uid[$cnt] = $r[$i][2];
        $d_n[$cnt] = $r[$i][5];
        $cnt++;
    }
}

for($i=0; $i<$cnt; $i++) {
    $k = $i+1;
    ?>
    <tr onclick="call_student_form(<?=$d_uid[$i]?>, <?=$c_uid[$i]?>, <?=$s_uid[$i]?>, '<?=$d_n[$i]?>')">
        <td><?=$k?></td>
        <td><?=$d_n[$i]?></td>
        <td><?=$_SESSION['t_name']?></td>
    </tr>
    <?php
}
?>
<script>
    $('.class_select_box table tbody tr').click(function () {
        if ($(this).hasClass('on') === true) {
            $(this).removeClass('on')
        } else {
            $(this).addClass('on');
            $('.class_select_box table tbody tr').not(this).removeClass('on');
        }
    })
</script>