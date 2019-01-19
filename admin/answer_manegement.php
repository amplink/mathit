<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MathIT Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/answer_manegement.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
</head>

<body>
    <div class="header">
        <div class="logo_wrap">
            <div class="logo"><img src="img/logo.png" alt="logo"></div>
            <p>ADMIN</p>
        </div>
        <nav>
            <div class="nav_menu"><a href="#none">홈</a></div>
            <div class="nav_menu"><a href="notice_home.php">공지사항관리</a></div>
            <div class="nav_menu"><a href="academy_option_staff.php">학원별관리</a></div>
            <div class="nav_menu"><a href="#none" class="on">정답지관리</a></div>
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
            <p>정답지 목록</p>
        </div>
        <div class="view_section">
            <table>
                <thead>
                    <tr>
                        <th>학년</th>
                        <th>학기</th>
                        <th>단원</th>
                        <th>레벨</th>
                        <th>교재구분</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span>초3</span></td>
                        <td><span>1학기</span></td>
                        <td><span>1단원</span></td>
                        <td><span>루트</span></td>
                        <td><span>알파</span></td>
                    </tr>
                    <tr>
                        <td><span>초3</span></td>
                        <td><span>1학기</span></td>
                        <td><span>1단원</span></td>
                        <td><span>루트</span></td>
                        <td><span>알파</span></td>
                    </tr>
                    <tr>
                        <td><span>초3</span></td>
                        <td><span>1학기</span></td>
                        <td><span>1단원</span></td>
                        <td><span>루트</span></td>
                        <td><span>알파</span></td>
                    </tr>
                    <tr>
                        <td><span>초3</span></td>
                        <td><span>1학기</span></td>
                        <td><span>1단원</span></td>
                        <td><span>루트</span></td>
                        <td><span>알파</span></td>
                    </tr>
                    <tr>
                        <td><span>초3</span></td>
                        <td><span>1학기</span></td>
                        <td><span>1단원</span></td>
                        <td><span>루트</span></td>
                        <td><span>알파</span></td>
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
                <div class="add_btn"><a href="answer_add.php">정답지추가</a></div>
                <!-- <div class="modify_btn"><a href="#none">수정</a></div> -->
            </div>
        </div>
    </div>
</body>

</html>