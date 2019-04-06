<?php
include_once ('_common.php');
$ac = $_SESSION['client_no'];
$link = "/api/math/teacher_class?client_no=".$ac."&t_uid=".$_SESSION['t_uid']."&date=".$date;
$r = api_calls_get($link);

$d_uid = array();
$c_uid = array();
$chk = 0;
$cnt = 0;
for($i=1; $i<count($r); $i++) {
    $chk = 0;
    for($j=0; $j<count($d_uid); $j++) {
        if($d_uid[$j] == $r[$i][0]) $chk = 1;
    }
    if(!$chk) {
        $d_uid[$cnt] = $r[$i][0];
        $c_uid[$cnt] = $r[$i][1];
        $d_name[$cnt] = $r[$i][4];
        $d_yoie[$cnt] = $r[$i][5];
        $cnt++;
    }
}

$time = array();

for($i=0; $i<count($d_uid); $i++) {

    $link = "/api/math/timetable?client_no=".$ac."&d_uid=".$d_uid[$i];
    $r = api_calls_get($link);

    if(count($r)) {

        for($j=0; $j<count($r); $j++) {

            $cnt = 0;

            if($r[$j][2] == $_SESSION['t_uid']) { //해당 선생(강사)님

                $time[$i] = $r[$j][0];

                for($k=1; $k<count($r[$j]); $k++) {

                    if($k%3 == 0) {

                        if($r[$j][$k]) :

                            $day[$i][$cnt] = $r[$j][$k];

                        endif;

                        $cnt++;
                    }
                }
            }

        }

    }
}

//if($day[0][$i]) : ?>
<!---->
<!--    <td style="--><?php
//    $kk = $i+1;
//    if($kk == 7) $kk = 0;
//    if(($kk)==date(w)) {
//        echo 'background: #C6FF70;';
//    }?><!--">-->
<!--        <div class="class_info">-->
<!--            --><?php
//            for($j=0; $j<count($time); $j++) {
//
//                if($time[$j] == $s) { //교시 표시
//
//                    //해당 수업에 학생 정보
//                    $link_4 = "/api/math/class_stu?client_no=".$_SESSION['client_no']."&d_uid=".$d_uid[$j]."&c_uid=".$c_uid[$j];
//                    $r_4 = api_calls_get($link_4);
//
//
//                    echo "<a href='student_management_record.php?d_uid=".$d_uid[$j]."&c_uid=".$c_uid[$j]."'>".$d_name[$j]."<br>(".(count($r_4)-1).")</a><br>";
//                }
//            }
//            ?>
<!--        </div>-->
<!--    </td>-->
<?php
//else :
//
//    echo "<td></td>";
//
//endif;
var_dump($day);
echo "00000000<br><br>";
var_dump($time);
var_dump($d_name);
?>