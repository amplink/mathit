<?php
include_once ('_common.php');

	$id = "teacher99";
	$pw = "teacher99";
	$ac = '126';

	//선생님 전체 정보 가져오기
	$link = "/api/math/teacher_list?client_no=".$ac;
	$r = api_calls_get($link);

	//print_r($r);

	$i=0;
	for($i=0; $i<count($r); $i++) {
		
		if ($r[$i][2] && $r[$i][1] == $id) {
		
			$hash = $r[$i][2];

			echo "아이디 : ".$r[$i][1]."<br>";
			echo "비밀번호해쉬 : ".$hash."<br>";

			echo "입력받은 비밀번호 : ".$pw."<br>";


			if (password_verify($pw,$hash)) {

				echo "True";

			} else {

				echo "False";
			}

			echo '<br>';

			


		}

	}




	$link = "/api/math/teacher?client_no=".$ac."&id=".$id;
	$r = api_calls_get($link);

	$m_uid = $r[0];		//UID
	$m_tid = $r[1];		//아이디
	$m_hash = $r[2];	//비밀번호 해쉬
	$m_name = $r[3];	//이름
	$m_task = $r[4];	//당담업무
	$m_hp	= $r[5];	//핸드폰
	$m_tel = $r[6];		//집전화
	$m_email = $r[7];	//이메일
	$m_img = $r[8];		//IMG(강사사진)
	$m_memo = $r[9];	//강사메모

	
	echo $m_tid." ".$m_hash." ";



	//비교
	if (password_verify($pw,$m_hash)) { //(평문암호, 해쉬값)

		echo "True";

	} else {

		echo "False";
	}









?>