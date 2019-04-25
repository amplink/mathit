<?php
//define('G5_IS_ADMIN', true);
include("../../_common2.php");

if( isset($token) ){
    $token = @htmlspecialchars(strip_tags($token), ENT_QUOTES);
}
?>