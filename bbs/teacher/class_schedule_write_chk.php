<?php
include_once ('_common.php');
session_start();

$type = $_POST['write_type'];
$title = $_POST['title'];
$range = $_POST['read_range'];
$content = $_POST['content'];

$name = $_FILES['bf_file']['tmp_name'][0];
$name_name = $_FILES['bf_file']['name'][0];

$writer = $_SESSION['t_name'];

if($t == 2) {
    $sql = "delete from `teacher_notice` where `seq` = '$seq';";
    sql_query($sql);
    alert_msg("삭제가 완료되었습니다.");
    location_href("./notice_list.php");
    exit;
}

if($seqq > 0) {
    $sql = "delete from `teacher_notice` where  `seq` = '$seqq';";
    sql_query($sql);
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

for($i=0; $i<count($range); $i++) $r_range .= $range[$i].",";
for($i=0; $i<count($type); $i++) $r_type .= $type[$i].",";
//alert_msg($r_type);

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

$sql = "INSERT INTO `teacher_notice` (`seq`, `title`, `writer`, `type`, `n_range`, `target`, `file_url`, `file_name`, `content`, `event_time`)
VALUES (NULL, '$title', '$writer', '$r_type', '$r_range', '$target', '$base_dir/$dir/', '$name_name', '$content', CURRENT_TIMESTAMP);";
sql_query($sql);

if($seqq > 0) {
    alert_msg("공지수정이 완료되었습니다.");
    location_href("./notice_list.php");
}else {
    alert_msg("공지등록이 완료되었습니다.");
    location_href("./notice_list.php");
}


?>