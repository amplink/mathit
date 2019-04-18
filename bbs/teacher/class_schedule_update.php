<?php
include_once ('_common.php');
include_once ('head.php');
$seq = $_GET['seq'];
$sql = "select * from `teacher_schedule` where `seq`='$seq';";
$result = sql_query($sql);
$res = mysqli_fetch_array($result);
?>

<link rel="stylesheet" type="text/css" media="screen" href="css/class_schedule_write.css" />
<script src="js/common.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>

<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">수업계획표/일지</p>
            </div>
            <div class="head_right">
                <div class="class_menu"><a href="class_schedule_list.php">조회</a></div>
                <div class="class_menu on"><a href="class_schedule_write.php" class="on">작성</a></div>
            </div>
        </div>
    </div>
    <form action="class_schedule_update_chk.php?seq=<?=$seq?>" method="post" id="s_form" enctype="multipart/form-data">
        <div class="write_board_section">
            <div class="board_option_line">
                <div class="option_title">
                    <p>제출유형</p>
                </div>
                <div class="option_content">
                    <div class="type_radio"><input type="radio" name="type" value="수업계획표" <?php if($res['type']=="수업계획표") echo "checked";?>>
                        <p>수업계획표</p>
                    </div>
                    <div class="type_radio"><input type="radio" name="type" value="수업일지" <?php if($res['type']=="수업일지") echo "checked";?>>
                        <p>수업일지</p>
                    </div>
                </div>
            </div>
            <div class="board_option_line">
                <div class="option_title">
                    <p>공개범위</p>
                </div>
                <div class="option_content">
                    <div class="range_radio"><input type="radio" name="read_range" value="전체" <?php if($res['s_range']=="전체") echo "checked";?>>
                        <p>전체</p>
                    </div>
                    <div class="range_radio"><input type="radio" name="read_range" value="전임강사" <?php if($res['s_range']=="전임강사") echo "checked";?>>
                        <p>전임강사</p>
                    </div>
                    <div class="range_radio"><input type="radio" name="read_range" value="관리자" <?php if($res['s_range']=="관리자") echo "checked";?>>
                        <p>관리자</p>
                    </div>
                    <div class="range_radio"><input type="radio" name="read_range" value="비공개" <?php if($res['s_range']=="비공개") echo "checked";?>>
                        <p>비공개</p>
                    </div>
                </div>
            </div>
            <div class="board_option_line">
                <div class="option_title">
                    <p>제목</p>
                </div>
                <div class="option_content">
                    <input type="text" placeholder="제목을 입력하세요" name="title" id="title" value="<?=$res['title']?>" style="height:4px;padding:0px;top:2px">
                </div>
            </div>
            <div class="board_option_line">
                <div class="option_title">
                    <p>첨부파일</p>
                </div>
                <div class="option_content" style="margin-top:-4px">
                    <input type="file" name="bf_file[]" onchange="$('#f').html('현재파일 : '+this.value)">
                    <span id="f">현재파일 : <?=$res['file_name']?></span>
                    <!--                <div class="file_add_btn"><a href="#none">첨부파일</a></div>-->
                </div>
            </div>
            <div class="">
                <textarea id="content" name="content"><?=$res['content']?></textarea>
            </div>
            <div class="btn_section">
                <div class="btn_wrap">
                    <div class="save_btn"><a href="#none">저장</a></div>
                    <div class="cancel_btn"><a href="#none">취소</a></div>
                </div>
            </div>
    </form>
    </div>
</section>
</body>

</html>
<script>
    ClassicEditor
        .create( document.querySelector( '#content' ) , {
            toolbar: [
                'headings',
                'bold',
                'italic',
                'link',
                'unlink'
            ]
        })
        .catch( error => {
            console.error( error );
        });
    $('.save_btn').on('click', function (e) {
        if($("#title").val()) $("#s_form").submit();
        else alert('제목을 입력해주세요');
    });
    $('.cancel_btn').on('click', function (e) {
        history.back();
    });
</script>