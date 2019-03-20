<?php

	include_once('_common.php');

	//캠퍼스 선택
	$sql = "select * from `academy`";
	$result = sql_query($sql);

	//로그인이 되어 있는지 확인 후 첫페이지 이동.
	if( get_session( 't_uid' ) ) {

		location_href("./home.php");
		exit;
	}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MathIt - teacher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="96x96" href="img/f.png">
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />
    <script src="js/jquery-3.3.1.min.js"></script>

	<script type="text/javascript" language="javascript">

		$( document ).ready(function() {

			var form			= $("#login_form");
			var id				= $("#login_id");
			var passwd			= $("#login_passwd");
			var academy			= $("#academy_select");
			var auto_login		= $("#auto_login");
			var login_btn		= $("#login_btn_section");

			$(login_btn).click(function(){

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

				}else {
					
					$(form).attr('action','./login_chk.php');
					$(form).attr('method','POST');					
					$(form).submit();
					return true;

				}

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
</head>

<body>
<div class="login_box">
    <div class="logo_line">
        <div class="login_logo"><img src="img/logo.png" alt="login_logo"></div>
    </div>
    <p class="login_info">아이디와 비밀번호를 입력해주세요</p>
    <div class="login_input_section">

        <form id="login_form">

            <input type="text" placeholder="아이디" name="id" id='login_id' required>

            <input type="password" placeholder="비밀번호" name="pw" id='login_passwd'  required>

            <select name="academy_select" id="academy_select" required>

                <option value="">캠퍼스선택</option>
                <?php
					while( $res = sql_fetch_array($result) ) {
					    echo "<option value='".$res['client_id']."'>".$res['client_name']."</option>";
					}
                ?>

            </select>

            <div class="id_save">
				<input type="checkbox" name="auto_login" value="1" id="auto_login">
                <p>자동로그인</p>
            </div>

        </form>
    </div>
    <div class="login_error_section" id="error_div">
<!--        <p style="color: red;">아이디 또는 비밀번호가 틀렸습니다.</p>-->
    </div>

    <div class="login_btn_section" id="login_btn_section">
        <a onclick="">로그인</a>
    </div>
</div>
</body>

</html>
