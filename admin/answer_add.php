<?
include_once('_common.php');
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
</head>

<body>
<form action="answer_add_chk.php" method="POST" id="answer_add_form">
<div class="header">
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
    <div class="section">
        <div class="head_section">
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
                            <td><select name="book_type" id="textbook">
                                    <option value="math" selected>수학의 정석</option>
                                    <option value="kor">국어의 정석</option>
                                    <option value="eng">영어의 정석</option>
                                </select></td>
                            <td><select name="grade" id="grade">
                                    <option value="grade_1">초등 1학년</option>
                                    <option value="grade_2">초등 2학년</option>
                                    <option value="grade_3">초등 3학년</option>
                                    <option value="grade_4">초등 4학년</option>
                                    <option value="grade_5">초등 5학년</option>
                                    <option value="grade_6">초등 6학년</option>
                                </select></td>
                            <td><select name="semester" id="semester">
                                    <option value="semester_1">1학기</option>
                                    <option value="semester_2">2학기</option>
                                    <option value="semester_3">3학기</option>
                                </select></td>
                            <td><select name="unit" id="unit">
                                    <option value="unit_1">1단원</option>
                                    <option value="unit_2">2단원</option>
                                    <option value="unit_3">3단원</option>
                                    <option value="unit_4">4단원</option>
                                </select></td>
                            <td><select name="level" id="level">
                                    <option value="level_1">레벨 1</option>
                                    <option value="level_2">레벨 2</option>
                                    <option value="level_3">레벨 3</option>
                                </select></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="view_section">
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
                            <th>1문항번호</th>
                            <th>정답이미지</th>
                            <th>풀이이미지</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="item_section_1">
                            <td>
                                <div class="plus_icon" onclick="append_div(1)"><img src="img/plus.png" alt="plus"></div>
                            </td>
                            <td><input type="text" name="a_item_number" placeholder="문항번호"></td>
                            <td><input type="file" name="a_answer_image"></td>
                            <td><input type="file" name="a_explain_image"></td>
                            <td>
                                <div class="minus_icon" onclick="delete_div(1)"><img src="img/minus.png" alt="minus"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- 개념확인 -->
            <div class="downside_2" id="section_2">
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <th>2문항번호</th>
                        <th>정답이미지</th>
                        <th>풀이이미지</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr id="item_section_2">
                        <td>
                            <div class="plus_icon" onclick="append_div(2)"><img src="img/plus.png" alt="plus"></div>
                        </td>
                        <td><input type="text" name="b_item_number" placeholder="문항번호"></td>
                        <td><input type="file" name="b_answer_image"></td>
                        <td><input type="file" name="b_explain_image"></td>
                        <td>
                            <div class="minus_icon" onclick="delete_div(2)"><img src="img/minus.png" alt="minus"></div>
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
                        <th>3문항번호</th>
                        <th>정답이미지</th>
                        <th>풀이이미지</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr id="item_section_3">
                        <td>
                            <div class="plus_icon" onclick="append_div(3)"><img src="img/plus.png" alt="plus"></div>
                        </td>
                        <td><input type="text" name="c_item_number" placeholder="문항번호"></td>
                        <td><input type="file" name="c_answer_image"></td>
                        <td><input type="file" name="c_explain_image"></td>
                        <td>
                            <div class="minus_icon"><img src="img/minus.png" alt="minus"></div>
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
                        <th>4문항번호</th>
                        <th>정답이미지</th>
                        <th>풀이이미지</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr id="item_section_4">
                        <td>
                            <div class="plus_icon" onclick="append_div(4)"><img src="img/plus.png" alt="plus"></div>
                        </td>
                        <td><input type="text" name="d_item_number" placeholder="문항번호"></td>
                        <td><input type="file" name="d_answer_image"></td>
                        <td><input type="file" name="d_explain_image"></td>
                        <td>
                            <div class="minus_icon"><img src="img/minus.png" alt="minus"></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>
</body>

</html>
<script>
    $("div#section_1").show();
    $("div#section_2").hide();
    $("div#section_3").hide();
    $("div#section_4").hide();

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

    function append_div(n) {

        var text = '<tr id="item_section_'+n+'">\n' + '<td>\n' +
            '<div class="plus_icon" onclick="append_div('+n+')">' +
            '<img src="img/plus.png" alt="plus"></div></td>\n' +
            '<td><input type="text" name="a_item_number" placeholder="문항번호"></td>\n' +
            '<td><input type="file" name="a_answer_image"></td>\n' +
            '<td><input type="file" name="a_explain_image"></td>\n' +
            '<td><div class="minus_icon" onclick="delete_div('+n+')"><img src="img/minus.png" alt="minus"></div></td>\n' +
            '</tr>';
        $("#item_section_"+n).parent().append(text);
    }

    function delete_div(n) {
        $("#item_section_" + n + ":last").remove();
    }

    function myFunction() {
        var a = $("input[name='a_item_number']").length;
        var b = new Array(new Array(), new Array());

        for(var i=0; i<a; i++) {
            b[i] = $("input[name='a_item_number']")[i].value;
        }

        alert(b[1]);
    }
</script>
<?

?>