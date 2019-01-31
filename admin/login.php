<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MathIT Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="hello_text">
            <h3>로그인</h3>
            <p>반갑습니다</p>
        </div>
        <form method='post' action='login_ok.php' id="admin_login_form">
            <div class="login_box">
                <div class="login_inner_wrap">
                    <!-- <div class="login_user_img"> -->
                        <div style="text-align: center;">
                            <img style="width:50%;" src="img/logo.png" alt="user_img">
                        </div>
                    <!-- </div> -->
                    <div class="login_section">
                        <form action="" name="login">
                            <div class="id_wrap">
                                <p class="input_title">아이디</p>
                                <div class="id_box">
                                    <div class="input_img"><img src="img/mail.png" alt="id_mail_img"></div>
                                    <input name="user_id" type="text" placeholder="아이디를 입력해주세요" class="login_input">
                                </div>
                            </div>
                            <div class="pass_wrap">
                                <p class="input_title">비밀번호</p>
                                <div class="pass_box">
                                    <div class="input_img"><img src="img/lock.png" alt="lock_img"></div>
                                    <input name="user_pw" type="password" placeholder="비밀번호를 입력해주세요" class="login_input">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="auto_id">
                        <input type="checkbox">
                        <p>아이디 저장하기</p>
                    </div>
                    <div class="login_btn"><a href="index.php">로그인</a></div>
                </div>
            </div>
        </form>
    </div>
<script>
    //190130 손민석 : 임시체크

</script>
</body>

</html>