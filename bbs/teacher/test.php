<?php
include_once ('_common.php');
include_once ('api.class.php');

$api = new gabiaSmsApi('psemathit','e7e280b259a8b08dd95e605e89637bc1');
$callback_arr= $api->getCallbackNum();

if ($api->sms_send("010-5396-7566", "02-2282-0331", "테스트1", "homework" , 0) == gabiaSmsApi::$RESULT_OK)
{
    echo("send ok");
    echo("이전 : " . $api->getBefore());
    echo("이후 : " . $api->getAfter());
}
else
{
    echo("SEND FAIL – " . $api->getResultCode() . " : " . $api->getResultMessage());
}

?>