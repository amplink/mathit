<?php
include_once ('_common.php');

$id = $_POST['id'];
$i = 0;
$j = 1;
if($_POST['sort']){
    $sort = str_replace("img[]=","",$_POST['sort']);
    $sort_arr = explode("&", $sort);
}

$tot = count($_FILES['files']['name']);

foreach ($_FILES['files']['name'] as $f => $name) {

    $upload_dir = "./data/photo/".date("Ym");
    if(!is_dir($upload_dir)){
        mkdir($upload_dir, 0755);
    }
    $upload_dir2 = "./data/photo/".date("Ym")."/".$id;

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

    $sno = ($_POST['sort'])?$sort_arr[$f]:$j;
    $reg_month = date('Ym');
    if(move_uploaded_file($_FILES['files']['tmp_name'][$f], $uploadFile)){
        $sql = "INSERT INTO `upload_photo` (`id`, `file_name`, `org_file_name`, `sort`, `reg_month`, `reg_date`)
			VALUES ('$id', '$filename', '$name', '$sno', '$reg_month', now());";
        $result = sql_query($sql);
        if($result) $i++;

    }

    $j++;
}

if($tot == $i){

    if($_POST['status'] == "") $step = "1";
    else if($_POST['status'] == "s1") $step = "2";

    $sql2 = "UPDATE homework_assign_list SET current_status = 'a".$step."', apply_status_".$step." = 'Y' WHERE id = '$id'";
    echo $sql2;
    $result2 = sql_query($sql2);
    if($result2) echo "success";

}
else if($tot > $i) echo "err";

?>