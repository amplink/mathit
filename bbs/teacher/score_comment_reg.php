<?php
    include_once('./_common.php');

    $sql = "UPDATE teacher_score SET
            comment = '".$_POST[comment]."'";

    if($_POST['evaluation']) $sql .= ", evaluation = '".$_POST[evaluation]."'";

    $sql .= "WHERE 
            seq = '".$_POST[no]."'";

    
    sql_query($sql);
    
    alert_msg("정상 등록 되었습니다.");
    location_href("student_management_personal_".$_POST[flag]."_record_detail.php?no=".$_POST[no]);