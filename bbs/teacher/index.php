<?php
include_once('_common.php');

define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//if (G5_IS_MOBILE) {
//    include_once(G5_THEME_MOBILE_PATH.'/index.php');
//    return;
//}
session_start();
if($_SESSION['t_id']) location_href("./home.html");
else {
    location_href("./login.php");
}

?>