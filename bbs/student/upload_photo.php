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

if($tot > 30) $tot = 30;

//foreach ($sort_arr as $key) {

foreach ($_FILES['files']['name'] as $key => $name) {

    if($j <= 30){

        $upload_dir = "./data/photo/".date("Ym");
        if(!is_dir($upload_dir)){
            mkdir($upload_dir, 0755);
        }
        $upload_dir2 = "./data/photo/".date("Ym")."/".$id;

        if(!is_dir($upload_dir2)){
            mkdir($upload_dir2, 0755);
        }

        $name = $_FILES['files']['name'][$key];
        $uploadName = explode('.', $name);

        $fileSize = $_FILES['files']['size'][$key];
        if($fileSize > 10485760) break;

        // $fileType = $_FILES['files']['type'][$key];
        $uploadname = time().$key.'.'.$uploadName[1];
        $ext = substr($uploadname, strpos($uploadname, ".")+1);
        //$fileinfo  = pathinfo($filename);
        //$ext = $ext['extension'];
        $unencodedData = md5(uniqid(mt_rand(), true));

        $filename = $unencodedData.".".$ext;
        $uploadFile = $upload_dir2."/".$filename;

        //$sno = ($_POST['sort'])?$key:$j;
        $sno = $j;
        $reg_month = date('Ym');
//////////////////////////////////////////////////////////////
        $tmp_file = $_FILES['files']['tmp_name'][$key];
        $sourceProperties = getimagesize($tmp_file);
        $imageType = $sourceProperties[2];

        switch ($imageType) {


            case "3":
                $imageResourceId = imagecreatefrompng($tmp_file);
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagepng($targetLayer,$uploadFile);
                break;


            case "1":
                $imageResourceId = imagecreatefromgif($tmp_file);
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagegif($targetLayer,$uploadFile);
                break;


            case "2":
                $imageResourceId = imagecreatefromjpeg($tmp_file);
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagejpeg($targetLayer,$uploadFile);
                imagedestroy($targetLayer);

                break;


            default:
                echo "png, jpg, gif 형식만 첨부 가능합니다.";
                exit;
                break;
        }

/////////////////////////////////////////////////////////////////////////////


        //if(move_uploaded_file($tmp_file, $uploadFile)){
        $sql = "INSERT INTO `upload_photo` (`id`, `student_id`, `file_name`, `org_file_name`, `sort`, `reg_month`, `reg_date`)
				VALUES ('$id', '$_SESSION[s_id]', '$filename', '$name', '$sno', '$reg_month', now());";
        $result = sql_query($sql);
        if($result) $i++;

        //}

        $j++;
    }
}



function imageResize($imageResourceId,$width,$height) {

    $re_wid = 500;
    if($width <= $re_wid){
        $re_wid = $width;
        $re_hei = $height;
    }
    $re_hei = (int)(($height*$re_wid)/$width);
    $targetLayer=imagecreatetruecolor($re_wid,$re_hei);
    imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$re_wid,$re_hei, $width,$height);

    return $targetLayer;
}



if($tot == $i){

    if($_POST['status'] == "") $step = "1";
    else if($_POST['status'] == "s1") $step = "2";

    $sql2 = "UPDATE homework_assign_list SET 
	            current_status = 'a".$step."', 
				apply_status_".$step." = 'Y',
				submit_date".$step." = now()
			 WHERE id = '$id'";

    $result2 = sql_query($sql2);
    if($result2) echo "success";

}
else if($tot > $i) echo "err";

