<?php
include_once('_common.php');

$sql = "select * from `academy`";
$result = mysqli_query($connect_db, $sql);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MathIt - teacher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
</head>

<body>
<div class="login_box">
    <div class="logo_line">
        <div class="login_logo"><img src="img/logo.png" alt="login_logo"></div>
    </div>
    <p class="login_info">아이디와 비밀번호를 입력해주세요</p>
    <div class="login_input_section">
        <form action="./login_chk.php" method="post" id="login_form">
            <input type="text" placeholder="아이디" name="id" required>
            <input type="password" placeholder="비밀번호" name="pw" required>
            <select name="academy_select" id="academy_select" required>
                <option value="">캠퍼스선택</option>
                <?php
                while($res = mysqli_fetch_array($result)) {
                    echo "<option value='".$res['client_id']."'>".$res['client_name']."</option>";
                }
                ?>
            </select>
            <div class="id_save">
                <input type="checkbox">
                <p>아이디저장</p>
            </div>
        </form>
    </div>
    <div class="login_error_section" id="error_div">
<!--        <p style="color: red;">아이디 또는 비밀번호가 틀렸습니다.</p>-->
    </div>
    <div class="login_btn_section" onclick="submit();">
        <a onclick="">로그인</a>
    </div>
</div>
</body>

</html>
<script>
    function submit() {
        $("#login_form").submit();
    }
</script>