<?php
include_once ('_common.php');
include_once ('head.php');

$t_name = $_SESSION['t_name'];
$sql = "select * from `teacher_setting` where `t_name`='$t_name';";
$result = sql_query($sql);
$res = mysqli_fetch_array($result);

$t_type = $res['type'];
$t_notice = $res['notice'];

$cnt = 0;

if($t_notice) {
    $r = api_calls_get("/api/math/class?client_no=".$_SESSION['client_no']);
    $r = arr_sort($r,4);
    for($i=0; $i<count($r)-1; $i++) {
        $d_uid[$cnt] = $r[$i][0];
        $c_uid[$cnt] = $r[$i][1];
        $s_uid[$cnt] = $r[$i][2];
        $d_name[$cnt] = $r[$i][4];
        $d_yoie[$cnt] = $r[$i][5];
        $cnt++;
    }

}else {
    $link = "/api/math/teacher_class?client_no=".$ac."&t_uid=".$_SESSION['t_uid']."&date=".$date;
    $r = api_calls_get($link);
    $r = arr_sort($r,4);
    $t = $_GET['t'];
    for($i=0; $i<count($r)-1; $i++) {
        $chk = 0;
        for($j=0; $j<count($d_uid); $j++) {
            if($d_uid[$j] == $r[$i][0]) $chk = 1;
        }
        if(!$chk) {
            $d_uid[$cnt] = $r[$i][0];
            $c_uid[$cnt] = $r[$i][1];
            $s_uid[$cnt] = $r[$i][2];
            $d_name[$cnt] = $r[$i][4];
            $d_yoie[$cnt] = $r[$i][5];
            $cnt++;
        }
    }
}

$seq = $_GET['seq'];

if($seq) {
    $mm = $seq;
    $sql = "select * from `teacher_notice` where `seq` = '$seq';";
    $result = mysqli_query($connect_db, $sql);
    if($result) {
        $res = mysqli_fetch_array($result);
        $range = explode(',', $res['n_range']);
    }

    $sub_d = explode('/', $res['d_uid']);
    $sub_c = explode('/', $res['c_uid']);
    $sub_s = explode('/', $res['s_uid']);

    $count_d = count($sub_d)-1;
    $count_c = count($sub_c)-1;
    $count_s = count($sub_s)-1;

    $class_value = array();
    for($i=0; $i<$count_c; $i++) {
        $class_value[] = $sub_d[$i]."/".$sub_c[$i]."/".$sub_s[$i];
    }
}else {
    $mm = 0;
    $class_value = array();
    for($i=0; $i<count($d_uid); $i++) {
        $class_value[$i] = $d_uid[$i]."/".$c_uid[$i]."/".$s_uid[$i];
    }
}
?>


<link rel="stylesheet" type="text/css" media="screen" href="css/notice_write.css" />
<link rel="stylesheet" type="text/css" href="css/multiselect.css" />

<script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
<!--    <script src="js/helper.js"></script>-->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">-->
<!--    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="css/bootstrap-multiselect.css">
<script src="js/bootstrap-multiselect.js"></script>

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
                    <p>공지 유형</p>
                </div>
                <div class="option_content">
                    <div class="type_radio"><input type="radio" name="notice_type" value="중요공지" <?php if($res['type'] == "중요공지") echo "checked";?>>
                        <p>중요 공지</p>
                    </div>
                    <div class="type_radio"><input type="radio" name="notice_type" value="일반공지" <?php if($res['type'] == "일반공지") echo "checked";?>>
                        <p>일반 공지</p>
                    </div>
                </div>
            </div>
            <div class="board_option_line">
                <div class="option_title">
                    <p>공지 범위</p>
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
            <div class="board_option_line" style="height:50px;">
                <div class="option_title">
                    <p>공지 대상</p>
                </div>
                <div class="option_content">
                    <select name="target[]" id="class_select" style="margin-top: 5px;" multiple="multiple">
                        <?php
                        for($i=0; $i<count($d_name); $i++) {
                            echo "<option value='".$d_uid[$i]."/".$c_uid[$i]."/".$s_uid[$i]."'>$d_name[$i]($d_yoie[$i])</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="board_option_line" style="height:50px;">
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
                    <input type="file" name="bf_file" id="bf_file" onchange="$('#f').html('현재파일 : '+this.value)"><span id="f">현재파일 : <?=$res['file_name']?></span>
                    <!--                <div class="file_add_btn"><a href="#none">첨부파일</a></div>-->
                </div>
            </div>
            <textarea class="smart_edit_input" id="content" name="content"><?=$res['content']?></textarea>
            <div class="btn_section">
                <div class="btn_wrap">
                    <div class="save_btn" style="cursor: pointer;"><a>등록</a></div>
                    <div class="cancel_btn" style="cursor: pointer;"><a>취소</a></div>
                </div>
            </div>
        </div>
</section>
</form>
</body>
</html>
<?php
for($k=0; $k<count($range); $k++) {
    echo "<script>$('input[type=checkbox][value=".$range[$k]."]').prop('checked', true);</script>";
}
if((count($range)-1)==3) echo "<script>$('.check_all').prop('checked', true);</script>";

echo "<script>$('#class_select').val('" . $res['target'] . "')</script>";
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
    var m;
    $(document).ready(function(){
        $('.check_all').click(function(){
            $('.oj').prop('checked', this.checked);
        });
        $('.cancel_btn').click(function () {
            location.href = 'notice_list.php';
        });
        m = $('#class_select').multiselect();
        if(<?php echo $mm;?>) {
            var ar = <?php echo json_encode($class_value);?>;
            for(var i=0; i<ar.length; i++) {
                m.select(ar[i]);
            }
        }else {
            var ar = <?php echo json_encode($class_value);?>;
            for(var i=0; i<ar.length; i++) {
                m.select(ar[i]);
            }
        }
        $('#class_select_input').attr('autocomplete','off');
        $('#class_select_input').focus(function () {
            $('.multiselect-list').toggle();
            m._updateText(m);
        });
        $('body').click(function (){
            if($('.multiselect-list').hasClass('active')) {
                $('.multiselect-list').hide();
                m._updateText(m);
            }
        });
        cancel_chk_all();
        $('.save_btn').click(function () {
            var arr = [];
            var cnt = 0;
            for(var i=0; i<$('#class_select option').length; i++) {
                if($("#class_select option:nth("+i+")").attr('selected')) {
                    arr[cnt] = $('#class_select option:nth('+i+')').val();
                    cnt++;
                }
            }
            $('#class_select').val(arr);
            var fileSize;
            if($('#bf_file').val()) fileSize = document.getElementById('bf_file').files[0].size;
            else fileSize = 0;
            var maxSize = 209715200;
            if(fileSize > maxSize){
                alert("해당파일은 파일용량을 초과 하였습니다.");
            }
            else if(!$('#title').val()) {
                alert('제목을 입력하세요.');
            }else {
                if(doubleSubmitCheck()) return;
                $('#write_form').submit();
            }
        });
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

    var doubleSubmitFlag = false;
    function doubleSubmitCheck(){
        if(doubleSubmitFlag){
            return doubleSubmitFlag;
        }else{
            doubleSubmitFlag = true;
            return false;
        }
    }
</script>
<script src="js/multiselect.min.js"></script>