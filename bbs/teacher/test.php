<?php
include_once ('_common.php');
include_once ('api.class.php');

$api = new gabiaSmsApi('psemathit','e7e280b259a8b08dd95e605e89637bc1');

//$file_path = array("/img_data/201904/CL2QZ2wS7gjvdJh18g4I.png");
$file_path = array("./img_data/201904/yRGuucbuO1Li4DzUBtLc.png");
$phone = array("010-5396-7566");
//$fp = fopen($file_path[0],"r");
//$fr = fread($fp,filesize($file_path[0]));
//fclose($fp);
//$file_code = base64_encode($fr);
//echo $file_code;
if ($api->multi_mms_send($phone, "02-2282-0331", $file_path,"테스트1", "homework" , "homework", 0) == gabiaSmsApi::$RESULT_OK)
{
    echo("send ok");
    echo("이전 : " . $api->getBefore());
    echo("이후 : " . $api->getAfter());
}
else
{
    echo("SEND FAIL – " . $api->getResultCode() . " : " . $api->getResultMessage());
}

?>