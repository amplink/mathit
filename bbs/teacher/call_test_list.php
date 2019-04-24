<?php
include_once ('_common.php');
$d_uid = $_GET['d_uid'];
$c_uid = $_GET['c_uid'];
$s_uid = $_GET['s_uid'];
$test_genre = $_GET['test_genre'];
$test_list = array();

$sql = "select * from `teacher_score` where `d_uid`='$d_uid' and `c_uid`='$c_uid' and `s_uid`='$s_uid' and `test_genre`='$test_genre';";
$result = mysqli_query($connect_db, $sql);
$i=0;
$chk = 0;
while($res = mysqli_fetch_array($result)) {
    for($j=0; $j<count($test_list); $j++) {
        if($test_list[$j] == $res['title']) $chk = 1;
    }
    if($chk == 0) {

        echo "<tr class='select_box3'><td onclick=\"call_data('".$res['title']."')\">".$res['title']."</td></tr>";
        $test_list[$i] = $res['title'];
        $i++;
    }
    $chk = 0;
}
?>