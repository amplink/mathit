<?php
	include_once ('_common.php');

	$id = get_cookie('ck_mb_id');
	$ac = get_cookie('ck_client_no');
	$auto_chk = get_cookie('ck_auto');

	if($id != true): //아이디

		alert_msg("아이디를 확인해주세요.");
		location_href("./login.php");
		exit;

	elseif($ac != true): //학원
	
		alert_msg("캠퍼스를 확인해주세요.");
		location_href("./login.php");
		exit;

	elseif($auto_chk != true): //학원
	
		alert_msg("캠퍼스 또는 아이디 와 비밀번호를 확인해주세요.");
		location_href("./login.php");
		exit;

	endif;

	//검증코드
	$key = md5(COOKIE_KEY . $_SERVER['SERVER_ADDR'] . $_SERVER['SERVER_SOFTWARE'] . $_SERVER['HTTP_USER_AGENT'] . $id . $ac );

	if($key == $auto_chk){
		
		$auto_login = 1;	//자동로그인 연장 현재기준에 3일씩 증가

		//선생님 전체 정보 가져오기
		$link = "/api/math/teacher_list?client_no=".$ac;
		$r = api_calls_get($link);

		$i=0;
		for($i=0; $i<count($r); $i++) {
			
			if ($r[$i][2] && $r[$i][1] == $id) {

				$total_uid =  $r[$i][0];	//UID
				$total_tid	= $r[$i][1];		//아이디
				$total_name = $r[$i][3];  //이름
				$total_task = $r[$i][4];	//당담업무
				$total_hp	= $r[$i][5];	//핸드폰
				$total_tel = $r[$i][6];	//집전화
				$total_email = $r[$i][7];	//이메일
				$total_img = $r[$i][8];	//IMG(강사사진)
				$total_memo = $r[$i][9];	//강사메모
			}
		}

		//회원로그인(로그인 강사만)
		$link = "/api/math/teacher?client_no=".$ac."&id=".$id;
		$r = api_calls_get($link);

		$m_uid = $r[0];		//UID
		$m_tid = $r[1];		//아이디
		$m_name = $r[3];	//이름
		$m_task = $r[4];	//당담업무
		$m_hp	= $r[5];	//핸드폰
		$m_tel = $r[6];		//집전화
		$m_email = $r[7];	//이메일
		$m_img = $r[8];		//IMG(강사사진)
		$m_memo = $r[9];	//강사메모


		//로그인 강사 와 전체리스트 에서 비교 ( 누락 정보 없음 처리 )
		//UID 내용 
		if($t_uid == $m_uid):
			
			$uid = $m_uid;

		else :
			
			if($t_uid):

				$uid = $t_uid;

			elseif($m_uid):

				$uid = $m_uid;

			endif;

		endif;


		//아이디 내용 
		if($t_tid == $m_tid):
			
			$t_id = $m_tid;

		else :
			
			if($t_tid):

				$t_id = $t_tid;

			elseif($m_tid):

				$t_id = $m_tid;

			endif;

		endif;

		//이름
		if($t_name == $m_name):
			
			$name = $m_name;

		else :
			
			if($t_name):

				$name = $t_name;

			elseif($m_name):

				$name = $m_name;

			endif;

		endif;

		//당담업무
		if($t_task == $m_task):
			
			$task = $m_task;

		else :
			
			if($t_task):

				$task = $t_task;

			elseif($m_task):

				$task = $m_task;

			endif;

		endif;

		//핸드폰
		if($t_hp == $m_hp):
			
			$hp = $m_hp;

		else :
			
			if($t_hp):

				$hp = $t_hp;

			elseif($m_hp):

				$hp = $m_hp;

			endif;

		endif;

		//전화
		if($t_tel == $m_tel):
			
			$tel = $m_tel;

		else :
			
			if($t_tel):

				$tel = $t_tel;

			elseif($m_tel):

				$tel = $m_tel;

			endif;

		endif;

		//이메일
		if($t_email == $m_email):
			
			$email = $m_email;

		else :
			
			if($t_email):

				$email = $t_email;

			elseif($m_email):

				$email = $m_email;

			endif;

		endif;

		//IMG(강사사진)
		if($t_img == $m_img):
			
			$img = $m_img;

		else :
			
			if($t_img):

				$img = $t_img;

			elseif($m_img):

				$img = $m_img;

			endif;

		endif;

		//강사메모
		if($t_memo == $m_memo):
			
			$memo = $m_memo;

		else :
			
			if($t_memo):

				$memo = $t_memo;

			elseif($m_memo):

				$memo = $m_memo;

			endif;

		endif;


		//로그인 정보
		if($uid){

			//세션저장
			set_session('t_uid', $uid);
			set_session('t_id', $t_id);
			set_session('t_name', $name);
			set_session('t_task', $task);
			set_session('t_hp', $hp);
			set_session('t_tel', $tel);
			set_session('t_email', $email);
			set_session('t_img', $img);
			set_session('t_memo', $memo);
			set_session('client_no', $ac);

			if($auto_login == true){
			
				// 3.27
				// 자동로그인 ---------------------------
				// 쿠키 3일 저장
				$key = md5(COOKIE_KEY . $_SERVER['SERVER_ADDR'] . $_SERVER['SERVER_SOFTWARE'] . $_SERVER['HTTP_USER_AGENT'] . $t_id . $ac);

				set_cookie('ck_mb_id', $t_id, 86400 * 3);
				set_cookie('ck_client_no', $ac, 86400 * 3);
				set_cookie('ck_auto', $key, 86400 * 3);

				//자동로그인 end ---------------------------

			}else {
				
				session_destroy(); //세션삭제

				//쿠키값 삭제
				set_cookie('ck_mb_id', "", 0);
				set_cookie('ck_client_no', "", 0);
				set_cookie('ck_auto', "", 0);
				

				location_href("./index.php");

			}

			alert_msg($name." 선생(강사)님 (".$task.") 환영합니다.");
			location_href("./home.php");
			exit;


		}else {

			session_destroy(); //세션삭제

			//쿠키값 삭제
			set_cookie('ck_mb_id', "", 0);
			set_cookie('ck_client_no', "", 0);
			set_cookie('ck_auto', "", 0);
			
			alert_msg("캠퍼스 또는 아이디 와 비밀번호를 확인해주세요.");	
			location_href("./login.php");
			exit;		

		}

	}else {

		session_destroy(); //세션삭제

		//쿠키값 삭제
		set_cookie('ck_mb_id', "", 0);
		set_cookie('ck_client_no', "", 0);
		set_cookie('ck_auto', "", 0);

		alert_msg("캠퍼스 또는 아이디 와 비밀번호를 확인해주세요.");	
		location_href("./login.php");
		exit;
	}

	exit;
?>