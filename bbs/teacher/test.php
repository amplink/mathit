<?php
include_once ('_common.php');
include_once ('api.class.php');

$api = new gabiaSmsApi('psemathit','e7e280b259a8b08dd95e605e89637bc1');

$filename = "./img_data/201904/uswJowXQJFhnINqM1lOd.png";
$file_name = substr($filename, 1);
$link = "http://teacher.mathitlms.co.kr".$file_name;

if($result==1) {
    if($_POST['parent']) {
        if ($api->sms_send($_POST['parent'], "02-2282-0331","성적 확인하기 : $link", "MATH IT" ,0) == gabiaSmsApi::$RESULT_OK) {
            $chk1 = 1;
        }
        else {
            $chk1 = 0;
        }
    }

    if($_POST['add_phone']) {
        if ($api->sms_send($_POST['add_phone'], "02-2282-0331","성적 확인하기 : $link", "MATH IT" ,0) == gabiaSmsApi::$RESULT_OK) {
            $chk2 = 1;
        }
        else {
            $chk2 = 0;
        }
    }

    if($chk1 == 1 || $chk2 == 1) {
        echo  json_encode(array("res" => "success"));
    }else echo  json_encode(array("res" => "fail"));

}
?>