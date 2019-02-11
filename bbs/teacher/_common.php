<?php
//define('G5_IS_ADMIN', true);
include("../../_common.php");

if( isset($token) ){
    $token = @htmlspecialchars(strip_tags($token), ENT_QUOTES);
}
?>