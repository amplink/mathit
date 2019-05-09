<?php
include_once('./_common.php');
session_start();

$t = $_GET['t'];
$seq = $_GET['seq'];
$ac = $_SESSION['client_no'];

$type = $_POST['notice_type'];
$title = $_POST['title'];
$range = $_POST['range'];
$target = $_POST['target'];
$content = $_POST['content'];
$seqq = $_POST['seq'];

$name = $_FILES['bf_file']['tmp_name'];
$name_name = $_FILES['bf_file']['name'];

for($i=0; $i<count($target); $i++) {
    $t = explode('/', $target[$i]);
    $d_uid .= $t[0]."/";
    $c_uid .= $t[1]."/";
    $s_uid .= $t[2]."/";
}

//var_dump($target);

$writer = $_SESSION['t_name'];

$sql = "select * from `teacher_notice`;";
$result = sql_query($sql);

if(!$seqq) {
    while($res = mysqli_fetch_array($result)) {
        if($res['title']==$title) {
            alert_msg("중복된 제목입니다.");
            echo "<script>history.back();</script>";
            exit;
        }
    }
}

if($t == 2) {
    $sql = "delete from `teacher_notice` where `seq` = '$seq';";
    sql_query($sql);
    alert_msg("삭제가 완료되었습니다.");
    location_href("./notice_list.php");
    exit;
}

if(count($range) == 0) {
    alert_msg("공지범위를 설정해주세요.");
    echo "<script>history.back();</script>";
    exit;
}

if(count($type) == 0) {
    alert_msg("공지유형을 설정해주세요.");
    echo "<script>history.back();</script>";
    exit;
}



for($i=0; $i<count($range); $i++) {
    if($i==count($range)-1) $r_range .= $range[$i];
    else $r_range .= $range[$i].",";
}
//for($i=0; $i<count($type); $i++) $r_type .= $type[$i].",";
//alert_msg($r_type);
for($i=0; $i<count($target); $i++) {
    if($i==count($target)-1) $r_target .= $target[$i];
    else $r_target .= $target[$i].",";
}

if($seqq > 0) { // 수정이면
    $sql = "select * from `teacher_notice` where  `seq` = '$seqq';";
    $result = sql_query($sql);
    $res = mysqli_fetch_array($result);
    if($res['file_url'] && !$name) {
        $name_name = $res['file_name'];
        $name_url = $res['file_url'];
    }
    if($name) {
        //저장될 디렉토리
        $base_dir = "img_data";

        //폴더 이름을 유일한값으로 만듬
        $dir = time().(double)microtime();
        //폴더 생성
        @mkdir("$base_dir/$dir",0777);

        //tmp에 저장된 파일 지정한디렉토리로 이동
        move_uploaded_file($name,"$base_dir/$dir/$name_name");

        //DB에 입력할 이름
        $name_url = $base_dir."/".$dir."/";
    }
    $sql = "delete from `teacher_notice` where  `seq` = '$seqq';";
    sql_query($sql);
}else {
    if($name) {
        //저장될 디렉토리
        $base_dir = "img_data";

        //폴더 이름을 유일한값으로 만듬
        $dir = time().(double)microtime();
        //폴더 생성
        @mkdir("$base_dir/$dir",0777);

        //tmp에 저장된 파일 지정한디렉토리로 이동
        move_uploaded_file($name,"$base_dir/$dir/$name_name");

        //DB에 입력할 이름
        $name_url = $base_dir."/".$dir."/";

    }
}
if($_SESSION['admin']) $writer = "관리자";

$sql = "INSERT INTO `teacher_notice` (`seq`, `client_id`, `d_uid`, `c_uid`, `s_uid`, `title`, `writer`, `type`, `n_range`, `target`, `file_url`, `file_name`, `content`, `event_time`)
VALUES (NULL, '$ac', '$d_uid', '$c_uid', '$s_uid','$title', '$writer', '$type', '$r_range', '$target', '$name_url', '$name_name', '$content', CURRENT_TIMESTAMP);";
sql_query($sql);

