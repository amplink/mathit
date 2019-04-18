<?php
include_once ('_common.php');
$t_uid = $_SESSION['t_uid'];
$sql = "select * from `teacher_setting` where `t_id`='$t_uid';";
$result = mysqli_query($connect_db, $sql);
$res = mysqli_fetch_array($result);

if($res['admin_menu']==0) {
    alert_msg("관리자 권한이 없습니다.");
    location_href("./home.php");
}
include_once ('head.php');
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
    <link rel="stylesheet" type="text/css" media="screen" href="css/setting.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
</head>

<body>
<section>
    <form action="setting_chk.php" method="post" id="setting_form">
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">설정</p>
            </div>
            <div class="head_right">
                <div class="setting_menu on"><a href="setting.php" class="on">설정</a></div>
                <div class="setting_menu"><a href="setting_individual.php">개인정보조회</a></div>
            </div>
        </div>
    </div>
    <!-- <div class="setting_btn"><a href="#none" style="font-size: 18px;color: white;">저장</a></div> -->

    <div class="setting_box">
        <div class="setting_head">
            <p>메뉴권한 설정</p>
            <div class="save_setting_btn"><a href="javascript:submit();">저장</a></div>
        </div>

        <table>
            <thead>
            <tr>
                <th>이름</th>
                <th>회원유형</th>
                <th>숙제생성</th>
                <th>숙제관리</th>
                <th>성적관리</th>
                <th>상담관리</th>
                <th>성적표</th>
                <th>공지사항(학원)</th>
                <th>관리자메뉴</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $ac = $_SESSION['client_no'];
            $link = "/api/math/teacher_list?client_no=".$ac;
            $r = api_calls_get($link);

            // Array ( [0] => 1208 [1] => mathit1 [2] => $2y$10$sRyNvKSfIQav0luJVWK9KuIM8Rd4F77.h.DNEhlqO9B [3] => 박상은 [4] => MATH IT 원장 [5] => [6] => [7] => [8] => https://www.buybook.co.kr/data/aca/staff/126/mathit1.png?=1541640380 [9] => 뿌리가 튼튼하면 그 어떤 교육정책에도 흔들림이 없다. )
            $sql = "select * from `academy`;";
            $result = sql_query($sql);
            $manager = array();
            $t = 0;
            while($res = mysqli_fetch_array($result)) {
                $manager[$t] = $res['manager_id'];
            }
            $chk = 0;
            for($i=1; $i<count($r); $i++) {
                for($j=0; $j<count($manager); $j++) {
                    if($manager[$j] == $r[$i][1]) $chk = 1;
                }
                if(!$chk) {
					$sql2 = "select * from `teacher_setting` where `t_id`='".$r[$i][0]."';";
					$result2 = mysqli_query($connect_db, $sql2);
					$res2 = mysqli_fetch_array($result2);

					$checked1 = ($res2['hm_create']==1)?"checked":"";
					$checked2 = ($res2['hm_mg']==1)?"checked":"";
					$checked3 = ($res2['score_mg']==1)?"checked":"";
					$checked4 = ($res2['consult_mg']==1)?"checked":"";
					$checked5 = ($res2['grade_card']==1)?"checked":"";
					$checked6 = ($res2['notice']==1)?"checked":"";
					$checked7 = ($res2['admin_menu']==1)?"checked":"";

             ?>
                    <tr>
					    <input type="hidden" name="tid[]" value="<?=$r[$i][0]?>">
                        <td><span><?=$r[$i][3]?></span></td>
                        <td><select name="type[]" id="type_<?=$r[$i][0]?>">
                                <option value="전임강사" <?echo ($res2['type']=='전임강사')?"selected":"";?>>전임강사</option>
                                <option value="채점강사" <?echo ($res2['type']=='채점강사')?"selected":"";?>>채점강사</option>
                            </select></td>
                        <td><input type="checkbox" name="hm_create[]" value="<?=$r[$i][0]?>" id="hm_create_<?=$r[$i][0]?>" <?=$checked1?>></td>
                        <td><input type="checkbox" name="hm_mg[]" value="<?=$r[$i][0]?>" id="hm_mg_<?=$r[$i][0]?>" <?=$checked2?>></td>
                        <td><input type="checkbox" name="score_mg[]" value="<?=$r[$i][0]?>" id="score_mg_<?=$r[$i][0]?>" <?=$checked3?>></td>
                        <td><input type="checkbox" name="consult_mg[]" value="<?=$r[$i][0]?>" id="consult_mg_<?=$r[$i][0]?>" <?=$checked4?>></td>
                        <td><input type="checkbox" name="grade_card[]" value="<?=$r[$i][0]?>" id="grade_card_<?=$r[$i][0]?>" <?=$checked5?>></td>
                        <td><input type="checkbox" name="notice[]" value="<?=$r[$i][0]?>" id="notice_<?=$r[$i][0]?>" <?=$checked6?>></td>
                        <td><input type="checkbox" name="admin_menu[]" value="<?=$r[$i][0]?>"  id="admin_menu_<?=$r[$i][0]?>" <?=$checked7?>></td>
                    </tr>
                    <?
                }
                $chk = 0;
            }
            ?>
            </tbody>
        </table>
    </div>
    </form>
    <form action="setting_app_chk.php" method="post" id="setting_app_form">
    <div class="app_box">
        <div class="app_head">
            <p>앱 정보 및 설정</p>
            <div class="save_setting_btn" onclick="submit_alarm()"><a href="#none">저장</a></div>
        </div>
        <div class="app_contnet_section">
            <div class="l_side">
                <p class="content_title">앱 버전정보 및<br>업데이트</p>
                <div class="content_side">
                    <p>
                        <span>0.12 ver.</span>
                        <span>2019-01-01 update</span>
                    </p>
                </div>
            </div>
            <div class="r_side">
                <div class="line_">
                    <p class="content_title">푸시알람</p>
                    <div class="content_side">
                        <div class="radio_on"><input type="radio" name="push_alarm" value="1" id="alarm_on">
                            <p>on</p>
                        </div>
                        <div class="radio_on"><input type="radio" name="push_alarm" value="0" id="alarm_off">
                            <p>off</p>
                        </div>
                    </div>
                </div>
                <div class="line_">
                    <p class="content_title">효과음</p>
                    <div class="content_side">
                        <div class="radio_on"><input type="radio" name="sound" value="1" id="sound_on">
                            <p>on</p>
                        </div>
                        <div class="radio_on"><input type="radio" name="sound" value="0" id="sound_off">
                            <p>off</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</section>
