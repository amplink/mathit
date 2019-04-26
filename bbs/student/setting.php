<?php
include_once ('head.php');
$uid = $_SESSION['s_uid'];
$sql = "select `sound`, `push_alarm` from `student_table` where `uid`='$uid';";
$result = sql_query($sql);
$res = mysqli_fetch_array($result);
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/setting.css" />
<body>
    <!--section-->
    <section>
        <div class="head_p">
            <div class="head_p_head">
                <p class="head_title">설정</p>
                <div class="back_btn"><a href="home.php"><img src="img/back_btn.png" alt="back_btn_icon"></a></div>
            </div>
        </div>
        <div class="content_detail_p">
            <div class="setting_menu">
                <div class="setting_title">
                    <p>푸시 알람</p>
                </div>
                <br>
                <div class="setting_content">
                    <div class="push_radio">
                        <input type="radio" name="push_alarm" onchange="submit()" value="1" <?php if($res['push_alarm']) echo "checked";?>>
                        <p>ON</p>
                    </div>
                    <div class="push_radio">
                        <input type="radio" name="push_alarm" onchange="submit()" value="0" <?php if(!$res['push_alarm']) echo "checked";?>>
                        <p>OFF</p>
                    </div>
                </div>
            </div>
            <div class="setting_menu">
                <div class="setting_title">
                    <p>효과음</p>
                </div>
                <br>
                <div class="setting_content">
                    <div class="sound_radio">
                        <input type="radio" name="sound" onchange="submit()" value="1" <?php if($res['sound']) echo "checked";?>>
                        <p>ON</p>
                    </div>
                    <div class="sound_radio">
                        <input type="radio" name="sound" onchange="submit()" value="0" <?php if(!$res['sound']) echo "checked";?>>
                        <p>OFF</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<script>
    function submit() {
        var push = $('input[name="push_alarm"]:checked').val();
        var sound = $('input[name="sound"]:checked').val();
        // alert("setting_chk.php?push="+push+"&sound="+sound);
        $.ajax({
           url: "setting_chk.php?push="+push+"&sound="+sound,
           success: function (res) {

           }
        });
    }
</script>