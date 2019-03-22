<?php
include_once ('_common.php');
include_once ('head.php');

//해당 수업에 학생 정보
$link = "/api/math/class_stu?client_no=".$_SESSION['client_no']."&d_uid=".$_GET['d_uid']."&c_uid=".$_GET['c_uid'];
$r = api_calls_get($link);

for($i=0; $i<count($d_name); $i++) {

    if($d_uid[$i] == $_GET['d_uid'] && $c_uid[$i] == $_GET['c_uid']) {

        $class_name = $d_name[$i];
    }

}



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MathIt - teacher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="96x96" href="img/f.png">
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/student_manegement_record.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
</head>

<body>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text"><span><?=$class_name?></span></p>
            </div>
            <div class="head_right">
                <div class="report_manegement_btn"><a href="record_management_list.php">성적관리</a></div>
                <div class="hw_make_btn"><a href="homework_management_add.php">숙제생성</a></div>
                <div class="scoring_shortcut_btn"><a href="student_management_score_each.php?d_uid=<?=$_GET[d_uid]?>&c_uid=<?=$_GET[c_uid]?>">채점바로가기</a></div>
            </div>
        </div>
    </div>
    <div class="class_table_section">

		<table>
            <thead>
            <tr>
                <th>이름</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for($i=1; $i<count($r); $i++) {
                ?>
                <tr>
                    <td><span><?=$r[$i][2]?></span></td>
                    <td>
                        <div class="hw_manegement_btn disable"><a href="homework_management_personal.php?s_id=<?=$r[$i][1]?>&d_uid=<?=$_GET['d_uid']?>&c_uid=<?=$_GET['c_uid']?>">숙제관리</a></div>
                        <div class="con_manegement_btn"><a href="consult_management_write.php?s_id=<?=$r[$i][1]?>&d_uid=<?=$_GET['d_uid']?>&c_uid=<?=$_GET['c_uid']?>">상담관리</a></div>
                        <div class="report_view_btn disable"><a href="student_management_personal_record.php?s_id=<?=$r[$i][1]?>&d_uid=<?=$_GET['d_uid']?>&c_uid=<?=$_GET['c_uid']?>">성적표</a></div>
                        <div class="scoring_list_btn"><a href="scoring_list.php?s_id=s_id=<?=$r[$i][1]?>&d_uid=<?=$_GET['d_uid']?>&c_uid=<?=$_GET['c_uid']?>">채점목록</a></div>
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
