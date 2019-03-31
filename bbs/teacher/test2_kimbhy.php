<?php
include_once ('_common.php');

$r = api_calls_get("/api/math/class?client_no=".$_SESSION['client_no']);
for($i=0; $i<count($r); $i++) {
    echo $r[$i][4]."<br>";
}

?>
<script src="js/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/bootstrap-multiselect.css">
<script src="js/bootstrap-multiselect.js"></script>
<select id="class_content" multiple>
    <option value="aa">aa</option>
    <option value="bb">bb</option>
    <option value="cc">cc</option>
</select>
<script>
    $('#class_content').multiselect();
</script>