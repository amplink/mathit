<?php
include_once('./_common.php');

$sql = "UPDATE teacher_score SET
        comment = '$_POST[comment]'
 WHERE 
        seq = '$_POST[no]' 
";

sql_query($sql);

alert_msg("코멘트가 등록 되었습니다.");
location_href("student_management_personal_mid_record_detail.php?no=".$_POST[no]);