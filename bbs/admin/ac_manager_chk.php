<?php

include_once ('_common.php');

$manager_id = $_POST['manager_id'];
$manager_name = $_POST['manager_name'];
$ac_name = $_POST['ac_name'];

//$chk_list = $_POST['chk_list'];
//echo $ac_name;
//exit;

if(!$manager_id){
    echo "<script>alert('관리자 아이디를 확인 해 주세요');</script>";
    echo "<script>location.href='./academy_option_staff.php';</script>";
}else if(!$ac_name) {
    echo "<script>alert('학원을 선택해 주세요');</script>";
    echo "<script>history.back(-1);</script>";
}else{
    $sql = "UPDATE `academy` SET `manager_id` = '$manager_id', `manager_name` = '$manager_name' WHERE `client_name` = '$ac_name';";
    mysqli_query($connect_db, $sql);
    echo "<script>alert('등록이 완료되었습니다.');</script>";
    echo "<script>location.href='./academy_option_staff.php';</script>";
}


//manager_get_id=mathit1&manager_get_name=박상은&manager_get_chk=MATH%20IT
?>