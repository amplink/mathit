<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MathIT Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="96x96" href="img/f.png">
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/notice_read.css" />
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
            <div class="pass_change_btn"><a href="login.php">비밀번호변경</a></div>
        </div>
    </div>
    <div class="section">
        <div class="head_section">
            <div class="l_title">
                <p>공지사항</p>
            </div>
        </div>
        <div class="view_section">
            <div class="board_line">
                <div class="title_box">
                    <p class="title_text">제목</p>
                </div>
                <div class="contents_box">
                    <p class="notice_title"><span>공지사항 제목이 들어갈자리</span></p>
                </div>
            </div>
            <div class="board_line">
                <div class="date_div">
                    <div class="title_box">
                        <p class="title_text">작성일</p>
                    </div>
                    <div class="contents_box">
                        <p>2018-11-15</p>
                    </div>
                </div>
                <div class="writer_div">
                    <div class="title_box">
                        <p class="title_text">작성자</p>
                    </div>
                    <div class="contents_box">
                        <p>작성자이름</p>
                    </div>
                </div>
            </div>
            <div class="board_line">
                <div class="title_box">
                    <p class="title_text">첨부파일</p>
                </div>
                <div class="contents_box">
                    <p class="title_text">파일명.mp3</p>
                    <!-- <input type="text" placeholder="">
                    <div class="input_btn"><a href="#none">첨부파일</a></div> -->
                </div>
            </div>
            <div class="smart_edit_input_section">
                <p class="title_text" style="padding: 10px;">
                    본문내용
                    <br>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
        </div>
        <div class="section_footer">
            <div class="button_wrap">
                <div class="modify_btn"><a href="notice_modify.php">수정</a></div>
                <div class="list_btn"><a href="notice_home.php">목록</a></div>
            </div>
        </div>
    </div>
</body>

</html>