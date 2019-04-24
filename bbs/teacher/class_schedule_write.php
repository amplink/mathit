<?php
include_once ('_common.php');
include_once ('head.php');
?>

<link rel="stylesheet" type="text/css" media="screen" href="css/class_schedule_write.css" />
<script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>

<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">수업관리</p>
            </div>
            <div class="head_right">
                <div class="class_menu"><a href="class_schedule_list.php">조회</a></div>
                <div class="class_menu on"><a href="class_schedule_write.php" class="on">작성</a></div>
            </div>
        </div>
    </div>
    <form action="class_schedule_write_chk.php" method="post" id="s_form" enctype="multipart/form-data">
        <div class="write_board_section">
            <div class="board_option_line">
                <div class="option_title">
                    <p>제출 유형</p>
                </div>
                <div class="option_content">
                    <div class="type_radio"><input type="radio" name="type" value="수업계획표" checked>
                        <p>수업계획표</p>
                    </div>
                    <div class="type_radio"><input type="radio" name="type" value="수업일지">
                        <p>수업일지</p>
                    </div>
                </div>
            </div>
            <div class="board_option_line">
                <div class="option_title">
                    <p>공개 범위</p>
                </div>
                <div class="option_content">
                    <div class="range_radio"><input type="radio" name="read_range" value="전체" checked>
                        <p>전체</p>
                    </div>
                    <div class="range_radio"><input type="radio" name="read_range" value="전임강사">
                        <p>전임강사</p>
                    </div>
                    <div class="range_radio"><input type="radio" name="read_range" value="관리자">
                        <p>관리자</p>
                    </div>
                    <div class="range_radio"><input type="radio" name="read_range" value="비공개">
                        <p>비공개</p>
                    </div>
                </div>
            </div>
            <div class="board_option_line">
                <div class="option_title">
                    <p>제목</p>
                </div>
                <div class="option_content">
                    <input type="text" placeholder="제목을 입력하세요" name="title" id="title" style="height:4px;padding:0px;top:2px">
                </div>
            </div>
            <div class="board_option_line">
                <div class="option_title">
                    <p>첨부파일</p>
                </div>
                <div class="option_content" style="margin-top:-4px">
                    <input type="file" placeholder="첨부파일" name="bf_file[]">
                    <!--                <div class="file_add_btn"><a href="#none">첨부파일</a></div>-->
                </div>
            </div>
            <div class="">
                <textarea id="content" name="content"></textarea>
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