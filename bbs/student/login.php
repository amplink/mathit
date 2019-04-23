<?php
include_once ('_common.php');
//include_once ('head.php');
//캠퍼스 선택
$sql = "select client_id, client_name from `academy`";
$result = sql_query($sql);

//로그인이 되어 있는지 확인 후 첫페이지 이동.
if( get_session( 's_uid' ) ) {
    location_href("./home.php");
    exit;
}

$re = $_GET['re'];
?>

<!DOCTYPE html>
<html>
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
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css?v=20190423" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
    <script src="js/jquery-ui.js"></script>
</head>
<body>
<!-- 배경 -->
<div class="bg">
    <div class="bg_div"></div>
    <div class="bg_div"></div>
    <div class="bg_div"></div>
</div>

<!-- 메인 헤더 -->
<header>
    <div class="head_logo"><a href="home.php"><img src="img/logo_notext.png" alt="header_logo"></a></div>
</header>

    <div class="back_img"></div>
    <div class="page_wrap">
        <div class="login_wrap">
        <div class="logo">
            <img src="img/logo_notext1.png" alt="login_logo">
        </div>

        <form id="login_form">
            <div class="input_wrap">

                    <div class="input_box"><input type="text" placeholder="ID" name="login_id" id="login_id" value="fico21soft"></div>
                    <div class="input_box"><input type="password" placeholder="Password" name="login_passwd" id="login_passwd" value="fico21soft"></div>

            </div>
            <div class="aca_select">
                <select name="academy_select" id="academy_select">
                    <option value="" style="background-color: rgba(255, 255, 255, .2);">학원 선택</option>
                    <?php
                    while( $res = sql_fetch_array($result) ) {
                        echo "<option value='".$res['client_id']."'>".$res['client_name']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="login_btn" id="login_btn" style="cursor: pointer">
                <a>LOGIN</a>
            </div>
            <div class="auto_login">
                <input type="checkbox" name="auto_login" id="auto_login">
                <p>자동 로그인</p>
            </div>
        </form>
    </div>
    </div>


        <script type="text/javascript">

            $(document).ready(function() {

                var form			= $("#login_form");
                var id				= $("#login_id");
                var passwd			= $("#login_passwd");
                var academy			= $("#academy_select");
                var auto_login		= $("#auto_login");

                $("#login_btn").click(function(){

                    if(id.val() == ""){
                        alert('아이디를 입력하세요');
                        id.focus();
                        return false;
                    }else if(passwd.val() == ""){
                        alert('비밀번호를 입력하세요');
                        passwd.focus();
                        return false;
                    }else if(academy.val() == ""){
                        alert('캠퍼스를 선택하세요');
                        academy.focus();
                        return false;
                    }



                     var url="login_chk.php";
                     var params=$("#login_form").serialize();
                       $.ajax({
                          type:"POST",
                          url:url,
                          data:params,
                          dataType:"text",
                          success:function(data){
                            if(data == "success") location.href = "./home.php";
                            else alert(data);
                          },
                          error:function(e){
                            alert(e.responseText);
                          }
                     });


                });
                $(auto_login).click(function(){
                    if ($(this).is(":checked")) {
                        if(!confirm(" 자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?"))
                            return false;
                    }
                });
                //아이디 엔터
                $(id).keypress(function(event){
                    if ( event.which == 13 ) {
                        $(passwd).focus();
                        return false;
                    }
                });
                //비밀번호 엔터
                $(passwd).keypress(function(event){
                    if ( event.which == 13 ) {
                        $(login_btn).click();
                        return false;
                    }
                });
                //캠퍼스 선택후 엔터
                $(academy).keypress(function(event){
                    if ( event.which == 13 ) {
                        $(login_btn).click();
                        return false;
                    }
                });

            });

    </script>
<footer>
    <p class="copyright"><span>copyright ⓒ 2019 PSE corp. All Rights Reserved.</span></p>
</footer>
</body>
</html>