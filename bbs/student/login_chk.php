<?php
include_once ('_common.php');

if($_SERVER['REQUEST_METHOD'] != 'POST') :

    alert_msg("잘못된 접근방법입니다.");
    location_href("./login.php");
    exit;

endif;

$id = trim($_POST['login_id']);					//아이디
$pw = trim($_POST['login_passwd']);					//비밀번호
$ac = trim($_POST['academy_select']);		//학원
$auto_login = trim($_POST['auto_login']);	//자동로그인


if($id != true): //아이디

    echo "아이디를 확인해주세요.";
    exit;

elseif($pw != true): //비밀번호

    echo "비밀번호를 확인해주세요.";
    exit;

elseif($ac != true): //학원

    echo "캠퍼스를 확인해주세요.";
    exit;

endif;


//학생정보 가져오기
$link = "/api/math/student?client_no=".$ac."&id=".$id;
$r = api_calls_get($link);

//print_r($r);

$uid	= $r[0];	//UID
$tid	= $r[1];	//아이디
$hash	= $r[2];	//비밀번호 해쉬
$name   = $r[3];	//이름
$sex   = $r[4];	//성별
$sh_name	= $r[5];	//학교명
$sh_level	= $r[6];	//초중고
$grade  = $r[7];	//학년
$birth	= $r[8];	//생일
$hp	    = $r[9];	//휴대폰
$tel	= $r[10];	//전화번호
$d_uid	= $r[17];	//회차 d_uid
$d_order = $r[18];	//회차이름



//로그인 처리
if($uid) :
#################################################################
# 실적용시 이부분 활성화 해야 함								#
#################################################################
    //비밀번호 검증
    if (password_verify($pw, $hash)) : //(평문암호, 해쉬값)

        //세션저장
        set_session('client_id', $ac);
        set_session('s_uid', $uid);
        set_session('s_id', $tid);
        set_session('s_name', $name);
        set_session('s_grade', $grade);
        set_session('s_hp', $hp);
        set_session('s_tel', $tel);
        set_session('s_level', $sh_level);
        set_session('s_grade', $grade);
        set_session('d_uid', $d_uid);
        set_session('d_order', $d_order);
        $sql = "select `client_name` from `academy` where `client_id`='$ac';";
        $result = sql_query($sql);
        $res = mysqli_fetch_array($result);
        set_session('client_name', $res['client_name']);

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
        if( get_session('s_uid') ) :
            $sql = "select manager_uid from `academy` where `client_id`='$ac';";
            $result = sql_query($sql);
            $res = mysqli_fetch_array($result);
            if($res['manager_uid']==$uid) {
                set_session('admin', 1);
                echo "success";
            }else {
//                alert_msg($name." 선생(강사)님 (".$task.") 환영합니다.");
                set_session('admin', 0);
//                location_href("./home.php");
                echo "success";
            }
            exit;
        endif;

    else :

         echo "캠퍼스 또는 아이디 와 비밀번호를 확인해주세요.";
        //location_href("./login.php?re=1");
        exit;

    endif;

    echo "success";

#################################################################
# 실적용시 여기까지 활성화										#
#################################################################

else :
//
    echo "캠퍼스 또는 아이디 와 비밀번호를 확인해주세요.";
    exit;

endif;

exit;
