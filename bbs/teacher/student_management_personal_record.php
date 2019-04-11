<?php
include_once ('_common.php');
include_once ('head.php');

$link = "/api/math/student?client_no=".$_SESSION['client_no']."&id=".$_GET['s_id'];
$r = api_calls_get($link);
$student_name = $r[3];

$link = "/api/math/class?client_no=".$_SESSION['client_no'];
$r = api_calls_get($link);
for($i=0; $i<count($r); $i++) {
    if($r[$i][0] == $_GET['d_uid'] && $r[$i][1] == $_GET['c_uid'] && $r[$i][1] == $_GET['s_uid']) {
        $class = $r[$i][4];
    }
}
$sql = "select * from `teacher_score` 
         where 
		`d_uid` = '$_GET[d_uid]' 
		and `d_uid` = '$_GET[d_uid]' 
		and `c_uid` = '$_GET[c_uid]'
		and `s_uid` = '$_GET[s_uid]'
		and `student_id` = '$_GET[s_id]';";
$result = mysqli_query($connect_db, $sql);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MathIt - teacher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/student_manegement_personal_record.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
</head>

<body>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">
                    <span><?=$class?></span>
                </p>
                <p> 성적표 </p>
                <p>
                    <span> - <?=$student_name?></span>
                </p>
            </div>
            <div class="head_right">
            </div>
        </div>
    </div>
    <div class="student_table_section">
        <table>
            <thead>
            <tr>
                <th>순번</th>
                <th>시험명</th>
                <th>응시일</th>
                <th>성적표</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $cnt = 1;
                while($res = mysqli_fetch_array($result)) {
                    if($res['test_genre'] == '분기테스트')  $type= "quarter";
                    else                                    $type= "mid";
            ?>
                <tr>
                    <td><?=$cnt?></td>
                    <td><span><?=$res['year']?>/<?=$res['quarter']?>분기 <?=$res['test_genre']?></span></td>
                    <td><span><?=substr($res['date'],-4)?>-<?=substr($res['date'],0,2)?>-<?=substr($res['date'],3,2)?></span></td>
                    <td>
                        <div class="paper">
                            <!--<a href="student_management_personal_mid_record_detail.php?d_uid=<?=$_GET['d_uid']?>&c_uid=<?=$_GET['c_uid']?>&s_uid=<?=$_GET['s_uid']?>&s_name=<?=$student_name?>&title=<?=$res['title']?>&s_id=<?=$res['student_id']?>">-->
                            <a href="student_management_personal_<?=$type?>_record_detail.php?no=<?=$res['seq']?>">
                                <img src="img/paper.png" alt="paper_icon">
                            </a>
                        </div>
                        <div class="print"><a href=""><img src="img/printer.png" alt="printer_icon"></a></div>
                        <div class="mail"><a href=""><img src="img/mail.png" alt="mail_icon"></a></div>
                    </td>
                </tr>
                <?
                $cnt++;
            }
            ?>
            </tbody>
        </table>
    </div>
</section>
</body>

</html>