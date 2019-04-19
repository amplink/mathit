<?php
include_once ('_common.php');
include_once ('head.php');

$today_date = date("Y-m-d");
?>
<style>
    #my-dialog {
        display: none;
        position: fixed;
        left: calc( 50% - 160px );
        top: 150px;
        width: 300px; height: 155px;
        background: #fff;
        z-index: 9999;
    }
    #my-dialog-background {
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,.3);
        z-index: 999;
    }
</style>
<link rel="stylesheet" type="text/css" href="css/student_manegement_personal_quarter_record_detail.css" />
<script src="js/common.js"></script>
<?php
$sql = "select * from `teacher_score` 
             where 
            `seq` = '$_GET[no]'";
$result = mysqli_query($connect_db, $sql);
$res = mysqli_fetch_array($result);
$student_id = $res['student_id'];


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
                <?  if($_GET['flag']!='1'){ ?>
                    <div class="print" onclick="javascript: print_send('quarter','<?=$res[seq]?>')"><img src="img/printer.png" alt="printer_icon"></div>
                    <div class="mail" onclick=""><img src="img/mail.png" alt="mail_icon"></div>
                <?  } ?>

                <div class="sub_close_btn">
                    <?  if($_GET['flag']=='1'){ ?>
                    <a href="javascript:window.close()"><img src="img/close.png" alt="close_icon"></a></div>
            <?  } else {  ?>
                <a href="./student_management_personal_record.php?s_id=<?=$_GET['s_id']?>&d_uid=<?=$_GET['d_uid']?>&c_uid=<?=$_GET['c_uid']?>&s_uid=<?=$_GET['s_uid']?>"><img src="img/close.png" alt="close_icon"></a>
            <?  } ?>
            </div>
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
            <input type="hidden" name="s_id" value="<?=$_GET['s_id']?>">
            <input type="hidden" name="d_uid" value="<?=$_GET['d_uid']?>">
            <input type="hidden" name="c_uid" value="<?=$_GET['c_uid']?>">
            <input type="hidden" name="s_uid" value="<?=$_GET['s_uid']?>">
            <div class="down_head_section">
                <p class="l_div_text">학생 수준 진단</p>
                <div class="save_btn"><a href="javascript:save()">저장</a></div>
            </div>
            <div class="comment_input_section">
                <textarea name="evaluation" id="evaluation" cols="30" rows="10" style="height:150px;width:97%"><?=$res['evaluation']?></textarea>
            </div>
            <div class="down_head_section" style="padding-top:5px">
                <p class="l_div_text">선생님 코멘트</p>
            </div>
            <div class="comment_input_section">
                <textarea name="comment" id="comment" cols="30" rows="10" style="height:150px;width:97%"><?=$res['comment']?></textarea>
            </div>
        </form>

    </div>
</section>
<?php
$ac = $_SESSION['client_no'];
$link = "/api/math/student?client_no=".$ac."&id=".$student_id;
$api_res = api_calls_get($link);
?>
<div id="my-dialog">
    <div style="background-color: rgb(41, 124, 62); width: 100%; height: 30px; text-align: center; padding-top: 5px;">
        <p style="color: white; font-size: 20px; font-weight: bold;">SMS 전송</p>
    </div>
    <div style="padding: 20px;">
        <input type="checkbox" value="<?=$api_res[16]?>" id="parent_phone" name="parent_phone" style="height: auto !important;" checked><span> 학부모 : <?=$api_res[16]?></span>
        <br>
        <input type="checkbox" id="add_phone" name="add_phone" style="height: auto !important;"><span> 추가 : </span><input type="text" placeholder="010-0000-0000" name="add_phone_number" id="add_phone_number">
        <br>
        <div style="text-align: center; padding: 10px;">
            <input type="button" style="width: 100px; background-color: rgb(41, 124, 62); color: white; -webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px; border: 0px; font-size: 15px;" value="전송" onclick="sms_send();">
        </div>
    </div>
</div>
<div id="my-dialog-background"></div>
<script>

    function save() {
        $("#commentForm").submit();
    }

</script>
<script src="./js/es6-promise.auto.js"></script>
<script src="./js/html2canvas.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script><script>
    <? if($_GET['flag']=='2'){?>
    sms_send();
    <?  } else if($_GET['flag']=='1'){ ?>
    window.print();
    <?  }  ?>
    /*
        html2canvas(document.querySelector("body"),{
            //allowTaint: true,
            //taintTest: false,
            useCORS: true,
        }).then(function(canvas) {
            var imgageData = canvas.toDataURL("image/png");
            var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
            jQuery("a").attr("download", "screenshot.png").attr("href", newData);
        });
    */
    $('#my-dialog-background, .mail').click(function () {
        $('#my-dialog, #my-dialog-background').toggle();
    });

    function sms_send() {
        var windowWidth = $( window ).width();

        var width_size = windowWidth - 1366;
        var cut_size = width_size / 2;

        html2canvas(document.querySelector("section"), {
            //allowTaint: true,
            //taintTest: false,
            width:800,
            useCORS: true,
        }).then(function (canvas) {
            var imgageData = canvas.toDataURL("image/png");
            var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
            var parent = "";
            var add_phone = "";

            if($('#parent_phone').attr('checked', true)) parent = $('#parent_phone').val();
            if($('#add_phone').attr('checked', true)) add_phone = $('#add_phone_number').val();

            $.ajax({
                type: "POST",
                url: "imgdown.php",
                data: "canvasData=" + imgageData + "&no=" +  $("#no").val() + "&parent=" + parent + "&add_phone=" + add_phone,
                dataType: "json",
                success: function (data) {
                    if (data.res == "success") alert('문자가 정상적으로 발송 되었습니다.');
                    else alert('문자 발송에 실패하였습니다.');
                    // alert(data.res);
                    <? if($_GET['flag']=='2'){?>
                    window.close();
                    <?  }  ?>
                },
                error: function (xhr, status, error) {
                    alert(error);
                }
            });
        });

    }

    function print_send(gubun, no) {
        var url = "student_management_personal_"+gubun+"_record_detail.php?no="+no+"&flag=1";
        window.open(url,"PopupWin", "width=1100,height=850");
    }
</script>
</body>

</html>
