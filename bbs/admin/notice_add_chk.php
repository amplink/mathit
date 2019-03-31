<?php
include_once ('_common.php');

//INSERT INTO `notify` (`id`, `client_id`, `target`, `title`, `author`, `type`, `attach_file`, `contents`, `event_time`) VALUES ('eeeee', '125', '0', 'title', 'author', '1', 'awef', 'waefawef', CURRENT_TIMESTAMP);
$r_client_id = $_POST['ac_select'];
$r_target = $_POST['notice_range'];
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
    }else {
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
        }else {
            $sql = "UPDATE `notify` SET `client_id` = '$client_id', `target` = '$target', `title` = '$title', `author` = '$author', `type` = '$type', `contents` = '$contents', `event_time` = CURRENT_TIMESTAMP WHERE  `id` = '".$_GET['id']."';";
        }
        mysqli_query($connect_db, $sql);
    }

    echo "<script>alert('공지 등록이 완료되었습니다.');</script>";
    echo "<script>location.href='./notice_home.php';</script>";

}

?>