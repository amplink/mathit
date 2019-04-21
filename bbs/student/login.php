<?php
include_once ('_common.php');
?>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MATH IT - student</title>
    <meta http-equiv="Expires" content="Mon, 06 Jan 1990 00:00:01 GMT">
    <meta http-equiv="Expires" content="-1">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="icon" type="image/png" sizes="96x96" href="img/f.png">
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
    <script src="js/jquery-ui.js"></script>
</head>
<body>
    <div class="back_img"></div>
    <div class="page_wrap">
        <div class="login_wrap">
        <div class="logo">
            <img src="img/logo_notext.png" alt="login_logo">
        </div>
        <div class="input_wrap">
            <form action="">
                <div class="input_box"><input type="text" placeholder="ID"></div>
                <div class="input_box"><input type="password" placeholder="Password"></div>
            </form>
        </div>
        <div class="aca_select">
            <select name="aca_select" id="aca_select">
                <option value="base" style="background-color: rgba(255, 255, 255, .2);">학원 선택</option>
                <option value="academy_1">수학 학원</option>
            </select>
        </div>
        <div class="login_btn">
            <a href="home.php">Log In</a>
        </div>
        <div class="auto_login">
            <input type="checkbox">
            <p>자동 로그인</p>
        </div>
    </div>
    </div>
</body>
</html>