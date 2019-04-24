<?php
include_once ('head.php');
$seq = $_GET['seq'];

$sql = "select * from `teacher_notice` where `seq`='$seq';";
$result = sql_query($sql);
$res = mysqli_fetch_array($result);
$time = explode(' ', $res['event_time']);
$time = $time[0];
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/notice_read.css" />
<body>
    <section>
        <?php
        if(strpos(':', $res['title'])) {
            $sql = "select * from `notify` where `id`='".$res['title']."';";
            $result = sql_query($sql);
            $res = mysqli_fetch_array($result);
            ?>
            <div class="head_p">
                <p class="head_title">공지사항</p>
                <div class="back_btn" onclick="history.back();"><a href="#"><img src="img/back_btn.png" alt="back_btn_icon"></a></div>
            </div>
            <div class="content_p">
                <p class="notice_title"><span><?=$res['title']?></span></p>
                <div class="other_info">
                    <p class="writer"><span>작성자: <?=$res['writer']?></span></p>
                    <p class="academy"><span>캠퍼스 명: <?=$_SESSION['client_name']?></span></p>
                    <p class="date"><span><?=$time?></span></p>
                </div>
            </div>
            <div class="content_detail_p">
                <div class="text_input_wrap">
                    <div class="text_input"><?=$res['content']?></div>
                </div>
            </div>
        <?php
        }else {
            ?>
            <div class="head_p">
                <p class="head_title">공지사항</p>
                <div class="back_btn" onclick="history.back();"><a href="#"><img src="img/back_btn.png" alt="back_btn_icon"></a></div>
            </div>
            <div class="content_p">
                <p class="notice_title"><span><?=$res['title']?></span></p>
                <div class="other_info">
                    <p class="writer"><span>작성자: <?=$res['writer']?></span></p>
                    <p class="academy"><span>캠퍼스 명: <?=$_SESSION['client_name']?></span></p>
                    <p class="date"><span><?=$time?></span></p>
                </div>
            </div>
            <div class="content_detail_p">
                <div class="text_input_wrap">
                    <div class="text_input"><?=$res['content']?></div>
                </div>
            </div>
        <?php
        }
        ?>
    </section>
</body>
</html>