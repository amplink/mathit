<?php
	include_once ('_common.php');
	
	if($_SERVER['REQUEST_METHOD'] != 'POST') :

		alert_msg("잘못된 접근방법입니다.");
		location_href("./login.php");
		exit;

	endif;

	$id = trim($_POST['id']);					//아이디
	$pw = trim($_POST['pw']);					//비밀번호
	$ac = trim($_POST['academy_select']);		//학원
	$auto_login = trim($_POST['auto_login']);	//자동로그인

	if($id != true): //아이디

		alert_msg("아이디를 확인해주세요.");
		location_href("./login.php");
		exit;

	elseif($pw != true): //비밀번호
	
		alert_msg("비밀번호를 확인해주세요.");
		location_href("./login.php");
		exit;

	elseif($ac != true): //학원
	
		alert_msg("캠퍼스를 확인해주세요.");
		location_href("./login.php");
		exit;

	endif;


	//선생님 전체 정보 가져오기
	$link = "/api/math/teacher_list?client_no=".$ac;
	$r = api_calls_get($link);

	$i=0;
	for($i=0; $i<count($r); $i++) :

		//선생님 단독 검사
		$link_1 = "/api/math/teacher?client_no=".$ac."&id=".$id;
		$r_1 = api_calls_get($link_1);
		
		//선생님 단독에서 누락된 정보가 있어 전체정보와 비교한다.
		if( $r[$i][0] == $r_1[0] ) :

			$uid	= $r[$i][0];	//UID
			$tid	= $r[$i][1];	//아이디
			$hash	= $r[$i][2];	//비밀번호 해쉬
			$name   = $r[$i][3];	//이름
			$task   = $r[$i][4];	//당담업무
			$hp	    = $r[$i][5];	//핸드폰
			$tel	= $r[$i][6];	//집전화
			$email  = $r[$i][7];	//이메일
			$img	= $r[$i][8];	//IMG(강사사진)
			$memo	= $r[$i][9];	//강사메모

		endif;

	endfor;

	//로그인 처리
	if($uid) :

#################################################################
# 실적용시 이부분 부터 삭제해야함.								#
#################################################################

		//세션저장
		set_session('t_uid', $uid);
		set_session('t_id', $tid);
		set_session('t_name', $name);
		set_session('t_task', $task);
		set_session('t_hp', $hp);
		set_session('t_tel', $tel);
		set_session('t_email', $email);
		set_session('t_img', $img);
		set_session('t_memo', $memo);
		set_session('client_no', $ac);

		//자동 로그인 저장
		if($auto_login == true ) :

			// 3.27
			// 자동로그인 ---------------------------
			// 쿠키 3일 저장
			$key = md5(COOKIE_KEY . $_SERVER['SERVER_ADDR'] . $_SERVER['SERVER_SOFTWARE'] . $_SERVER['HTTP_USER_AGENT'] . $t_id . $ac);
			set_cookie('ck_mb_id', $t_id, 86400 * 3);
			set_cookie('ck_client_no', $ac, 86400 * 3);
			set_cookie('ck_auto', $key, 86400 * 3);
			// 자동로그인 end ---------------------------

		else :

			set_cookie('ck_mb_id', "", 0);
			set_cookie('ck_client_no', "", 0);
			set_cookie('ck_auto', "", 0);
			
		endif;

		//세션저장 여부 체크
		if( get_session('t_uid') ) :
		
			alert_msg($name." 선생(강사)님 (".$task.") 환영합니다.");
			location_href("./home.php");
			exit;

		else:
		
			alert_msg("캠퍼스 또는 아이디 와 비밀번호를 확인해주세요.");	
			location_href("./login.php");
			exit;

		endif;

#################################################################
#  실적용시 이부분 까지 삭제해야함.								#
#################################################################


#################################################################
# 실적용시 이부분 활성화 해야 함								#
#################################################################

/*
		//비밀번호 검증
		if ( password_verify( $pw, $hash ) ) : //(평문암호, 해쉬값)

			//세션저장
			set_session('t_uid', $uid);
			set_session('t_id', $tid);
			set_session('t_name', $name);
			set_session('t_task', $task);
			set_session('t_hp', $hp);
			set_session('t_tel', $tel);
			set_session('t_email', $email);
			set_session('t_img', $img);
			set_session('t_memo', $memo);
			set_session('client_no', $ac);

			//자동 로그인 저장
			if($auto_login == true ) :

				// 3.27
				// 자동로그인 ---------------------------
				// 쿠키 3일 저장
				$key = md5(COOKIE_KEY . $_SERVER['SERVER_ADDR'] . $_SERVER['SERVER_SOFTWARE'] . $_SERVER['HTTP_USER_AGENT'] . $t_id . $ac);
				set_cookie('ck_mb_id', $t_id, 86400 * 3);
				set_cookie('ck_client_no', $ac, 86400 * 3);
				set_cookie('ck_auto', $key, 86400 * 3);
				// 자동로그인 end ---------------------------

			else :

				set_cookie('ck_mb_id', "", 0);
				set_cookie('ck_client_no', "", 0);
				set_cookie('ck_auto', "", 0);
				
			endif;

			//세션저장 여부 체크
			if( get_session('t_uid') ) :
			
				alert_msg($name." 선생(강사)님 (".$task.") 환영합니다.");
				location_href("./home.php");
				exit;

			else:
			
				alert_msg("캠퍼스 또는 아이디 와 비밀번호를 확인해주세요.");	
				location_href("./login.php");
				exit;

			endif;

		}

		else :

			alert_msg("캠퍼스 또는 아이디 와 비밀번호를 확인해주세요.");	
			location_href("./login.php");
			exit;

		endif;


*/
#################################################################
# 실적용시 여기까지 활성화										#
#################################################################


	else :

		alert_msg("캠퍼스 또는 아이디 와 비밀번호를 확인해주세요.");	
		location_href("./login.php");
		exit;

	endif;

	exit;

?>