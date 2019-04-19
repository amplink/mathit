<?php
include_once ('_common.php');
include_once ('api.class.php');

$api = new gabiaSmsApi('psemathit','e7e280b259a8b08dd95e605e89637bc1');

if (isset($_POST["canvasData"]))
{

    $imageData = $_POST['canvasData'];
    $imageData = str_replace(' ','+',$imageData);
    $filteredData = substr($imageData, strpos($imageData, ",")+1);
    $unencodedData = base64_decode($filteredData);

    $upload_dir = "./img_data/".date("Ym");

    if(!is_dir($upload_dir)){
        mkdir($upload_dir, 0755);
    }

    $filename = generateRandomString(20).".png";
    $filename = $upload_dir."/".$filename;
    $file = fopen($filename, 'wb');
    fwrite($file, $unencodedData);
    fclose($file);

    $sql = "update `teacher_score` set `img_path`='$filename' where `seq`='$_POST[no]';";
    $result = sql_query($sql);

    $link = "http://teacher.mathitlms.co.kr".$filename;
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
}
