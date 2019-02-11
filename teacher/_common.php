<?php
// define('G5_IS_ADMIN', true);
$g5_path = "..";
include_once("$g5_path/common.php");

if( isset($token) ){
    $token = @htmlspecialchars(strip_tags($token), ENT_QUOTES);
}
?>