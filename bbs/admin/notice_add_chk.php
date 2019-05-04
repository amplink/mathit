<?php
include_once ('_common.php');

//INSERT INTO `notify` (`id`, `client_id`, `target`, `title`, `author`, `type`, `attach_file`, `contents`, `event_time`) VALUES ('eeeee', '125', '0', 'title', 'author', '1', 'awef', 'waefawef', CURRENT_TIMESTAMP);
$r_client_id = $_POST['ac_select'];
$r_target = $_POST['notice_range'];
$range = $_POST['notice_range'];
$title = $_POST['title'];
$author = "관리자";
$type = $_POST['notice_div'];

$name = $_FILES['bf_file']['tmp_name'][0];
$name_name = $_FILES['bf_file']['name'][0];
$contents = $_POST['content'];
$id = date("mds").":".rand(1, 200);

if(count($r_target)==0) {
    echo "<script>alert('공지 범위를 선택해 주세요.');history.back();</script>";
}
else {
    for($i=0; $i<count($r_target); $i++) {
        if($i==count($r_target)-1) $target .= $r_target[$i];
        else $target .= $r_target[$i].",";
    }

    for($i=0; $i<count($r_client_id); $i++) {
        if($i==count($r_client_id)-1) $client_id .= $r_client_id[$i];
        else $client_id .= $r_client_id[$i].",";
    }

    if($name) {
        //저장될 디렉토리
        $base_dir = "file_list";

        //폴더 이름을 유일한값으로 만듬
        $dir = time().(double)microtime();
        //폴더 생성
        @mkdir("$base_dir/$dir",0777);

        //tmp에 저장된 파일 지정한디렉토리로 이동
        move_uploaded_file($name,"$base_dir/$dir/$name_name");

        //DB에 입력할 이름
        $name_url = $base_dir."/".$dir."/";
    }

    if(!$_GET['id']) {
        $sql = "INSERT INTO `notify` (`id`, `client_id`, `target`, `title`, `author`, `type`, `attach_file`, `attach_file_url`, `contents`, `event_time`)
VALUES ('$id', '$client_id', '$target', '$title', '$author', '$type', '$name_name', '$name_url','$contents', CURRENT_TIMESTAMP);";
        sql_query($sql);
        $sql = "INSERT INTO `teacher_notice` SET `client_id` = '$client_id', `seq`= '', `title`='$id', `writer`='관리자', `type`='$type', `n_range`='$target', `target`='$title', `event_time`= CURRENT_TIMESTAMP";
        sql_query($sql);

        // 알림 부분
        $sql = "select * from `teacher_setting`;";
        $result = sql_query($sql);
        while($res = mysqli_fetch_array($result)) {
            for($kk=0; $kk<count($range); $kk++) {
                $t_uid = $res['t_id'];
                if($range[$kk]=="전임강사" && $res['type'] == "전임강사") {
                    $sql = "insert into `alarm` set `seq`='', `content`='새로운 공지가 등록되었습니다.', `table_name`='notice', `target`='$range[$kk]', `uid`='".$res['t_id']."', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
                    sql_query($sql);
                }else if($range[$kk]=="채점강사" && $res['type'] == "채점강사") {
                    $sql = "insert into `alarm` set `seq`='', `content`='새로운 공지가 등록되었습니다.', `table_name`='notice', `target`='$range[$kk]', `uid`='".$res['t_id']."', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
                    sql_query($sql);
                }
            }
        }
        for($c=0; $c<count($r_client_id); $c++) {
            for($kk=0; $kk<count($range); $kk++) {
                if($range[$kk]=="학생") {
                    $ac = $r_client_id[$c];
                    $link = "/api/math/student_list?client_no=".$ac;
                    $r = api_calls_get($link);

                    for($i=1; $i<count($r); $i++) {
                        $sql = "insert into `alarm` set `seq`='', `content`='새로운 공지가 등록되었습니다.', `table_name`='notice', `target`='학생', `uid`='".$r[$i][1]."', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
                        sql_query($sql);
                    }
                    $sql = "select `token` from `fcm`;";
                    $result = sql_query($sql);
                    $tokens = array();
                    while($res = mysqli_fetch_array($result)) {
                        $tokens[] = $res['token'];
                    }
                    $message = "새로운 공지가 등록되었습니다.";
                    send_notification($tokens, $message);
                }
            }
        }

        if(!$_SESSION['admin']) {
            $sql = "insert into `alarm` set `seq`='', `content`='새로운 공지가 등록되었습니다.', `table_name`='notice', `target`='관리자', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
            sql_query($sql);
        }
    }else {
        if($_POST['hidden'] == 1) {
            $sql = "update `notify` set `attach_file`='', `attach_file_url`='';";
            sql_query($sql);
        }
        if($name_name) {
            //저장될 디렉토리
            $base_dir = "file_list";

            //폴더 이름을 유일한값으로 만듬
            $dir = time().(double)microtime();
            //폴더 생성
            @mkdir("$base_dir/$dir",0777);

            //tmp에 저장된 파일 지정한디렉토리로 이동
            move_uploaded_file($name,"$base_dir/$dir/$name_name");

            //DB에 입력할 이름
            $name_url = $base_dir."/".$dir."/";

            $sql = "UPDATE `notify` SET `client_id` = '$client_id', `target` = '$target', `title` = '$title', `author` = '$author', `type` = '$type', `attach_file` = '$name_name', `attach_file_url` = '$name_url', `contents` = '$contents', `event_time` = CURRENT_TIMESTAMP WHERE  `id` = '".$_GET['id']."';";
            sql_query($sql);
            $sql = "UPDATE `teacher_notice` SET `client_id` = '$client_id', `event_time`=CURRENT_TIMESTAMP, `type`='$type', `n_range`='$target', `target`='$title' where `title`='".$_GET['id']."';";
            sql_query($sql);

            // 알림 부분
            $sql = "select * from `teacher_setting`;";
            $result = sql_query($sql);
            while($res = mysqli_fetch_array($result)) {
                for($kk=0; $kk<count($range); $kk++) {
                    $t_uid = $res['t_id'];
                    if($range[$kk]=="전임강사" && $res['type'] == "전임강사") {
                        $sql = "insert into `alarm` set `seq`='', `content`='공지가 수정되었습니다.', `table_name`='notice', `target`='$range[$kk]', `uid`='".$res['t_id']."', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
                        sql_query($sql);
                    }else if($range[$kk]=="채점강사" && $res['type'] == "채점강사") {
                        $sql = "insert into `alarm` set `seq`='', `content`='공지가 수정되었습니다.', `table_name`='notice', `target`='$range[$kk]', `uid`='".$res['t_id']."', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
                        sql_query($sql);
                    }
                }
            }

            for($c=0; $c<count($r_client_id); $c++) {
                for($kk=0; $kk<count($range); $kk++) {
                    if($range[$kk]=="학생") {
                        $ac = $r_client_id[$c];
                        $link = "/api/math/student_list?client_no=".$ac;
                        $r = api_calls_get($link);

                        for($i=1; $i<count($r); $i++) {
                            $sql = "insert into `alarm` set `seq`='', `content`='공지가 수정되었습니다.', `table_name`='notice', `target`='학생', `uid`='".$r[$i][1]."', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
                            sql_query($sql);
                        }
                        $sql = "select `token` from `fcm`;";
                        $result = sql_query($sql);
                        $tokens = array();
                        while($res = mysqli_fetch_array($result)) {
                            $tokens[] = $res['token'];
                        }
                        $message = "새로운 공지가 등록되었습니다.";
                        send_notification($tokens, $message);
                    }
                }
            }

            if(!$_SESSION['admin']) {
                $sql = "insert into `alarm` set `seq`='', `content`='공지가 수정되었습니다.', `table_name`='notice', `target`='관리자', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
                sql_query($sql);
            }
        }else {
            $sql = "UPDATE `notify` SET `client_id` = '$client_id', `target` = '$target', `title` = '$title', `author` = '$author', `type` = '$type', `contents` = '$contents', `event_time` = CURRENT_TIMESTAMP WHERE  `id` = '".$_GET['id']."';";
            sql_query($sql);
            $sql = "UPDATE `teacher_notice` SET `client_id` = '$client_id', `event_time`=CURRENT_TIMESTAMP, `type`='$type', `n_range`='$target', `target`='$title' where `title`='".$_GET['id']."';";
            sql_query($sql);

            // 알림 부분
            $sql = "select * from `teacher_setting`;";
            $result = sql_query($sql);
            while($res = mysqli_fetch_array($result)) {
                for($kk=0; $kk<count($range); $kk++) {
                    $t_uid = $res['t_id'];
                    if($range[$kk]=="전임강사" && $res['type'] == "전임강사") {
                        $sql = "insert into `alarm` set `seq`='', `content`='공지가 수정되었습니다.', `table_name`='notice', `target`='$range[$kk]', `uid`='".$res['t_id']."', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
                        sql_query($sql);
                    }else if($range[$kk]=="채점강사" && $res['type'] == "채점강사") {
                        $sql = "insert into `alarm` set `seq`='', `content`='공지가 수정되었습니다.', `table_name`='notice', `target`='$range[$kk]', `uid`='".$res['t_id']."', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
                        sql_query($sql);
                    }
                }
            }

            for($c=0; $c<count($r_client_id); $c++) {
                for($kk=0; $kk<count($range); $kk++) {
                    if($range[$kk]=="학생") {
                        $ac = $r_client_id[$c];
                        $link = "/api/math/student_list?client_no=".$ac;
                        $r = api_calls_get($link);

                        for($i=1; $i<count($r); $i++) {
                            $sql = "insert into `alarm` set `seq`='', `content`='공지가 수정되었습니다.', `table_name`='notice', `target`='학생', `uid`='".$r[$i][1]."', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
                            sql_query($sql);
                        }
                        $sql = "select `token` from `fcm`;";
                        $result = sql_query($sql);
                        $tokens = array();
                        while($res = mysqli_fetch_array($result)) {
                            $tokens[] = $res['token'];
                        }
                        $message = "새로운 공지가 등록되었습니다.";
                        send_notification($tokens, $message);
                    }
                }
            }

            if(!$_SESSION['admin']) {
                $sql = "insert into `alarm` set `seq`='', `content`='공지가 수정되었습니다.', `table_name`='notice', `target`='관리자', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
                sql_query($sql);
            }
        }
    }

    echo "<script>alert('완료되었습니다.');</script>";
    echo "<script>location.href='./notice_home.php';</script>";

}

?>