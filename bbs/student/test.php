<?php
include_once ('_common.php');
if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad'))
    echo "iPhone or iPad";
else echo "11";
?>