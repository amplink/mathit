<?php
include_once ('_common.php');

$textbook = $_POST['textbook'];
$grade = $_POST['grade'];
$semester = $_POST['semester'];
$level = $_POST['level'];
$unit = $_POST['unit'];
//$corner = $_POST[$_POST['corner_no']];
$corner = $_GET['val'];

$sql = "SELECT 
		   item_number
		FROM 
		  `answer_master`  
		WHERE 
		   book_type='".$textbook."' 
		   AND grade='".$grade_arr[$grade]."'
		   AND semester='".$semester_arr[$semester]."'
		   AND unit = '".$unit."'
		   AND level = '".$level."'
		   AND c_name = '".$corner."'
		ORDER BY seq, item_number ASC";


$result = mysqli_query($connect_db, $sql);

$str1 = "";
$str2 = "";
while($res = mysqli_fetch_array($result)){
   $str1 .= "<div class='var_option' data-value='".$res['item_number']."'><span class='checkbox'><i></i></span><div class='room'>".$res['item_number']."</div></div>";
   $str2 .= "<option class='checkbox' value='".$res['item_number']."'>".$res['item_number']."</option>";
}

$jsonData['str1'] = $str1;
$jsonData['str2'] = $str2;
echo json_encode($jsonData);
?>