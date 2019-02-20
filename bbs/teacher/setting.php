<?php
include_once ('_common.php');
include_once ('head.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MathIt - teacher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            <div class="save_setting_btn"><a href="$('#setting_form').submit();'">저장</a></div>
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

            for($i=1; $i<count($r); $i++) {
                ?>
                <tr>
                    <td><span><?=$r[$i][3]?></span></td>
                    <td><select name="member_type" id="member_type" name="type">
                            <option value="전임강사">전임강사</option>
                            <option value="채점강사">채점강사</option>
                        </select></td>
                    <td><input type="checkbox" name="hm_create"></td>
                    <td><input type="checkbox" name="hm_mg"></td>
                    <td><input type="checkbox" name="score_mg"></td>
                    <td><input type="checkbox" name="consult_mg"></td>
                    <td><input type="checkbox" name="grade_card"></td>
                    <td><input type="checkbox" name="notice"></td>
                    <td><input type="checkbox" name="admin_menu"></td>
                </tr>
                <?
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
            <div class="save_setting_btn"><a href="#none">저장</a></div>
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
                        <div class="radio_on"><input type="radio" name="push_alarm">
                            <p>on</p>
                        </div>
                        <div class="radio_on"><input type="radio" name="push_alarm">
                            <p>off</p>
                        </div>
                    </div>
                </div>
                <div class="line_">
                    <p class="content_title">효과음</p>
                    <div class="content_side">
                        <div class="radio_on"><input type="radio" name="sound">
                            <p>on</p>
                        </div>
                        <div class="radio_on"><input type="radio" name="sound">
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