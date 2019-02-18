<?php

include_once('./_common.php');
$name = $_POST['name'];
$from = $_POST['from'];
$to = $_POST['to'];
$textbook = $_POST['textbook'];
$grade = $_POST['grade'];
$semester = $_POST['semester'];
$level = $_POST['level'];
$unit = $_POST['unit'];
$corner1 = $_POST['corner1'];
$Q_number1 = $_POST['Q_number1'];
$corner2 = $_POST['corner2'];
$Q_number2 = $_POST['Q_number2'];
$corner3 = $_POST['corner3'];
$Q_number3 = $_POST['Q_number3'];
$corner4 = $_POST['corner4'];
$Q_number4 = $_POST['Q_number4'];

$connect = sql_connect(G5_MYSQL_HOST, G5_MYSQL_USER, G5_MYSQL_PASSWORD) or die('DB Connect Error');
$select  = sql_select_db(G5_MYSQL_DB, $connect) or die('DB Error');
mysqli_set_charset($connect, 'utf8');
session_start();

$query = "INSERT INTO homework SET
                         `name`='$name',
                         `_from`='$from',
                         `_to`='$to',
                         `textbook`='$textbook',
                         `grade`='$grade',
                         `semester`='$semester',
                         `level`='$level',
                         `unit`='$unit',
                         `corner1`='$corner1',
                         `Q_number1`='$Q_number1',
                         `corner2`='$corner2',
                         `Q_number2`='$Q_number2',
                         `corner3`='$corner3',
                         `Q_number3`='$Q_number3',
                         `corner4`='$corner4',
                         `Q_number4`='$Q_number4'
                                ";

$result = mysqli_query($connect,$query);
mysqli_close($connect);


    if($result){
        echo "<script>alert(\"숙제정보가 입력되었습니다.\"); history.back(-2); </script>";
    }else{
        echo "<script>alert(\"누락된 정보가 있습니다.\"); history.back(-2); </script>";
    }

?>

<html>
<head>
    <title>MathIt - teacher</title>
</head>
<body>

</body>
</html>

