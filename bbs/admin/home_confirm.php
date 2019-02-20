<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MathIT Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="96x96" href="img/f.png">
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/home_confirm.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
</head>

<body>
    <div class="header">
        <div class="logo_wrap">
            <div class="logo"><img src="img/logo.png" alt="logo"></div>
            <p>ADMIN</p>
        </div>
        <nav>
            <div class="nav_menu"><a href="#none" class="on">홈</a></div>
            <div class="nav_menu"><a href="#none">공지사항관리</a></div>
            <div class="nav_menu"><a href="#none">학원별관리</a></div>
            <div class="nav_menu"><a href="#none">정답지관리</a></div>
        </nav>
        <div class="header_right">
            <div class="user_img"><img src="img/user.png" alt="user_img"></div>
            <p class="user_id">admin</p>
            <div class="logout_btn"><a href="login.php">로그아웃</a></div>
            <div class="pass_change_btn"><a href="home_pass_change.php">비밀번호변경</a></div>
        </div>
    </div>
    <div class="section">
        <div class="member_login_box">
            <p>본인확인절차</p>
            <div class="logo_section">
                <div class="logo_login"><img src="img/logo.png" alt="login_logo"></div>
            </div>
            <div class="form_section">
                <form action=""><input type="text" placeholder="이름을 입력해주세요"><input type="text" placeholder="연락처를 입력해주세요"><input type="text" placeholder="이메일주소를 입력해주세요"></form>
            </div>
            <div class="ok_btn">
                <a href="#none">확인</a>
            </div>
        </div>
    </div>
</body>

</html>