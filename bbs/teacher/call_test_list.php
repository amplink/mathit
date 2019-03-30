<?php
include_once ('_common.php');
$class = $_GET['class'];
$test_genre = $_GET['genre'];
$test_list = array();

$sql = "select * from `teacher_score` where `class` = '$class' and `test_genre` = '$test_genre';";
$result = mysqli_query($connect_db, $sql);
$i=0;
$chk = 0;
while($res = mysqli_fetch_array($result)) {
    for($j=0; $j<count($test_list); $j++) {
        if($test_list[$j] == $res['title']) $chk = 1;
    }
    if($chk == 0) {
        $tt = $res['title'];
        echo "<tr><td onclick=\"call_data('".$tt."')\">".$res['title']."</td></tr>";
        $test_list[$i] = $res['title'];
        $i++;
    }
    $chk = 0;
}
?>