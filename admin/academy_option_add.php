<?php
include_once('_common.php');
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

//include_once(G5_THEME_PATH.'/head.php');
include_once('head.php');

?>

<head>
        <link rel="stylesheet" type="text/css" media="screen" href="css/academy_option_add.css" />
</head>
    <div class="section">
        <div class="head_section">
            <div class="l_nav">
                <div class="l_nav_menu"><a href="academy_option_add.php" class="on">학원등록</a></div>
                <div class="l_nav_menu"><a href="academy_option_staff.php" >관리자 지정</a></div>
            </div>
            <div class="search_box_wrap">
                <div class="search_input_box"><input type="text"></div>
                <div class="search_btn"><a href="#none">검색</a></div>
            </div>
        </div>
        <div class="view_section">
            <table>
                <thead>
                    <tr style="text-align:center">
                        <th><input type="checkbox"></th>
                        <th>학원아이디</th>
                        <th>학원명</th>
                    </tr>
                </thead>
                <tbody>
                <form action="academy_option_del.php" method="POST" id="del_form">
                        <?php
                        $sql = "select * from `academy`";
                        $result = mysqli_query($connect_db, $sql);

                        while($ac_data = mysqli_fetch_array($result)) {

                            echo '<tr> ';
                            echo '     <td style="width:20px"><input type="checkbox" name="chk_list[]" value="'.$ac_data['client_id'].'"></td> ';
                            echo '     <td><span>'.$ac_data["client_id"].'</span></td> ';
                            echo '     <td><span>'.$ac_data["client_name"].'</span></td> ';
                            echo ' </tr> ';

                        }

                        ?>
                </form>
                </tbody>
            </table>
        </div>
        <div class="section_footer">
            <div class="list_btn_wrap">
                <div class="prev_btn"><a href="#none"><img src="img/prev.png" alt=""></a></div>
                <ul>
                    <li><a href="#none" class="on">1</a></li>
                    <li><a href="#none">2</a></li>
                    <li><a href="#none">3</a></li>
                    <li><a href="#none">4</a></li>
                    <li><a href="#none">5</a></li>
                </ul>
                <div class="next_btn"><a href="#none"><img src="img/next.png" alt=""></a></div>
            </div>
            <div class="button_wrap">
                <div class="delete_btn" onclick="del_academy();"><a href="#none">선택삭제</a></div>
            </div>
        </div>

        <!-- 학원등록 -->
        <div class="add_section">
            <form action="chk_ac.php" type="GET" id="ac_name_form">
            <div class="line">
                <div class="name">
                    <div class="lside">
                        <p>학원아이디</p>
                    </div>
                    <div class="rside">
                        <input type="text" placeholder="학원아이디를 입력해주세요" name="ac_id">
                    </div>
                </div>
            </div>
            <div class="line">
                <div class="name">
                    <div class="lside">
                        <p>비밀번호</p>
                    </div>
                    <div class="rside">
                        <input type="password" placeholder="비밀번호를 입력해주세요." name="ac_pw">
                    </div>
                </div>
            </div>
            </form>
        </div>
        <div class="section_footer">
            <div class="button_wrap">
                <div class="add_btn" onclick="submit();"><a href="#none">추가</a></div>
            </div>
        </div>
    </div>
</body>

<?
//$_GET["bo_table"] = "test1";
//include_once ('board.php');
//INSERT INTO `academy` (`client_id`, `event_time`, `admin_id`, `client_name`) VALUES ('11', CURRENT_TIMESTAMP, 'admin', 'admin');

?>

</html>
<script>
    function submit() {
        document.getElementById("ac_name_form").submit();
    }
    function del_academy() {
        if(confirm("삭제하시겠습니까?")) $('#del_form').submit();
    }
</script>