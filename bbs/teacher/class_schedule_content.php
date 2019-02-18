<?php
include_once ('_common.php');
session_start();
$seq = $_GET['seq'];

$sql = "select * from `teacher_schedule` where `seq` = '$seq';";
$result = mysqli_query($connect_db, $sql);
$res = mysqli_fetch_array($result);
?>
    <div class="board_line">
        <div class="title_side">
            <p>제목</p>
        </div>
        <div class="content_side">
            <p><?=$res['title']?></p>
        </div>
    </div>
    <div class="board_line">
        <div class="title_side">
            <p>작성일</p>
        </div>
        <div class="content_side">
            <p><?=$res['event_time']?></p>
        </div>
    </div>
    <div class="board_line">
        <div class="title_side">
            <p>작성자</p>
        </div>
        <div class="content_side">
            <p><?=$res['writer']?></p>
        </div>
    </div>
    <div class="board_line">
        <div class="title_side">
            <p>첨부파일</p>
        </div>
        <div class="content_side">
            <p><?=$res['file_name']?></p>
        </div>
    </div>
    <div class="board_main_text_section">
        <div class="main_text">
            <p><?=$res['content']?></p>
        </div>
    </div>
    <div class="btn_section">
        <div class="l_btn_wrap"></div>
        <div class="r_btn_wrap">
            <div class="add_file_down_btn">
                <a href="<?=$res['file_url'].$res['file_name']?>" download>첨부파일 받기</a>
            </div>
        </div>
    </div>
