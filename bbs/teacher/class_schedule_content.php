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
        <div class="l_btn_wrap">
<!--            --><?php //if($res['writer'] == $_SESSION['t_name']) ?><!--<div class="modify_btn"><a href="notice_write.php?seq=--><?//=$res['seq']?><!--">수정</a></div>-->
            <?php if($res['writer'] == $_SESSION['t_name']) ?><div class="delete_btn"><a href="class_schedule_del.php?&seq=<?=$res['seq']?>">삭제</a></div>
        </div>
        <div class="r_btn_wrap">
            <?php if($res['file_url']) {
                ?>
                <div class="modify_btn" style="">
                    <a href="<?=$res['file_url'].$res['file_name']?>" download>첨부파일 받기</a>
                </div>
                <div class="delete_btn">
                    <a href="class_schedule_file_del.php?seq=<?=$res['seq']?>">첨부파일 삭제</a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
