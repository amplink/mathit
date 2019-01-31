<?
include_once('_common.php');
//"./update_answer_add.php?grade='.$ac_data['grade'].'&semester='.$ac_data['semester'].'&unit='.$ac_data['unit'].'&level='.$ac_data['level'].'&book_type='.$ac_data['book_type'].'"
$grade = $_GET['grade'];
$semester = $_GET['semester'];
$unit = $_GET['unit'];
$level = $_GET['level'];
$book_type = $_GET['book_type'];

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MathIT Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/answer_add_2.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/answer_add.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/nanumsquare.css" />
</head>

<body>
<form action="answer_add_chk.php" method="POST" id="answer_add_form">
    <div class="header" style="width:calc(100% - 40px)">
        <div class="logo_wrap">
            <div class="logo"><img src="img/logo.png" alt="logo"></div>
            <p>ADMIN</p>
        </div>
        <nav>
            <div class="nav_menu"><a href="index.php">홈</a></div>
            <div class="nav_menu"><a href="notice_home.php">공지사항관리</a></div>
            <div class="nav_menu"><a href="academy_option_staff.php">학원별관리</a></div>
            <div class="nav_menu"><a href="answer_manegement.php" class="on">정답지관리</a></div>
        </nav>
        <div class="header_right">
            <div class="user_img"><img src="img/user.png" alt="user_img"></div>
            <p class="user_id">admin</p>
            <div class="logout_btn"><a href="login.php">로그아웃</a></div>
            <div class="pass_change_btn"><a href="home_pass_change.php">비밀번호변경</a></div>
        </div>
    </div>
    <div class="section" style="width:100%">
        <div class="head_section"  style="width:calc(100% - 100px)">
            <div class="upside">
                <p>교재정보 등록</p>
                <div class="btn_wrap">
                    <div class="complete_btn" onclick="myFunction()"><a href="#">완료</a></div>
                    <div class="cancel_btn"><a href="answer_manegement.php">취소</a></div>
                </div>
            </div>
            <div class="downside">
                <table>
                    <thead>
                    <tr>
                        <th>교재구분</th>
                        <th>학년</th>
                        <th>학기</th>
                        <th>단원</th>
                        <th>레벨</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?
