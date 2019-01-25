<?php
    include_once('_common.php');
    $data['Id'] = $_GET['ac_id'];
    $data['Pw'] = $_GET['ac_pw'];

    $link = "/api/math_client_chk";
    $res = api_calls($link, $data);

//    var_dump($res);
    if(!$res['client_no']) {
        echo("<script>alert('회원 정보가 등록되지 않았습니다.');</script>");
    }else {
        $sql = "INSERT INTO `academy` (`client_id`, `event_time`, `admin_id`, `client_name`) VALUES ('".$res['client_no']."', CURRENT_TIMESTAMP, '".$res['client_name']."', '".$res['client_name']."');";
        mysqli_query($connect_db, $sql);
    }

    echo("<script>location.href='./academy_option_add.php';</script>");
?>
