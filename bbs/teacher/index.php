<?php
	include_once('_common.php');

	define('_INDEX_', true);
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

	//if (G5_IS_MOBILE) {
	//    include_once(G5_THEME_MOBILE_PATH.'/index.php');
	//    return;
	//}


	/****************************************/
	/* 자동로그인 관련 로직 추가			*/
	/****************************************/

	//쿠키 검사후 세션 검사
	if(get_cookie('ck_auto')){ //쿠키값이 있는지 확인 있다면

		if( $_SESSION['t_uid'] ) { //세션값 존재
			
			location_href("./home.php");
			exit;

		}else { //세션값이 존재 하지 않지만, 쿠키값은 살아있을 경우.)

			location_href("./auto_login.php");
			exit;

		}

	}else { //쿠키값이 없지만 세션값만 있는 경우.

		if( $_SESSION['t_uid'] ) { //세션값 존재
			
			location_href("./home.php");
			exit;

		}else { //세션값 및 쿠키값이 존재 하지 않음.
			
			location_href("./login.php");
			exit;

		}
	}
?>