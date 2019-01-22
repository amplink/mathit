<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MathIT Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/notice_home.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
</head>

<body>
    <div class="header">
        <div class="logo_wrap">
            <div class="logo"><img src="img/logo.png" alt="logo"></div>
            <p>ADMIN</p>
        </div>
        <nav>
            <div class="nav_menu"><a href="index.php">홈</a></div>
            <div class="nav_menu"><a href="notice_home.php" class="on">공지사항관리</a></div>
            <div class="nav_menu"><a href="academy_option_staff.php">학원별관리</a></div>
            <div class="nav_menu"><a href="answer_manegement.php">정답지관리</a></div>
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
            <div class="l_title">
                <p>공지사항</p>
            </div>
            <div class="search_box_wrap">
                <div class="search_input_box"><input type="text"></div>
                <div class="search_btn"><a href="#none">검색</a></div>
            </div>
        </div>
        <div class="view_section">
            <table>
                <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>번호</th>
                        <th>유형</th>
                        <th>제목</th>
                        <th>공지범위</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>1</td>
                        <td>일반공지</td>
                        <td><a href="notice_read.php">공지사항입니다</a></td>
                        <td>전체</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>2</td>
                        <td>일반공지</td>
                        <td><a href="notice_read.php">공지사항입니다</a></td>
                        <td>전임강사, 채점강사</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td>3</td>
                        <td>중요공지</td>
                        <td><a href="notice_read.php">공지사항입니다</a></td>
                        <td>채점강사, 학생</td>
                    </tr>
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
                <div class="add_btn"><a href="notice_add.php">공지등록</a></div>
                <div class="delete_btn"><a href="#none">삭제</a></div>
            </div>
        </div>
    </div>
</body>

</html>