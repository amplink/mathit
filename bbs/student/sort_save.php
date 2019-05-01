<?php
include_once ('_common.php');

foreach($_POST['img']  as $p => $id){
    $sort = $p + 1;
    $sql = " UPDATE `upload_photo` SET sort = ".$sort." WHERE seq = ".$id." AND id = '".$_GET['id']."'";
    mysqli_query($connect_db, $sql);
    //echo $sql;
}