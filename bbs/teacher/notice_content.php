<?php
include_once ('_common.php');

$seq = $_GET['seq'];
if(strpos($seq, ":")) {
    $sql = "select * from `notify` where `id`='$seq';";
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
            <p>관리자</p>
        </div>
    </div>
    <div class="board_line">
        <div class="title_side">
            <p>첨부파일</p>
        </div>
        <div class="content_side">
            <p><?=$res['attach_file']?></p>
        </div>
    </div>
    <div class="board_main_text_section">
        <div class="main_text" style="height:440px">
            <p><?=$res['contents']?></p>
        </div>
    </div>
    <div class="btn_section">
        <div class="l_btn_wrap">
        <div class="r_btn_wrap">
            <?php if($res['attach_file_url']) {
                ?>
                <div class="modify_btn" style="width:130px">
                    <a href="http://pse2018.cafe24.com/bbs/admin/<?=$res['attach_file_url'].$res['attach_file']?>" download>첨부파일 받기</a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}else {
    $sql = "select * from `teacher_notice` where `seq` = '$seq';";
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
            <?php
            if($res['writer'] == $_SESSION['t_name']) {
                ?>
                <div class="modify_btn"><a href="notice_write.php?seq=<?=$res['seq']?>&t=3">수정</a></div>
                <div class="delete_btn" style="cursor: pointer;" onclick="del_content(<?=$res['seq']?>)"><a>삭제</a></div>
                <?php
            }else if($res['writer'] == "관리자" && $_SESSION['admin']) {
                ?>
                <div class="modify_btn"><a href="notice_write.php?seq=<?=$res['seq']?>&t=3">수정</a></div>
                <div class="delete_btn" style="cursor: pointer;" onclick="del_content(<?=$res['seq']?>)"><a>삭제</a></div>
                <?php
            }
            ?>
        </div>
        <div class="r_btn_wrap">
            <?php if($res['file_url']) {
                ?>
                <div class="modify_btn" style="width:130px;">
                    <a href="<?=$res['file_url'].$res['file_name']?>" download>첨부파일 받기</a>
                </div>
                <div class="delete_btn" style="width:130px; cursor:pointer;" onclick="del_attach(<?=$res['seq']?>)">
                    <a>첨부파일 삭제</a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}
?>
<script>
    function del_attach(seq) {
            $.ajax({
                url:"notice_file_del.php?seq="+seq,
                success: function (response) {
                    call_content(seq);
                    search();
                }
            })
    }
</script>
