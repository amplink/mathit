<?php
include_once ('_common.php');
ini_set('memory_limit','512M');
$id = $_POST['id'];
$i = 0;
$j = 1;

if($_POST['sort']){
    $sort = str_replace("img[]=","",$_POST['sort']);
    $sort_arr = explode("&", $sort);
}

$tot = count($_FILES['files']['name']);
$tot2 = count($_FILES['files']['name']);

if($tot > 20) $tot = 20;

//foreach ($sort_arr as $key) {
sql_query("START TRANSACTION");

try{
    foreach ($_FILES['files']['name'] as $key => $name) {

        if($j <= 20){

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
            if($fileSize > 10485760){
                echo "사진용량 10M를 초과 하였습니다.\n";
                break;
            }

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
                    $targetLayer = imageResize($tmp_file,$imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                    imagepng($targetLayer,$uploadFile);
                    imagedestroy($targetLayer);
                    break;

                case "1":
                    $imageResourceId = imagecreatefromgif($tmp_file);
                    $targetLayer = imageResize($tmp_file,$imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                    imagegif($targetLayer,$uploadFile);
                    imagedestroy($targetLayer);
                    break;

                case "2":
                    $imageResourceId = imagecreatefromjpeg($tmp_file);
                    $targetLayer = imageResize($tmp_file,$imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                    imagejpeg($targetLayer,$uploadFile);
                    imagedestroy($targetLayer);

                    break;

                default:
                    echo "png, jpg, gif 형식만 첨부 가능합니다.";
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
    sql_query("COMMIT");
}catch(Exception $e){
    sql_query("ROLLBACK");
}


function imageResize($name,$imageResourceId,$width,$height) {

    $re_wid = 700;
    if($width <= $re_wid){
        $re_wid = $width;
        $re_hei = $height;
    }
    $re_hei = (int)(($height*$re_wid)/$width);
    if($re_hei > 750) $re_hei = 750;
    $targetLayer=imagecreatetruecolor($re_wid,$re_hei);
    imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$re_wid,$re_hei, $width,$height);

    $exif = exif_read_data($name);
    if(!empty($exif['Orientation'])) {
        switch($exif['Orientation']) {
            case 8:
                $targetLayer = imagerotate($targetLayer,90,0);
                break;
            case 3:
                $targetLayer = imagerotate($targetLayer,180,0);
                break;
            case 6:
                $targetLayer = imagerotate($targetLayer,-90,0);
                break;
        }
    }

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
else if($tot > $i) echo "정상 제출되지 않았습니다";

