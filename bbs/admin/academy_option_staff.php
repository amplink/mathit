<?php
include_once('_common.php');
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

//include_once(G5_THEME_PATH.'/head.php');
//190130김영모 페이지 번호 입력
$now_menu_number = 30;
include_once('head.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");

if(!$_GET['page']) {
    $page = 0;
}else {
    $page = $_GET['page']-1;
}

$manager_get_id = $_GET['manager_get_id'];
$manager_get_name = $_GET['manager_get_name'];
$manager_get_chk = $_GET['manager_get_chk'];
$manager_get_uid = $_GET['manager_get_uid'];
?>

<!--<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MathIT Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">-->
<link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/academy_option_staff.css" />
<script src="js/jquery-3.3.1.min.js"></script>
<!--</head>

<body>-->
<!--    <div class="header">-->
<!--        <div class="logo_wrap">-->
<!--            <div class="logo"><img src="img/logo.png" alt="logo"></div>-->
<!--            <p>ADMIN</p>-->
<!--        </div>-->
<!--        <nav>-->
<!--            <div class="nav_menu"><a href="index.php">홈</a></div>-->
<!--            <div class="nav_menu"><a href="notice_home.php">공지사항관리</a></div>-->
<!--            <div class="nav_menu"><a href="academy_option_staff.php" class="on">학원별관리</a></div>-->
<!--            <div class="nav_menu"><a href="answer_manegement.php">정답지관리</a></div>-->
<!--        </nav>-->
<!--        <div class="header_right">-->
<!--            <div class="user_img"><img src="img/user.png" alt="user_img"></div>-->
<!--            <p class="user_id">admin</p>-->
<!--            <div class="logout_btn"><a href="login.php">로그아웃</a></div>-->
<!--            <div class="pass_change_btn"><a href="home_pass_change.php">비밀번호변경</a></div>-->
<!--        </div>-->
<!--    </div>-->
<div class="section">
    <div class="head_section">
        <div class="l_nav">
            <div class="l_nav_menu"><a href="academy_option_add.php">학원등록</a></div>
            <div class="l_nav_menu"><a href="academy_option_staff.php" class="on">관리자 지정</a></div>
        </div>
        <div class="search_box_wrap">
            <div class="search_input_box"><input type="text" id="search_val"></div>
            <div class="search_btn" onclick="search();"><a href="#none">검색</a></div>
        </div>
    </div>
    <form action="academy_option_staff_del.php" method="post" id="staff_form">
        <div class="view_section">
            <table>
                <thead>
                <tr style="text-align:center">
                    <th><input type="checkbox" id="all_select"></th>
                    <th>학원명</th>
                    <th>관리자 아이디</th>
                    <th>관리자 이름</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "select * from `academy`";
                $result = mysqli_query($connect_db, $sql);
                $i=0;
                $t = 0;
                while($res = mysqli_fetch_array($result)) {
                    if($t >= $page*10 && $t <= ($page*10+10)) {
                        if($manager_get_chk == $res['client_name']) {
                            echo '<tr style="text-align:center">';
                            echo '<td style="width:20px" ><input type="checkbox" name="chk_list[]" value="'.$res['client_name'].'" onclick="get_ac_name(this);" id="'.$i.'" checked="true"></td>';
                            echo '<td><span>'.$res['client_name'].'</span></td>';
                            echo '<td><span>'.$res['manager_id'].'</span></td>';
                            echo '<td>'.$res['manager_name'].'</td>';
                            echo '</tr>';
                        }else {
                            echo '<tr style="text-align:center">';
                            echo '<td style="width:20px" ><input type="checkbox" name="chk_list[]" value="'.$res['client_name'].'" onclick="get_ac_name(this);" id="'.$i.'"></td>';
                            echo '<td><span>'.$res['client_name'].'</span></td>';
                            echo '<td><span>'.$res['manager_id'].'</span></td>';
                            echo '<td>'.$res['manager_name'].'</td>';
                            echo '</tr>';
                        }
                        $i++;
                    }
                    $t++;
                }

                ?>
                </tbody>
            </table>
    </form>
</div>
<div class="section_footer">
    <div class="list_btn_wrap">
        <div class="prev_btn"><a href="./academy_option_staff.php?page=<?=$page;?>"><img src="img/prev.png" alt=""></a></div>
        <ul>
            <?
            $count = $t;
            for($i=0; $i<$count/10; $i++) {
                $cnt = $i+1;
                echo '<li><a href="./academy_option_staff.php?page='.$cnt.'">'.$cnt.'</a></li>';
            }
            ?>
        </ul>
        <div class="next_btn"><a href="./academy_option_staff.php?page=<?=$page+1;?>"><img src="img/next.png" alt=""></a></div>
    </div>
    <div class="button_wrap">
        <div class="delete_btn" onclick="del_academy()"><a href="#">선택삭제</a></div>
    </div>
</div>
<form action="ac_manager_chk.php" id="manager_form" method="POST">
    <input type="hidden" name="manager_uid" id="manager_uid">
    <div class="add_section">
        <div class="line">
            <div class="name">
                <div class="lside">
                    <p>관리자 아이디</p>
                </div>

                <div class="rside">
                    <input type="text" placeholder="관리자 아이디를 입력해주세요" name="manager_id" value="none" id="manager_id">
                    <div class="confirm_btn" onclick="outh_manager();"><a>확인</a></div>
                </div>

            </div>
            <div class="pass">
                <div class="lside">
                    <p>관리자 이름</p>
                </div>
                <div class="rside">
                    <input type="text" disabled name="manager_name" id="manager_name"/>
                </div>
            </div>
            <!--                <div class="pass">-->
            <!--                    <div class="lside">-->
            <!--                        <p>학원명</p>-->
            <!--                    </div>-->
            <!--                    <div class="rside">-->
            <input type="hidden" name="ac_name" id="ac_name"/>
            <!--                    </div>-->
            <!--                </div>-->
        </div>
        <!--            <div class="line">-->
        <!--                <div class="name">-->
        <!--                    <div class="lside">-->
        <!--                        <p></p>-->
        <!--                    </div>-->
        <!--                    <div class="rside">-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="pass">-->
        <!--                    <div class="lside">-->
        <!--                        <p>관리자 이름</p>-->
        <!--                    </div>-->
        <!--                    <div class="rside">-->
        <!--                        <input type="text" disabled />-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
    </div>
    <div class="section_footer">
        <div class="button_wrap">
            <div class="add_btn" onclick="sul3mit();"><a href="#none">지정</a></div>
        </div>
    </div>
    </div>
</form>
<form action="./outh_manager.php" method="get" id="manager_post_form">
    <input type="hidden" name="manager_get_id" id="manager_get_id">
    <input type="hidden" name="manager_get_chk" id="manager_get_chk">
</form>
<?php
include_once('tail.php');
?>
</body>
</html>
<?php
//function outh_manager() {
//    $res = api_calls_get("/api/math/teacher?client_no=126&id=mathit1");
//}

?>
<script>
    $('#manager_id').val('<? echo $manager_get_id;?>');
    $('#manager_name').val('<? echo $manager_get_name;?>');
    $('#manager_uid').val('<? echo $manager_get_uid?>');
    $('input[type=checkbox]').on('change', function () {
        $('#manager_get_chk').val(this.value);
    });
    $('#ac_name').val('<? echo $manager_get_chk; ?>');
    function del_academy() {
        if(confirm("삭제하시겠습니까?")) $('#staff_form').submit();
    }
    $("#all_select").on('click', function () {
        if($('#all_select').prop('checked')) $('input[type=checkbox]').prop('checked', true);
        else $('input[type=checkbox]').prop('checked', false);
    });
    function outh_manager() {
        // alert($('#manager_id').val());
        $('#manager_get_id').val($('#manager_id').val());
        $('#manager_post_form').submit();
    }
    function get_ac_name(e) {
        $('#ac_name').val(e.value);
    }
    function sul3mit() {
        $('#manager_name').attr('disabled',false);
        $('#manager_form').submit();
    }
    function search() {
        location.href = './search_academy_option_staff.php?search='+$('#search_val').val();
    }
</script>