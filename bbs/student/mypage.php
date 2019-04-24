<?php
include_once ('head.php');
$ac = $_SESSION['client_no'];
$link = "/api/math/student?client_no=".$ac."&id=".$_SESSION['s_id'];
$r = api_calls_get($link);

$class_list = explode(',', $r[18]);
$class_d_uid = explode(',', $r[17]);

$class_start = array();
$class_end = array();
for($i=0; $i<count($class_d_uid); $i++) {
    $link = "/api/math/timetable?client_no=".$ac."&d_uid=".$class_d_uid[$i];
    $r = api_calls_get($link);
    $class_start[$i] = $r[0][4];
    for($j=0; $j<count($r); $j++) {
        if($j == count($r)-1) {
            $class_end[$i] = $r[$j][5];
        }
    }
}
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/mypage.css" />
<body>
    <!--section-->
    <section>
        <div class="head_p">
            <div class="head_p_head">
                <p class="head_title">마이페이지</p>
                <div class="back_btn"><a href="home.php"><img src="img/back_btn.png" alt="back_btn_icon"></a></div>
            </div>
            <div class="user_info_wrap">
                <div class="my_user_img"><img src="img/user.png" alt="user_default_img"></div>
                <div class="my_user_info">
                    <p class="my_user_name"><span><?=$_SESSION['s_name']?></span></p>
                    <p class="my_academy_name"><span style="color: rgb(17, 141, 81);">수학학원</span></p>
                </div>
            </div>
        </div>
        <div class="content_p">
            <div class="my_content_head">
                <p><span>수강 중인 수업</span><span>2</span><span>개</span></p>
            </div>
            <div class="class_list_wrap">
                    <?php
                    for($i=0; $i<count($class_list); $i++) {
                        $class_name = explode(' - ', $class_list[$i]);
                        ?>
                    <div class="class_list">
                            <p class="class_title"><span><?=$class_name[1]?> <?=$class_name[2]?></span></p>
                            <p class="class_time"><span>PM</span> <span><?=$class_start[$i]?></span><span>~</span> <span><?=$class_end[$i]?></span></p>
                    </div>
                    <?php
                    }
                    ?>
            </div>
        </div>
        <div class="content_detail_p">
            <div class="my_content_head">
                <p><span>셔틀버스 이용 정보</span></p>
            </div>
            <div class="bus_box_wrap">
                <div class="my_bus_box">
                    <div class="up_section">
                        <div class="bus_use">
                            <p><span style="color: rgb(0, 181, 103);">이용 중</span><span style="color: rgb(181, 0, 0); display: none">이용안함</span></p>
                        </div>
                        <div class="bus_btn_section">
                            <div class="not_use_btn">
                                <p>버스 미 이용 알림</p>
                            </div>
                            <div class="route_change_btn">
                                <p>노선 변경</p>
                            </div>
                        </div>
                    </div>
                    <div class="down_section">
                        <p class="route_name"><span>노선명이 들어갈자리</span></p>
                        <p class="busstop_name"><span>서울고 사거리</span><span>정류장</span></p>
                        <p class="bus_time"><span>PM</span> <span>05:20</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>