<?php
include_once ('_common.php');
include_once ('head.php');

$t_name = $_SESSION['t_name'];
$sql = "select * from `teacher_setting` where `t_name`='$t_name';";
$result = sql_query($sql);
$res = mysqli_fetch_array($result);

$t_type = $res['type'];
$t_notice = $res['notice'];

if($t_type == "채점강사") {
    if($t_notice) {
        $cnt = 0;
        $r = api_calls_get("/api/math/class?client_no=".$_SESSION['client_no']);
        for($i=1; $i<count($r); $i++) {
            $d_name[$cnt] = $r[$i][4];
            $cnt++;
        }
    }else {
        // 시간표
        $link = "/api/math/teacher_class?client_no=126&t_uid=".$_SESSION['t_uid'];
        $r = api_calls_get($link);
        $t = $_GET['t'];
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
    }

}else {
    $cnt = 0;
    $r = api_calls_get("/api/math/class?client_no=".$_SESSION['client_no']);
    for($i=1; $i<count($r); $i++) {
        $d_name[$cnt] = $r[$i][4];
        $cnt++;
    }
}

$seq = $_GET['seq'];

$sql = "select * from `teacher_notice` where `seq` = '$seq';";
$result = mysqli_query($connect_db, $sql);
if($result) {
    $res = mysqli_fetch_array($result);
//    $type = explode(',', $res['type']);
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
    <link rel="icon" type="image/png" sizes="96x96" href="img/f.png">
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/notice_write.css" />
    <link rel="stylesheet" type="text/css" href="css/multiselect.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
<!--    <script src="js/helper.js"></script>-->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">-->
<!--    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap-multiselect.css">
    <script src="js/bootstrap-multiselect.js"></script>
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
    <form action="./notice_write_chk.php?t=<?=$t?>" method="post" id="write_form" enctype="multipart/form-data">
        <input type="hidden" name="seq" value="<?=$seq?>">
        <div class="write_board_section">
            <div class="board_option_line">
                <div class="option_title">
                    <p>공지유형</p>
                </div>
                <div class="option_content">
                    <div class="type_radio"><input type="radio" name="notice_type" value="중요공지" <?php if($res['type'] == "중요공지") echo "checked";?>>
                        <p>중요공지</p>
                    </div>
                    <div class="type_radio"><input type="radio" name="notice_type" value="일반공지" <?php if($res['type'] == "일반공지") echo "checked";?>>
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
                    <div class="range_radio"><input type="checkbox" name="range[]" class="oj" value="전임강사" onchange="cancel_chk_all()">
                        <p>전임강사</p>
                    </div>
                    <div class="range_radio"><input type="checkbox" name="range[]" class="oj" value="채점강사" onchange="cancel_chk_all()">
                        <p>채점강사</p>
                    </div>
                    <div class="range_radio"><input type="checkbox" name="range[]" class="oj" value="학생" onchange="cancel_chk_all()">
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
                    <select name="target[]" id="class_select" style="margin-top: 5px;" multiple="multiple" required>
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
                    <input type="text" style="margin-top: 5px;" placeholder="제목을 입력하세요" name="title" value="<?=$res['title']?>" id="title">
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
        .create( document.querySelector( '#content' ),  {
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

    $(document).ready(function(){
        $('.check_all').click(function(){
            $('.oj').prop('checked', this.checked);
        });
        $('.save_btn').click(function () {
            if(!$('#title').val()) {
                alert('제목을 입력하세요.');
            }else {
                $('#write_form').submit();
            }
        });
        $('.cancel_btn').click(function () {
            location.href = 'notice_list.php';
        })
        $('#class_select').multiselect();
    });
    function cancel_chk_all() {
        if($('.check_all').prop('checked', true)) {
            var boxlengh = $('.oj').length;
            var checkedlength = $('.oj:checked').length;
            if(boxlengh == checkedlength) {
                $('.check_all').prop('checked', true);
            }else {
                $('.check_all').prop('checked', false);
            }
        }
        else {
            $('.check_all').prop('checked', true)
        }
    }
</script>
<script src="js/multiselect.min.js"></script>