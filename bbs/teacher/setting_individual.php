<?php
include_once ('_common.php');
include_once ('head.php');
$ac = $_SESSION['client_no'];
$link = "/api/math/teacher_list?client_no=".$ac;
$r = api_calls_get($link);

for($i=0; $i<count($r); $i++) {
    if($r[$i][0] == $_SESSION['t_uid']) {
        $id = $r[$i][1];
        $name = $r[$i][3];
        $phone = $r[$i][5];
        $celephone = $r[$i][6];
        $profile = $r[$i][8];
        $email = $r[$i][7];
        $memo = $r[$i][9];
        $cate = $r[$i][4];
    }
}

?>

    <link rel="stylesheet" type="text/css" media="screen" href="css/setting_individual.css" />
    <script src="js/common.js"></script>

<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">개인정보조회</p>
            </div>
            <div class="head_right">
                <div class="setting_menu"><a href="setting.php">설정</a></div>
                <div class="setting_menu"><a href="setting_individual.php" class="on">개인정보조회</a></div>
            </div>
        </div>
    </div>
    <div class="setting_box">
        <div class="l_section">
            <p class="line_title">사진</p>
            <div class="picture_input_section"><img src="<?=$profile?>" style="width: 100%; height: 100%;"></div>
        </div>
        <div class="r_section">
            <div class="content_line">
                <p class="line_title">아이디</p>
                <div class="content_side"><?=$id?></div>
            </div>
            <div class="content_line">
                <p class="line_title">이름</p>
                <div class="content_side"><?=$name?></div>
            </div>
            <div class="content_line">
                <p class="line_title">회원 구분</p>
                <div class="content_side"><?=$cate?></div>
            </div>
            <div class="content_line">
                <p class="line_title">휴대폰</p>
                <div class="content_side"><?=$phone?></div>
            </div>
            <div class="content_line">
                <p class="line_title">집전화</p>
                <div class="content_side"><?=$celephone?></div>
            </div>
            <div class="content_line">
                <p class="line_title">이메일</p>
                <div class="content_side"><?=$email?></div>
            </div>
            <div class="content_line">
                <p class="line_title">메모</p>
                <div class="content_side"><textarea name="" id="" cols="30" rows="10"><?=$memo?></textarea></div>
            </div>
        </div>
    </div>
</section>
</body>

</html>
