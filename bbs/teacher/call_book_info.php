<?php
include_once ('_common.php');

$grade = $_GET['grade'];
$semester = $_GET['semester'];

$sql = "select * from `book_info` where `grade` = '$grade' and `semester` = '$semester';";
$result = mysqli_query($connect_db, $sql);

while($res = mysqli_fetch_array($result)) {
    ?>
    <option value="<?=$res['value']?>"><?=$res['value']?></option>
    <?php
}

?>