if($seqq > 0) {
    $sql = "select * from `teacher_setting`;";
    $result = sql_query($sql);
    while($res = mysqli_fetch_array($result)) {
        for($kk=0; $kk<count($range); $kk++) {
            $t_uid = $res['t_id'];
            if($range[$kk]=="전임강사" && $res['type'] == "전임강사") {
                if($t_uid != $_SESSION['t_uid']) {
                    $sql = "insert into `alarm` set `seq`='', `content`='공지가 수정되었습니다.', `table_name`='notice', `target`='$range[$kk]', `uid`='".$res['t_id']."', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
                    sql_query($sql);
                }
            }else if($range[$kk]=="채점강사" && $res['type'] == "채점강사") {
                if($t_uid != $_SESSION['t_uid']) {
                    $sql = "insert into `alarm` set `seq`='', `content`='공지가 수정되었습니다.', `table_name`='notice', `target`='$range[$kk]', `uid`='".$res['t_id']."', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
                    sql_query($sql);
                }
            }
        }
    }

    for($kk=0; $kk<count($range); $kk++) {
        if($range[$kk]=="학생") {
            $ac = $_SESSION['client_no'];
            $link = "/api/math/student_list?client_no=".$ac;
            $r = api_calls_get($link);

            for($i=1; $i<count($r); $i++) {
                $sql = "insert into `alarm` set `seq`='', `content`='공지가 수정되었습니다.', `table_name`='notice', `target`='학생', `uid`='".$r[$i][1]."', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
                sql_query($sql);
            }
            $sql = "select * from `fcm`;";
            $result = sql_query($sql);
            $tokens = array();
            $i_tokens = array();
            while($res = mysqli_fetch_array($result)) {
                $sql1 = "select `push_alarm` from `student_table` where `id`='".$res['uid']."';";
                $result1 = sql_query($sql1);
                $res1 = mysqli_fetch_array($result1);
                if($res1['push_alarm']) {
                    if($res['iphone']) $i_tokens[] = $res['token'];
                    else $tokens[] = $res['token'];
                }
            }
            $message = "공지가 수정되었습니다.";
            if(count($tokens) > 0) send_notification($tokens, $message);
            if(count($i_tokens) > 0) send_notification_ios($i_tokens, $message);
        }
    }

    if(!$_SESSION['admin']) {
        $sql = "insert into `alarm` set `seq`='', `content`='공지가 수정되었습니다.', `table_name`='notice', `target`='관리자', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
        sql_query($sql);
    }

    alert_msg("공지수정이 완료되었습니다.");
    location_href("./notice_list.php");
}else {
    $sql = "select * from `teacher_setting`;";
    $result = sql_query($sql);
    while($res = mysqli_fetch_array($result)) {
        for($kk=0; $kk<count($range); $kk++) {
            $t_uid = $res['t_id'];
            if($range[$kk]=="전임강사" && $res['type'] == "전임강사") {
                if($t_uid != $_SESSION['t_uid']) {
                    $sql = "insert into `alarm` set `seq`='', `content`='새로운 공지가 등록되었습니다.', `table_name`='notice', `target`='$range[$kk]', `uid`='".$res['t_id']."', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
                    sql_query($sql);
                }
            }else if($range[$kk]=="채점강사" && $res['type'] == "채점강사") {
                if($t_uid != $_SESSION['t_uid']) {
                    $sql = "insert into `alarm` set `seq`='', `content`='새로운 공지가 등록되었습니다.', `table_name`='notice', `target`='$range[$kk]', `uid`='".$res['t_id']."', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
                    sql_query($sql);
                }
            }
        }
    }

    for($kk=0; $kk<count($range); $kk++) {
        if($range[$kk]=="학생") {
            $ac = $_SESSION['client_no'];
            $link = "/api/math/student_list?client_no=".$ac;
            $r = api_calls_get($link);

            for($i=1; $i<count($r); $i++) {
                $sql = "insert into `alarm` set `seq`='', `content`='새로운 공지가 등록되었습니다.', `table_name`='notice', `target`='학생', `uid`='".$r[$i][1]."', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
                sql_query($sql);
            }
            $sql = "select * from `fcm`;";
            $result = sql_query($sql);
            $tokens = array();
            $i_tokens = array();
            while($res = mysqli_fetch_array($result)) {
                $sql1 = "select `push_alarm` from `student_table` where `id`='".$res['uid']."';";
                $result1 = sql_query($sql1);
                $res1 = mysqli_fetch_array($result1);
                if($res1['push_alarm']) {
                    if($res['iphone']) $i_tokens[] = $res['token'];
                    else $tokens[] = $res['token'];
                }
            }
            $message = "새로운 공지가 등록되었습니다.";
            if(count($tokens) > 0) send_notification($tokens, $message);
            if(count($i_tokens) > 0) send_notification_ios($i_tokens, $message);
        }
    }

    if(!$_SESSION['admin']) {
        $sql = "insert into `alarm` set `seq`='', `content`='새로운 공지가 등록되었습니다.', `table_name`='notice', `target`='관리자', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
        sql_query($sql);
    }

    alert_msg("공지등록이 완료되었습니다.");
    location_href("./notice_list.php");
}
?>