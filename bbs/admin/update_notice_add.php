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
$type = array();
$range = explode(",", $no_res['target']);
$r_size = count($range);

$ac_range = explode(',', $no_res['client_id']);
$ac_r_size = count($ac_range);
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
    <form action="notice_add_chk.php?id=<?=$id;?>" method="POST" id="notice_bbs" enctype="multipart/form-data">
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
                                $i=0;
                                while($ac = mysqli_fetch_array($res)) {
                                    if($ac_range[$i] == $ac['client_id']){
                                        ?>
                                        <option value="<?=$ac["client_id"];?>" id="<?=$ac["client_id"];?>" selected><?=$ac["client_name"];?></option>
                                        <?
                                        $i++;
                                    }else {
                                        ?>
                                        <option value="<?=$ac["client_id"];?>" id="<?=$ac["client_id"];?>"><?=$ac["client_name"];?></option>
                                        <?
                                    }
                                    ?>
                                    <?php
                                }

                                ?>

                            </select>
                            <script type="text/javascript">
                                $('#academy').multiselect({
                                    includeSelectAllOption: true,
                                    selectAllText: "전체선택",
                                    selectAll: function(){
                                    }
                                });
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
                        <div class="radio_group">
                            <input type="checkbox" class="notice_range" id="all_select">
                            <p>전체</p>
                        </div>
                        <div class="radio_group">
                            <input type="checkbox" name="notice_range[]" class="notice_range" value="전임강사" onchange="cancel_chk_all()">
                            <p>전임강사</p>
                        </div>
                        <div class="radio_group">
                            <input type="checkbox" name="notice_range[]" class="notice_range" value="채점강사" onchange="cancel_chk_all()">
                            <p>채점강사</p>
                        </div>
                        <div class="radio_group">
                            <input type="checkbox" name="notice_range[]" class="notice_range" value="학생" onchange="cancel_chk_all()">
                            <p>학생</p>
                        </div>
                    </div>
                </div>
                <div class="board_line">
                    <div class="title_box">
                        <p class="title_text">제목</p>
                    </div>
                    <div class="contents_box">
                        <input type="text" placeholder="제목을 입력해주세요" name="title" value="<?=$no_res['title'];?>" id="title">
                    </div>
                </div>
                <div class="board_line">
                    <div class="title_box">
                        <p class="title_text">첨부파일</p>
                    </div>
                    <!--                <div class="contents_box">-->
                    <input style="margin-top: 15px;" type="file" name="bf_file[]" onchange="file_n_change();">
                    <span id="file_n">현재 파일 : <? echo $no_res['attach_file'];?></span><?php if($no_res['attach_file']) echo "<img src='../teacher/img/close.png' width='20' height='20' style='margin-left: 20px; cursor: pointer;' onclick='minus()' id='close_img'>";?>
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
                    <div class="save_btn" onclick="submit_chk()"><input class="l_save_btn" type="button" value="저장"></div>
                    <div class="cancel_btn"><a href="notice_home.php">취소</a></div>
                </div>
            </div>
        </div>
        <input type="hidden" id="hidden" name="hidden">
    </form>
    </body>
    <?
    for($k=0; $k<$r_size; $k++) {
        echo "<script>$('.notice_range[value=".$range[$k]."]').prop('checked', true);</script>";
    }
    for($k=0; $k<$ac_r_size; $k++) {
        echo "<script>$('option[id=".$ac_range[$k]."]').prop('selected', true);</script>";
    }
    ?>
    <script>
        $("#all_select").on('click', function () {
            if($('#all_select').prop('checked')) $('.radio_group>input[type=checkbox]').prop('checked', true);
            else $('input[type=checkbox]').prop('checked', false);
        });

        $('#notice_div').val("<? echo $no_res['type'];?>");
        function file_n_change() {
            $('#file_n').html("");
        }

        cancel_chk_all();

        $(window).bind('beforeunload', function () {
            return "저장하지 않고 페이지를 벗어나시겠습니까?";
        });

        function submit_chk() {
            if($('.notice_range').val() && $('#title').val()) {
                $(window).unbind('beforeunload');
                $('#notice_bbs').submit();
            }else {
                alert('제목 또는 범위를 입력해주세요.');
            }
        }

        function cancel_chk_all() {
            if($('#all_select').prop('checked', true)) {
                var boxlengh = $('.notice_range').length;
                var checkedlength = $('.notice_range:checked').length;
                if(boxlengh == checkedlength) {
                    $('#all_select').prop('checked', true);
                }else {
                    $('#all_select').prop('checked', false);
                }
            }
            else {
                $('.check_all').prop('checked', true)
            }
        }

        function del_attach() {
            $(window).unbind('beforeunload');
            location.href = 'del_notice_attach.php?id='+'<?php echo $no_res['id'];?>';
        }

        function minus() {
            $('#file_n').text("현재 파일 : ");
            $('#hidden').val("1");
        }

        ClassicEditor
            .create( document.querySelector( '#content' ),  {
                toolbar: [
                    'headings',
                    'bold',
                    'italic',
                    'link',
                    'unlink'
                ]
            })
            .catch( error => {
                console.error( error );
            });
        // window.onbeforeunload = function() {
        //     return true;
        // }
    </script>
<?php
include_once('tail.php');
?>