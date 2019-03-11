<?php
include_once ('_common.php');
$class = $_GET['class'];
$test_genre = $_GET['genre'];

$sql = "select * from `teacher_score` where `class` = '$class' and `test_genre` = '$test_genre';";
$result = mysqli_query($connect_db, $sql);
while($res = mysqli_fetch_array($result)) {
    $tt = $res['title'];
    echo "<tr><td onclick=\"call_data('".$tt."')\">".$res['title']."</td></tr>";
}
?>