</body>
</html>
<?php
$sql = "select * from `teacher_setting`";
$result = mysqli_query($connect_db, $sql);
/*while($res = mysqli_fetch_array($result)) {
    if($res['type']=="전임강사") echo "<script>$('#type_".$res['t_id']."').val('전임강사');</script>";
    else echo "<script>$('#type_".$res['t_id']."').val('채점강사');</script>";

    if($res['hm_create']) echo "<script>$('#hm_create_".$res['t_id']."').prop('checked', true);</script>";
    if($res['hm_mg']) echo "<script>$('#hm_mg_".$res['t_id']."').prop('checked', true);</script>";
    if($res['score_mg']) echo "<script>$('#score_mg_".$res['t_id']."').prop('checked', true);</script>";
    if($res['consult_mg']) echo "<script>$('#consult_mg_".$res['t_id']."').prop('checked', true);</script>";
    if($res['grade_card']) echo "<script>$('#grade_card_".$res['t_id']."').prop('checked', true);</script>";
    if($res['notice']) echo "<script>$('#notice_".$res['t_id']."').prop('checked', true);</script>";
    if($res['admin_menu']) echo "<script>$('#admin_menu_".$res['t_id']."').prop('checked', true);</script>";
}*/

$sql = "select * from `app_setting`";
$result = mysqli_query($connect_db, $sql);
while($res = mysqli_fetch_array($result)) {
    if($res['alarm']) echo "<script>$('#alarm_on').prop('checked', true);</script>";
    else echo "<script>$('#alarm_off').prop('checked', true);</script>";

    if($res['melody']) echo "<script>$('#sound_on').prop('checked', true);</script>";
    else echo "<script>$('#sound_off').prop('checked', true);</script>";
}
?>
<script>
    function submit() {
        $('#setting_form').submit();
    }
    function submit_alarm() {
        $('#setting_app_form').submit();
    }
</script>