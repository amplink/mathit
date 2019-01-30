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

$id = $_GET['id'];

$sql = "select * from `notify` where `id`='$id';";
$result = mysqli_query($connect_db, $sql);
$no_res = mysqli_fetch_array($result);

//$type = array();
//$range = explode(",", $no_res['target']);

?>
    <!--<!DOCTYPE html>-->
    <!--<html>-->
    <!---->
    <!--<head>-->
    <!--    <meta charset="utf-8" />-->
    <!--    <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <!--    <title>MathIT Admin</title>-->
    <!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
    <!--    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />-->
    <!--    <link rel="stylesheet" type="text/css" media="screen" href="css/notice_add.css" />-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap-multiselect.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
    <!--</head>-->
    <!---->
    <body>
    <!--    <div class="header">-->
    <!--        <div class="logo_wrap">-->
    <!--            <div class="logo"><img src="img/logo.png" alt="logo"></div>-->
    <!--            <p>ADMIN</p>-->
    <!--        </div>-->
    <!--        <nav>-->
    <!--            <div class="nav_menu"><a href="index.php">홈</a></div>-->
    <!--            <div class="nav_menu"><a href="notice_home.php" class="on">공지사항관리</a></div>-->
    <!--            <div class="nav_menu"><a href="academy_option_staff.php">학원별관리</a></div>-->
    <!--            <div class="nav_menu"><a href="answer_manegement.php">정답지관리</a></div>-->
    <!--        </nav>-->
    <!--        <div class="header_right">-->
    <!--            <div class="user_img"><img src="img/user.png" alt="user_img"></div>-->
    <!--            <p class="user_id">admin</p>-->
    <!--            <div class="logout_btn"><a href="login.php">로그아웃</a></div>-->
    <!--            <div class="pass_change_btn"><a href="home_pass_change.php">비밀번호변경</a></div>-->
    <!--        </div>-->
    <!--    </div>-->
    <form action="notice_add_chk.php?id=<?=$id;?>" method="POST" id="notice_bbs">
        <div class="section">
            <div class="head_section">
                <div class="l_title">
                    <p>공지사항 등록</p>
                </div>
            </div>
            <div class="view_section">
                <div class="board_line" style="display:flex">
                    <div class="notice_div">
                        <div class="title_box">
                            <p class="title_text">공지유형</p>
                        </div>
                        <div class="contents_box">
                            <select name="notice_div" id="notice_div">
                                <option value="전체공지">전체공지</option>
                                <option value="일반공지">일반공지</option>
                                <option value="중요공지">중요공지</option>
                            </select>
                        </div>
                    </div>
                    <div class="academy_select">
                        <div class="title_box">
                            <p class="title_text">학원선택</p>
                        </div>
                        <div class="contents_box">

                            <select name="ac_select[]" id="academy" multiple required>
                                <?php
                                $sql = "select * from `academy`";
                                $res = mysqli_query($connect_db, $sql);
                                while($ac = mysqli_fetch_array($res)) {
                                    ?>
                                    <option value="<?=$ac["client_id"];?>" id="<?=$ac["client_id"];?>"><?=$ac["client_name"];?></option>
                                    <?php
                                    $i++;
                                }

                                ?>

                            </select>
                            <script type="text/javascript">
                                $('#academy').multiselect();
                            </script>


                            <!--                            -->
                            <!--                            $sql = "select * from `academy`";-->
                            <!--                            $res = mysqli_query($connect_db, $sql);-->
                            <!--                            while($ac = mysqli_fetch_array($res)) {-->
                            <!--                                echo "<div class='radio_group'>";-->
                            <!--                              echo "<input type='checkbox' name='ac_select[]' class='notice_range' value='".$ac['client_id']."'><p>".$ac['client_name']."</p></div>";-->
                            <!--                            }-->

                        </div>

                    </div>
                </div>
                <div class="board_line">
                    <div class="title_box">
                        <p class="title_text">공지범위</p>
                    </div>
                    <div class="contents_box">
                        <!--                    <div class="radio_group">-->
                        <!--                        <input type="checkbox" class="notice_range" onchange="all_select();">-->
                        <!--                        <p>전체</p>-->
                        <!--                    </div>-->
                        <div class="radio_group">
                            <input type="checkbox" name="notice_range[]" class="notice_range" value="0">
                            <p>전임강사</p>
                        </div>
                        <div class="radio_group">
                            <input type="checkbox" name="notice_range[]" class="notice_range" value="1">
                            <p>채점강사</p>
                        </div>
                        <div class="radio_group">
                            <input type="checkbox" name="notice_range[]" class="notice_range" value="2">
                            <p>학생</p>
                        </div>
                    </div>
                </div>
                <div class="board_line">
                    <div class="title_box">
                        <p class="title_text">제목</p>
                    </div>
                    <div class="contents_box">
                        <input type="text" placeholder="제목을 입력해주세요" name="title" value="<?=$no_res['title'];?>">
                    </div>
                </div>
                <div class="board_line">
                    <div class="title_box">
                        <p class="title_text">첨부파일</p>
                    </div>
                    <!--                <div class="contents_box">-->
                    <input style="margin-top: 15px;" type="file" name="file">
                    <!--                </div>-->
                </div>
                <div class="board_line">
                    <div class="title_box">
                        <p class="title_text">내용</p>
                    </div>

                </div>
                <div class="board_line2" style="overflow: initial">
                    <textarea class="textarea_input" rows="10"  name="content" id="content"><?=trim($no_res['contents']);?></textarea>
                </div>
            </div>
            <div class="section_footer">
                <div class="button_wrap">
                    <div class="save_btn" ><input class="l_save_btn" type="submit" value="저장"></div>
                    <div class="cancel_btn"><a href="notice_home.php">취소</a></div>
                </div>
            </div>
        </div>
    </form>
    </body>
    <script>
        $('option[value="<? echo $no_res['type'];?>"]').attr("selected", true);
        // $("option[value='126']").attr("selected", true);
        <?php
//        for($i=0; $i<count($range)-1; $i++) {
//            echo '$("option[value=\''.$range[$i].'\']").attr("selected", true);';
//        }
        ?>
        ClassicEditor
            .create( document.querySelector( '#content' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
<?php
include_once('tail.php');
?>