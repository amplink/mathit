<?php
include_once ('_common.php');
include_once ('head.php');

//해당 수업에 학생 정보
$link = "/api/math/class_stu?client_no=".$_SESSION['client_no']."&d_uid=".$_GET['d_uid']."&c_uid=".$_GET['c_uid'];
$r = api_calls_get($link);

for($i=0; $i<count($d_name); $i++) {

    if($d_uid[$i] == $_GET['d_uid'] && $c_uid[$i] == $_GET['c_uid']) {

        $class_name = $d_name[$i];
        $class_type = $d_yoie[$i];
    }

}
$t_name = $_SESSION['t_name'];
$sql = "select * from `teacher_setting` where `t_name`='$t_name';";
$result = sql_query($sql);
$res = mysqli_fetch_array($result);

?>

<link rel="stylesheet" type="text/css" media="screen" href="css/student_manegement_record.css" />

<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text"><span><?=$class_name?>(<?=$class_type?>)</span></p>
            </div>
            <div class="head_right">
                <div class="report_manegement_btn <?php if(!$res['score_mg']) echo "disable";?>"><a href="record_management_add.php">성적관리</a></div>
                <div class="hw_make_btn <?php if(!$res['hm_create']) echo "disable";?>"><a href="homework_management_add.php">숙제관리</a></div>
                <div class="scoring_shortcut_btn"><a href="student_management_score_each.php?d_uid=<?=$_GET[d_uid]?>&c_uid=<?=$_GET[c_uid]?>&s_uid=<?=$_GET[s_uid]?>">채점관리</a></div>
            </div>
        </div>
    </div>
    <div class="class_table_section">

		<table>
            <thead>
            <tr>
                <th>이름</th>
                <th>조회</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for($i=1; $i<count($r); $i++) {
                ?>
                <tr>
                    <td><span><?=$r[$i][2]?></span></td>
                    <td>
                        <div class="hw_manegement_btn <?php if(!$res['hm_mg']) echo "disable";?>"><a href="homework_management_personal.php?s_id=<?=$r[$i][1]?>&d_uid=<?=$_GET['d_uid']?>&c_uid=<?=$_GET['c_uid']?>&s_uid=<?=$_GET[s_uid]?>&class_name=<?=$class_name?>&student=<?=$r[$i][2]?>">숙제</a></div>
                        <div class="con_manegement_btn <?php if(!$res['consult_mg']) echo "disable";?>"><a href="consult_management_write.php?s_id=<?=$r[$i][1]?>&d_uid=<?=$_GET['d_uid']?>&c_uid=<?=$_GET['c_uid']?>&s_uid=<?=$_GET[s_uid]?>">상담</a></div>
                        <div class="report_view_btn <?php if(!$res['grade_card']) echo "disable";?>"><a href="student_management_personal_record.php?s_id=<?=$r[$i][1]?>&d_uid=<?=$_GET['d_uid']?>&c_uid=<?=$_GET['c_uid']?>&s_uid=<?=$_GET[s_uid]?>">성적</a></div>
                        <div class="scoring_list_btn"><a href="scoring_list.php?s_id=<?=$r[$i][1]?>&d_uid=<?=$_GET['d_uid']?>&c_uid=<?=$_GET['c_uid']?>&s_uid=<?=$_GET[s_uid]?>">채점</a></div>
                    </td>
                </tr>
                <?
            }
            ?>
			</tbody>
        </table>
    </div>
</section>
</body>
</html>
<script>
    $('.disable a').prop('href', '#');
</script>