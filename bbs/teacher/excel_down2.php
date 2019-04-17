<?php
header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = invoice.xls" );

include_once ('_common.php');

$class = $_GET['class'];
$test_genre = $_GET['genre'];
$title = $_GET['title'];
$d_order = $_GET['d_order'];
$d_uid = $_GET['d_uid'];
$c_uid = $_GET['c_uid'];
$s_uid = $_GET['s_uid'];

$sql = "select * from `teacher_score` where `d_uid`='$d_uid' and `c_uid`='$c_uid' and `s_uid`='$s_uid' and `class` = '$class' and `test_genre` = '$test_genre' and `title` = '$title';";
$result = mysqli_query($connect_db, $sql);

//반 평균
$cnt = 0;
$tot = 0;
$score_list = array();
while($res = mysqli_fetch_array($result)) {
    $tot += $res['score1']+$res['score2']+$res['score3'];
    $score_list[$cnt] = $res['score1']+$res['score2']+$res['score3'];
    $cnt++;
    $grade = $res['grade'];
}

//동일 학년
$sql = "select * from `teacher_score` where `test_genre` = '$test_genre' and `grade` = '$grade';";
$result = mysqli_query($connect_db, $sql);
$a_score_list = array();
$a_tot = 0;
$a_cnt = 0;
while($res = mysqli_fetch_array($result)) {
    $a_tot += $res['score1']+$res['score2']+$res['score3'];
    $a_score_list[$cnt] = $res['score1']+$res['score2']+$res['score3'];
    $a_cnt++;
}

//동일 레벨
$sql = "select * from `teacher_score` where `test_genre` = '$test_genre' and `class`='$class';";
$result = mysqli_query($connect_db, $sql);
$a_score_list1 = array();
$a_tot1 = 0;
$a_cnt1 = 0;
while($res = mysqli_fetch_array($result)) {
    $a_tot1 += $res['score1']+$res['score2']+$res['score3'];
    $a_score_list1[$cnt] = $res['score1']+$res['score2']+$res['score3'];
    $a_cnt1++;
}

?>
<table border="1">
    <tr>
        <td colspan="3" height="70"  align="center"> 대상반 </td>
        <td colspan="6" width="1500" align="center"> <?=$res['class']?> </td>
        <td colspan="3" width="1000" align="center"> 시험유형 </td>
        <td colspan="4" width="1500" align="center"> <?=$test_genre?> </td>
    </tr>
    <tr>
        <td colspan="3" height="70" align="center"> 시험일 </td>
        <td colspan="6" align="center"> <?=$res['date']?> </td>
        <td colspan="3" align="center"> 시험명 </td>
        <td colspan="4" align="left"> <?=$res['title']?> </td>
    </tr>
    <tr>
        <td colspan="3" height="70" align="center"> 반평균 </td>
        <td colspan="3" align="center"> 100점 만점 <br> 최고점수</td>
        <td colspan="3" align="center">  <?=sprintf("%.1f", ($tot/$cnt/2))?> 점 <br> <?=sprintf("%.1f", max($score_list)/$cnt/2)?> 점</td>
        <td colspan="3" align="center"> 응시인원 </td>
        <td colspan="4" align="center"> <?=$a_cnt?> </td>
    </tr>
    <tr>
        <td colspan="3" height="70" align="center"> 전체평균 </td>
        <td colspan="3" align="center"> 동일레벨 <br> 동일학년</td>
        <td colspan="3" align="center">  <?=sprintf("%.1f", $a_tot1/$a_cnt1/2)?> 점 <br> <?=sprintf("%.1f", $a_tot/$a_cnt/2)?> 점</td>
        <td colspan="7" align="center">  </td>
    </tr>

</table>
<br><br>

<table border="1">
    <tr>
        <td colspan="3" height="30"  align="center" bgcolor="#006400" style="color:#fff"> 학생명 </td>
        <td colspan="4" width="1500" align="center" bgcolor="#006400" style="color:#fff"> 1회</td>
        <td colspan="4" width="1000" align="center" bgcolor="#006400" style="color:#fff"> 2회 </td>
        <td colspan="4" width="1000" align="center" bgcolor="#006400" style="color:#fff"> 2회 </td>
        <td colspan="3" width="1500" align="center" bgcolor="#006400" style="color:#fff"> 평균점수 </td>
    </tr>
    <?php
    $sql = "select * from `teacher_score` where `d_uid`='$d_uid' and `c_uid`='$c_uid' and `s_uid`='$s_uid' and `class` = '$class' and `test_genre` = '$test_genre' and `title` = '$title' order by `seq`;";
    $result = mysqli_query($connect_db, $sql);
    $i=1;
    $cnt=1;
    while($res = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td colspan="3" height="40"  align="center"> <?=$res['student']?> </td>
            <td colspan="4" align="center"> <?=$res['score1']?> 점 </td>
            <td colspan="4" align="center"> <?=$res['score2']?> 점 </td>
            <td colspan="4" align="center"> <?=$res['score3']?> 점 </td>
            <td colspan="3" align="center"> <?=sprintf("%.1f", ($res['score1']+$res['score2']+$res['score3'])/2)?> 점 </td>
        </tr>
        <?
        $i++;
        $cnt++;
    }
    ?>
</table>



