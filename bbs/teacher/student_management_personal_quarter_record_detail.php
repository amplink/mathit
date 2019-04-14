<?php
include_once ('_common.php');
include_once ('head.php');
$today_date = date("Y-m-d");
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
    <link rel="stylesheet" type="text/css" media="screen" href="css/student_manegement_personal_quarter_record_detail.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
</head>

<body>
<?php
    $sql = "select * from `teacher_score` 
             where 
            `seq` = '$_GET[no]'";
    $result = mysqli_query($connect_db, $sql);
    $res = mysqli_fetch_array($result);
?>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text"><?=$res['test_genre']?></p>
                <p class="quarter_date">
                    <span><?=$res['year']?></span>
                    <span>년도 </span>
                    <span><?=$res['quarter']?></span>
                    <span>분기</span>
                </p>
                <p class="record_date"><?=$today_date?></p>
            </div>
            <div class="head_right">
                <div class="print"><img src="img/printer.png" alt="printer_icon"></div>
                <div class="mail"><img src="img/mail.png" alt="mail_icon"></div>
                <div class="sub_close_btn"><a href="javascript:history.back()"><img src="img/close.png" alt="close_icon"></a></div>
            </div>
        </div>
    </div>
    <div class="up_box">
        <div class="l_box">
            <div class="student_info_section">
                <div class="s_info_left">
                    <div class="s_info_div">
                        <p class="l_div_text">학급</p>
                        <div class="r_div_content">
                            <p>
                                <span><?=$res['class']?></span>
                            </p>
                            <p>
                                <span>(</span>
                                <span><?=$res['d_order']?></span>
                                <span>)</span>
                            </p>
                        </div>
                    </div>
                    <div class="s_info_div">
                        <p class="l_div_text">강사</p>
                        <div class="r_div_content">
                            <p>
                                <span><?=$res['teacher']?></span>
                            </p>
                        </div>
                    </div>
                    <div class="s_info_div">
                        <p class="l_div_text">학생</p>
                        <div class="r_div_content">
                            <p>
                                <span><?=$res['student']?></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="s_info_right">
                </div>
            </div>
            <div class="record_detail_table_section">
                <p class="l_div_text">영역별 점수</p>
                <div class="record_detail_table">
                    <table>
                        <thead>
                        <tr>
                            <th>이름/평균</th>
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
                                    AND d_uid='$res[d_uid]'
                                    AND c_uid='$res[c_uid]'
                                    AND s_uid='$res[s_uid]'
                                    AND d_order='$res[d_order]'
                                    AND test_genre='$res[test_genre]'
                                    AND client_id='$ac'
			                     ";
                        $result2 = mysqli_query($connect_db, $sql2);
                        $res2 = mysqli_fetch_array($result2);
                        ?>
                        <tr>
                            <td>학년 평균</td>
                            <td>
                                <span><?=round($res2[avg1])?>점</span>
                            </td>
                            <td>
                                <span><?=round($res2[avg2])?>점</span>
                            </td>
                            <td>
                                <span><?=round($res2[avg3])?>점</span>
                            </td>
                            <td>
                                <span><?=round($res2[avg1])+round($res2[avg2])+round($res2[avg3])?>점</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="down_box">
        <form name="commentForm" id="commentForm" action="./score_comment_reg.php" method="post">
            <input type="hidden" name="no" value="<?=$res['seq']?>">
            <input type="hidden" name="flag" value="quarter">
            <div class="down_head_section">
                <p class="l_div_text">학생 수준 진단</p>
                <div class="save_btn"><a href="javascript:save()">저장</a></div>
            </div>
            <div class="comment_input_section">
                <textarea name="evaluation" id="evaluation" cols="30" rows="10" style="height:180px;width:100%"><?=$res['evaluation']?></textarea>
            </div>
            <div class="down_head_section">
                <p class="l_div_text">선생님 코멘트</p>
            </div>
            <div class="comment_input_section">
                <textarea name="comment" id="comment" cols="30" rows="10" style="height:180px;width:100%"><?=$res['comment']?></textarea>
            </div>
        </form>

    </div>
</section>
<script>

    function save() {
        $("#commentForm").submit();
    }

</script>
</body>

</html>