//                        $sql = "select * from `answer_master` where `grade` = '$grade' and `semester` = '$semester' and `unit` = '$unit' and `level` = '$level' and `book_type` = '$book_type';";
//                        $g = mysqli_query($connect_db, $sql);
//
//                        $a = mysqli_fetch_array($g);
//

                        ?>
                        <td><select name="book_type" id="textbook">
                                <option value="수학의정석" selected>수학의 정석</option>
                                <option value="국어의정석">국어의 정석</option>
                                <option value="영어의정석">영어의 정석</option>
                            </select></td>
                        <td><select name="grade" id="grade">
                                <option value="3">초등 3학년</option>
                                <option value="4">초등 4학년</option>
                                <option value="5">초등 5학년</option>
                                <option value="6">초등 6학년</option>
                                <option value="7">중등 1학년</option>
                                <option value="8">중등 2학년</option>
                            </select></td>
                        <td><select name="semester" id="semester">
                                <option value="1">1학기</option>
                                <option value="2">2학기</option>
                            </select></td>
                        <td><select name="unit" id="unit" onclick="book_info();">
                                <div id="unit_data"></div>
                            </select></td>
                        <td><select name="level" id="level">
                                <option value="루트">루트</option>
                                <option value="파이">파이</option>
                                <option value="시그마">시그마</option>
                            </select></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="view_section"  style="width:calc(100% - 60px)">
            <div class="upside_2">
                <p>정답지 작성</p>
                <div class="r_nav">
                    <div class="r_nav_menu" onclick="change(1)">
                        <p class="on" id="nav_1">개념마스터</p>
                    </div>
                    <div class="r_nav_menu" onclick="change(2)">
                        <p class="" id="nav_2">개념확인</p>
                    </div>
                    <div class="r_nav_menu" onclick="change(3)">
                        <p class="" id="nav_3">서술과코칭</p>
                    </div>
                    <div class="r_nav_menu" onclick="change(4)">
                        <p class="" id="nav_4">이야기수학</p>
                    </div>
                </div>
            </div>
            <!-- 개념마스터 -->
            <div class="downside_2" id="section_1">
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <th>문항번호</th>
                        <th>정답이미지</th>
                        <th>풀이이미지</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?
                    $sql = "select * from `answer_master` where `grade` = '$grade' and `semester` = '$semester' and `unit` = '$unit' and `level` = '$level' and `book_type` = '$book_type' and `c_name` = '개념마스터' order by `seq` asc;";
                    $res = mysqli_query($connect_db, $sql);

                    while($r = mysqli_fetch_array($res)) {
                    ?>
                    <tr id="item_section_1">
                        <td>
                            <div class="plus_icon" onclick="append_div(this,'a')"><img src="img/plus.png" alt="plus"></div>
                        </td>
                        <td><input type="text" name="a_item_number[]" placeholder="문항번호" value="<?=$r['item_number'];?>"></td>
                        <td><input type="file" name="a_answer_image[]" value="<?=$r['answer_image'];?>"></td>
                        <td><input type="file" name="a_explain_image[]" value="<?=$r['explain_image'];?>"></td>
                        <td>
                            <div class="minus_icon" onclick="delete_div(this)"><img src="img/minus.png" alt="minus"></div>
                        </td>
                    </tr>
                    <?
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <!-- 개념확인 -->
            <div class="downside_2" id="section_2">
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <th>문항번호</th>
                        <th>정답이미지</th>
                        <th>풀이이미지</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr id="item_section_2">
                        <td>
                            <div class="plus_icon" onclick="append_div(this,'b')"><img src="img/plus.png" alt="plus"></div>
                        </td>
                        <td><input type="text" name="b_item_number[]" placeholder="문항번호"></td>
                        <td><input type="file" name="b_answer_image[]"></td>
                        <td><input type="file" name="b_explain_image[]"></td>
                        <td>
                            <div class="minus_icon" onclick="delete_div(this)"><img src="img/minus.png" alt="minus"></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- 서술과 코칭 -->
            <div class="downside_2" id="section_3">
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <th>문항번호</th>
                        <th>정답이미지</th>
                        <th>풀이이미지</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr id="item_section_3">
                        <td>
                            <div class="plus_icon" onclick="append_div(this,'c')"><img src="img/plus.png" alt="plus"></div>
                        </td>
                        <td><input type="text" name="c_item_number[]" placeholder="문항번호"></td>
                        <td><input type="file" name="c_answer_image[]"></td>
                        <td><input type="file" name="c_explain_image[]"></td>
                        <td>
                            <div class="minus_icon" onclick="delete_div(this)"><img src="img/minus.png" alt="minus"></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- 이야기수학 -->
            <div class="downside_2" id="section_4">
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <th>문항번호</th>
                        <th>정답이미지</th>
                        <th>풀이이미지</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr id="item_section_4">
                        <td>
                            <div class="plus_icon" onclick="append_div(this,'d')"><img src="img/plus.png" alt="plus"></div>
                        </td>
                        <td><input type="text" name="d_item_number[]" placeholder="문항번호"></td>
                        <td><input type="file" name="d_answer_image[]"></td>
                        <td><input type="file" name="d_explain_image[]"></td>
                        <td>
                            <div class="minus_icon" onclick="delete_div(this)"><img src="img/minus.png" alt="minus"></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <input type="hidden" id="submit_section_1">
</form>
</body>

</html>
<script>
    $("div#section_1").show();
    $("div#section_2").hide();
    $("div#section_3").hide();
    $("div#section_4").hide();

    $("#unit_data").html("<option value='<? echo $unit; ?>' selected><? echo $unit; ?></option>");
    $("option[value='<? echo $grade; ?>']").prop('selected', true);
    $("option[value='<? echo $semester; ?>']").prop('selected', true);
    //$("option[value='<?// echo $unit; ?>//']").prop('selected', true);
    $("option[value='<? echo $level; ?>']").prop('selected', true);
    $("option[value='<? echo $book_type; ?>']").prop('selected', true);

    function change(n) {
        if(n==1) {
            $("div#section_1").show();
            $("div#section_2").hide();
            $("div#section_3").hide();
            $("div#section_4").hide();
        }
        if(n==2) {
            $("div#section_1").hide();
            $("div#section_2").show();
            $("div#section_3").hide();
            $("div#section_4").hide();
        }
        if(n==3) {
            $("div#section_1").hide();
            $("div#section_2").hide();
            $("div#section_3").show();
            $("div#section_4").hide();
        }
        if(n==4) {
            $("div#section_1").hide();
            $("div#section_2").hide();
            $("div#section_3").hide();
            $("div#section_4").show();
        }
    }

    function append_div(previous,idx) {
        // var t = "a";
        // if(n==1) t = "a";
        // else if(n==2) t = "b";
        // else if(n==3) t = "c";
        // else if(n==4) t = "d";

        var text = '<tr class="item_section">\n' + '<td>\n' +
            '<div class="plus_icon" onclick="append_div(this,idx)">' +
            '<img src="img/plus.png" alt="plus"></div></td>\n' +
            '<td><input type="text" name="'+idx+'_item_number[]" placeholder="문항번호"></td>\n' +
            '<td><input type="file" name="'+idx+'_answer_image[]"></td>\n' +
            '<td><input type="file" name="'+idx+'_explain_image[]"></td>\n' +
            '<td><div class="minus_icon" onclick="delete_div(this)"><img src="img/minus.png" alt="minus"></div></td>\n' +
            '</tr>';
        // $("#item_section_"+n).parent().append(text);
        $(previous).parent().parent().after(text);
    }

    function delete_div(t) {
        $(t).parent().parent().remove();
    }

    function myFunction() {
        $("#answer_add_form").submit();
    }
    function book_info() {
        $.ajax({
            type: "GET",
            url: "book_info.php?grade="+$('#grade option:selected').val()+"&semester="+$('#semester option:selected').val(),
            dataType: "html",
            success: function(response){
                $("#unit").html(response);
            }
        });
    }
</script>