<?php
include_once ('_common.php');

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

    if($result == 1)  echo  json_encode(array("res" => "success"));
}

