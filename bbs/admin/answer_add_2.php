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
                    <div class="complete_btn"><a href="answer_manegement.php">완료</a></div>
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
                            <td>
                                <select name="textbook" id="textbook">
                                    <option value="alpha" >알파</option>
                                    <option value="beta" selected>베타</option>
                                </select>
                            </td>
                            <td>
                                <select name="grade" id="grade">
                                    <option value="grade_1">초등 1학년</option>
                                </select>
                            </td>
                            <td><select name="semester" id="semester">
                                    <option value="semester_1">1학기</option>
                                </select></td>
                            <td><select name="unit" id="unit">
                                    <option value="unit_1">단원</option>
                                </select></td>
                            <td><select name="level" id="level">
                                    <option value="level_1">레벨 1</option>
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
                    <div class="r_nav_menu">
                        <p class="on">개념다지기</p>
                    </div>
                    <div class="r_nav_menu">
                        <p class="">단원마무리</p>
                    </div>
                    <div class="r_nav_menu">
                        <p class="">도전문제</p>
                    </div>
                </div>
            </div>
            <div class="downside_2">
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
                        <tr>
                            <td>
                                <div class="plus_icon"><img src="img/plus.png" alt="plus"></div>
                            </td>
                            <td><input type="text" placeholder="문항번호"></td>
                            <td><input type="text" placeholder="정답이미지 추가">
                                <div class="search_btn"><a href="#none">찾기</a></div>
                            </td>
                            <td><input type="text" placeholder="풀이이미지 추가">
                                <div class="search_btn"><a href="#none">찾기</a></div>
                            </td>
                            <td>
                                <div class="minus_icon"><img src="img/minus.png" alt="minus"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="plus_icon"><img src="img/plus.png" alt="plus"></div>
                            </td>
                            <td><input type="text" placeholder="문항번호"></td>
                            <td><input type="text" placeholder="정답이미지 추가">
                                <div class="search_btn"><a href="#none">찾기</a></div>
                            </td>
                            <td><input type="text" placeholder="풀이이미지 추가">
                                <div class="search_btn"><a href="#none">찾기</a></div>
                            </td>
                            <td>
                                <div class="minus_icon"><img src="img/minus.png" alt="minus"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="plus_icon"><img src="img/plus.png" alt="plus"></div>
                            </td>
                            <td><input type="text" placeholder="문항번호"></td>
                            <td><input type="text" placeholder="정답이미지 추가">
                                <div class="search_btn"><a href="#none">찾기</a></div>
                            </td>
                            <td><input type="text" placeholder="풀이이미지 추가">
                                <div class="search_btn"><a href="#none">찾기</a></div>
                            </td>
                            <td>
                                <div class="minus_icon"><img src="img/minus.png" alt="minus"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="plus_icon"><img src="img/plus.png" alt="plus"></div>
                            </td>
                            <td><input type="text" placeholder="문항번호"></td>
                            <td><input type="text" placeholder="정답이미지 추가">
                                <div class="search_btn"><a href="#none">찾기</a></div>
                            </td>
                            <td><input type="text" placeholder="풀이이미지 추가">
                                <div class="search_btn"><a href="#none">찾기</a></div>
                            </td>
                            <td>
                                <div class="minus_icon"><img src="img/minus.png" alt="minus"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>