<?php
include_once ('_common.php');

$i = 0;

$sort = str_replace("img[]=","",$_POST['sort']);
$sort_arr = explode("&", $sort);

$tot = count($_FILES['files']['name']);

foreach ($_FILES['files']['name'] as $f => $name) {

    $upload_dir = "./data/photo/".date("Ym");
    if(!is_dir($upload_dir)){
        mkdir($upload_dir, 0755);
    }
    $upload_dir2 = "./data/photo/".date("Ym")."/".$_POST['id'];

    if(!is_dir($upload_dir2)){
        mkdir($upload_dir2, 0755);
    }

    $name = $_FILES['files']['name'][$f];
    $uploadName = explode('.', $name);

    $fileSize = $_FILES['upload']['size'][$f];
    if($fileSize > 5242880) break;

    // $fileType = $_FILES['upload']['type'][$f];
    $uploadname = time().$f.'.'.$uploadName[1];
    $ext = substr($uploadname, strpos($uploadname, ".")+1);
    //$fileinfo  = pathinfo($filename);
    //$ext = $ext['extension'];
    $unencodedData = md5(uniqid(mt_rand(), true));

    $filename = $unencodedData.".".$ext;
    $uploadFile = $upload_dir2."/".$filename;

    $id = $_POST['id'];
    $sno = $sort_arr[$f];

    if(move_uploaded_file($_FILES['files']['tmp_name'][$f], $uploadFile)){
        $sql = "INSERT INTO `upload_photo` (`id`, `file_name`, `org_file_name`, `sort`, reg_date)
			VALUES ('$id', '$filename', '$name', '$sno', now());";
        $result = sql_query($sql);
        if($result) $i++;
    }
}

if($tot == $i) echo "success";
else if($tot > $i) echo "err";

?>