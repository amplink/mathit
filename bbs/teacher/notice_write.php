<?php
include_once ('_common.php');
include_once ('head.php');

// 시간표
$link = "/api/math/teacher_class?client_no=126&t_uid=".$_SESSION['t_uid'];
$r = api_calls_get($link);

$d_uid = array();
$chk = 0;
$cnt = 0;
for($i=1; $i<count($r); $i++) {
    $chk = 0;
    for($j=0; $j<count($d_uid); $j++) {
        if($d_uid[$j] == $r[$i][0]) $chk = 1;
    }
    if(!$chk) {
        $d_uid[$cnt] = $r[$i][0];
        $d_name[$cnt] = $r[$i][4];
        $cnt++;
    }
}

$seq = $_GET['seq'];

$sql = "select * from `teacher_notice` where `seq` = '$seq';";
$result = mysqli_query($connect_db, $sql);
if($result) {
    $res = mysqli_fetch_array($result);
    $type = explode(',', $res['type']);
    $range = explode(',', $res['n_range']);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MathIt - teacher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/notice_write.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
</head>

<body>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">공지사항 등록</p>
            </div>
            <div class="head_right">
            </div>
        </div>
    </div>
    <form action="./notice_write_chk.php" method="post" id="write_form" enctype="multipart/form-data">
    <input type="hidden" name="seq" value="<?=$seq?>">
    <div class="write_board_section">
        <div class="board_option_line">
            <div class="option_title">
                <p>공지유형</p>
            </div>
            <div class="option_content">
                <div class="type_radio"><input type="checkbox" name="notice_type[]" value="중요공지">
                    <p>중요공지</p>
                </div>
                <div class="type_radio"><input type="checkbox" name="notice_type[]" value="일반공지">
                    <p>일반공지</p>
                </div>
            </div>
        </div>
        <div class="board_option_line">
            <div class="option_title">
                <p>공지범위</p>
            </div>
            <div class="option_content">
                <div class="range_radio"><input type="checkbox" class="check_all">
                    <p>전체</p>
                </div>
                <div class="range_radio"><input type="checkbox" name="range[]" class="oj" value="전임강사">
                    <p>전임강사</p>
                </div>
                <div class="range_radio"><input type="checkbox" name="range[]" class="oj" value="채점강사">
                    <p>체점강사</p>
                </div>
                <div class="range_radio"><input type="checkbox" name="range[]" class="oj" value="학생">
                    <p>학생</p>
                </div>
            </div>
        </div>
        <input type="hidden" name="wr_name" value="<?=$_SESSION['t_name']?>">
        <div class="board_option_line">
            <div class="option_title">
                <p>공지대상</p>
            </div>
            <div class="option_content">
                <select name="target" id="class_select">
                    <?php
                    for($i=0; $i<count($d_name); $i++) echo "<option value='".$d_name[$i]."'>$d_name[$i]</option>";
                    ?>
                </select>
            </div>
        </div>
        <div class="board_option_line">
            <div class="option_title">
                <p>제목</p>
            </div>
            <div class="option_content">
                <input type="text" placeholder="제목을 입력하세요" name="title" required value="<?=$res['title']?>">
            </div>
        </div>
        <div class="board_option_line">
            <div class="option_title">
                <p>첨부파일</p>
            </div>
            <div class="option_content">
                <input type="file" name="bf_file[]" onchange="$('#f').html('현재파일 : '+this.value)"><span id="f">현재파일 : <?=$res['file_name']?></span>
<!--                <div class="file_add_btn"><a href="#none">첨부파일</a></div>-->
            </div>
        </div>
        <textarea class="smart_edit_input" id="content" name="content"><?=$res['content']?></textarea>
        <div class="btn_section">
            <div class="btn_wrap">
                <div class="save_btn"><a>등록</a></div>
                <div class="cancel_btn"><a>취소</a></div>
            </div>
        </div>
    </div>
</section>
</form>
</body>
</html>
<?php
for($k=0; $k<count($type)-1; $k++) {
    echo "<script>$('input[type=checkbox][value=".$type[$k]."]').prop('checked', true);</script>";
}

for($k=0; $k<count($range)-1; $k++) {
    echo "<script>$('input[type=checkbox][value=".$range[$k]."]').prop('checked', true);</script>";
}
if((count($range)-1)==3) echo "<script>$('.check_all').prop('checked', true);</script>";

echo "<script>$('#class_select').val('".$res['target']."');</script>";
?>
<script>
    ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        });
    $(document).ready(function(){
        $('.check_all').click(function(){
            $('.oj').prop('checked', this.checked);
        });
        $('.save_btn').click(function () {
           $('#write_form').submit();
        });
    });
</script>