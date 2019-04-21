<?php
include_once ('head.php');
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
                <div class="setting_content">
                    <div class="push_radio">
                        <input type="radio" name="push_alarm">
                        <p>ON</p>
                    </div>
                    <div class="push_radio">
                        <input type="radio" name="push_alarm">
                        <p>OFF</p>
                    </div>
                </div>
            </div>
            <div class="setting_menu">
                <div class="setting_title">
                    <p>효과음</p>
                </div>
                <div class="setting_content">
                    <div class="sound_radio">
                        <input type="radio" name="sound">
                        <p>ON</p>
                    </div>
                    <div class="sound_radio">
                        <input type="radio" name="sound">
                        <p>OFF</p>
                    </div>
                </div>
            </div>
            <div class="decoration">
                    <span class="deco_circle"></span>
                    <span class="deco_circle"></span>
                    <span class="deco_circle"></span>
                    <span class="deco_circle"></span>
                    <span class="deco_circle"></span>
                    <span class="deco_circle"></span>
                    <span class="deco_circle"></span>
                    <span class="deco_circle"></span>
                    <span class="deco_circle"></span>
                    <span class="deco_circle"></span>
                </div>
        </div>
    </section>
</body>
</html>