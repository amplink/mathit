<? include_once('_common.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MATH IT - student</title>
    <meta http-equiv="Expires" content="Mon, 06 Jan 1990 00:00:01 GMT">
    <meta http-equiv="Expires" content="-1">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="icon" type="image/png" sizes="96x96" href="img/f.png">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="css/common.css?v=20190506" />
    <link rel="stylesheet" type="text/css" href="css/report_detail.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js?v=20190506"></script>
    <script src="js/jquery-ui.js"></script>
</head>
<body style="width:100%">
<?php
$sql = "SELECT * FROM 
              `teacher_score` 
            WHERE 
              `seq` = '$_GET[no]' 
			AND client_id = '$_SESSION[client_id]'
			AND student_id = '$_SESSION[s_id]'";

$result = mysqli_query($connect_db, $sql);
$res = mysqli_fetch_array($result);
$student_id = $res['student_id'];
?>
<!--section-->
<section>
    <div class="head_p" style="margin-top: -30px;">
        <p class="head_title">성적표</p>
        <p class="title_detail"><span><?=$res['year']?>년</span><span><?=$res['quarter']?>분기</span></p>
    </div>
    <div class="content_p">
        <p class="record_class_name">
            <span><?=$res['class']?></span>
            <span> - </span>
            <span><?=$res['d_order']?></span>
        </p>
        <p class="student_name"><span><?=$res['student']?></span></p>
    </div>
    <div class="content_detail_p">
        <div class="report_detail_section">
            <p class="detail_title">영역별 점수</p>
            <div class="detail_content_box">
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <th>1단계</th>
                        <th>2단계</th>
                        <th>3단계</th>
                        <th>총점</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><span><?=$res['student']?></span></td>
                        <td>
                            <span><?=$res['score1']?>점</span>
                            <span>/</span>
                            <span><?=$res['sub_score1']?>점</span>
                        </td>
                        <td>
                            <span><?=$res['score2']?>점</span>
                            <span>/</span>
                            <span><?=$res['sub_score2']?>점</span>
                        </td>
                        <td>
                            <span><?=$res['score3']?>점</span>
                            <span>/</span>
                            <span><?=$res['sub_score3']?>점</span>
                        </td>
                        <td>
                            <span><?=$res['score1']+$res['score2']+$res['score3']?>점</span>
                            <span>/</span>
                            <span><?=$res['sub_score1']+$res['sub_score2']+$res['sub_score3']?>점</span>
                        </td>
                    </tr>
                    <?php
                    $sql2 = "SELECT 
                                  SUM(score1) / COUNT(seq) avg1,
                                  SUM(score2) / COUNT(seq) avg2,
                                  SUM(score3) / COUNT(seq) avg3
                                FROM
                                  `teacher_score`
                                WHERE 
                                    grade = '$res[grade]'
                                    -- AND d_uid='$res[d_uid]'
                                    -- AND c_uid='$res[c_uid]'
                                    AND s_uid='$res[s_uid]'
                                    -- AND d_order='$res[d_order]'
                                    AND test_genre='$res[test_genre]'
                                    AND client_id='$_SESSION[client_id]'
			                     ";
                    $result2 = mysqli_query($connect_db, $sql2);
                    $res2 = mysqli_fetch_array($result2);
                    ?>
                    <tr>
                        <td><span>학년평균</span></td>
                        <td><span><?=round($res2[avg1])?>점</span></td>
                        <td><span><?=round($res2[avg2])?>점</span></td>
                        <td><span><?=round($res2[avg3])?>점</span></td>
                        <td><span><?=round($res2[avg1])+round($res2[avg2])+round($res2[avg3])?>점</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="report_detail_section">
            <p class="detail_title">학생 수준 진단</p>
            <div class="detail_content_box">
                <p><span><?=nl2br($res['evaluation'])?></span></p>
            </div>
        </div>
        <div class="report_detail_section">
            <p class="detail_title">선생님 코멘트</p>
            <div class="detail_content_box">
                <p><span><?=nl2br($res['comment'])?></span></p>
            </div>
        </div>
    </div>
</section>
<script>
    setTimeout(function() {
        window.print();
    }, 2000);
</script>
</body>
</html>