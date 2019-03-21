<?php
include_once('./_common.php');
session_start();

$t = $_GET['t'];
$seq = $_GET['seq'];

$type = $_POST['notice_type'];
$title = $_POST['title'];
$range = $_POST['range'];
$target = $_POST['target'];
$content = $_POST['content'];
$seqq = $_POST['seq'];

$name = $_FILES['bf_file']['tmp_name'][0];
$name_name = $_FILES['bf_file']['name'][0];
//echo $name;
$writer = $_SESSION['t_name'];

if($t == 2) {
    $sql = "delete from `teacher_notice` where `seq` = '$seq';";
    sql_query($sql);
    alert_msg("삭제가 완료되었습니다.");
    location_href("./notice_list.php");
    exit;
}

//if($seqq > 0) {
//    $sql = "delete from `teacher_notice` where  `seq` = '$seqq';";
//    sql_query($sql);
//}

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

for($i=0; $i<count($range); $i++) $r_range .= $range[$i].",";
//for($i=0; $i<count($type); $i++) $r_type .= $type[$i].",";
//alert_msg($r_type);
$r_type = $type;
if($t != 3) {
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
        $im_name_in = "$base_dir/$dir/$name_name";
        $name_url = $base_dir."/".$dir."/";
    }

    $sql = "INSERT INTO `teacher_notice` (`seq`, `title`, `writer`, `type`, `n_range`, `target`, `file_url`, `file_name`, `content`, `event_time`)
            VALUES (NULL, '$title', '$writer', '$r_type', '$r_range', '$target', '$name_url', '$name_name', '$content', CURRENT_TIMESTAMP);";
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
        $im_name_in = "$base_dir/$dir/$name_name";
        $name_url = $base_dir."/".$dir."/";

        $sql = "UPDATE `teacher_notice` SET `title`='$title', `writer`='$writer', `type`='$r_type', `n_range`='$r_range', `target`='$target', `file_url`='$name_url', `file_name`='$name_name', `content`='$content' where `seq`='$seqq';";
        sql_query($sql);
    }else {
        $sql = "UPDATE `teacher_notice` SET `title`='$title', `writer`='$writer', `type`='$r_type', `n_range`='$r_range', `target`='$target', `content`='$content' where `seq`='$seqq';";
        sql_query($sql);
    }
}

if($seqq > 0) {
    alert_msg("공지수정이 완료되었습니다.");
    location_href("./notice_list.php");
}else {
    alert_msg("공지등록이 완료되었습니다.");
    location_href("./notice_list.php");
}
?>