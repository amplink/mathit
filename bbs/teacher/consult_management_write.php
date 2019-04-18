<?php
include_once ('_common.php');
include_once ('head.php');

$link = "/api/math/class_stu?client_no=".$_SESSION['client_no']."&d_uid=".$_GET['d_uid']."&c_uid=".$_GET['c_uid'];
$r = api_calls_get($link);

for($i=1; $i<count($r); $i++) {
    if($r[$i][1] == $_GET['s_id']) $student_name = $r[$i][2];
}

for($i=0; $i<count($d_name); $i++) {
    if($d_uid[$i] == $_GET['d_uid'] && $c_uid[$i] == $_GET['c_uid']) {
        $class_name = $d_name[$i];
        $class_type = $d_yoie[$i];
    }
}
?>

    <link rel="stylesheet" type="text/css" media="screen" href="css/consult_manegement_write.css" />
    <script src="js/common.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>

<form action="consult_management_write_chk.php?s_id=<?=$_GET['s_id']?>&d_uid=<?=$_GET['d_uid']?>&c_uid=<?=$_GET['c_uid']?>" method="post" id="consult_form">
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text"><span><?=$class_name?>(<?=$class_type?>) - <?=$student_name?> 학생</span></p>
            </div>
            <div class="head_right">
                <div class="consult_list_btn"><a href="consult_management_personal.php?s_id=<?=$_GET['s_id']?>&s_name=<?=$student_name?>&d_uid=<?=$_GET['d_uid']?>&c_uid=<?=$_GET['c_uid']?>">상담내역</a></div>
            </div>
        </div>
    </div>
    <div class="consult_board_box">
        <div class="head_line">
            <div class="writer" style="top: -3px;">
                <p><span>상담자</span></p>
                <p><?=$_SESSION['t_name']?></p>
            </div>
            <div class="write_date">
                <input type="text" id="datepicker" name="date">
            </div>
        </div>
        <div class="head_line">
            <div class="consult_detail" style="top: 0px;">
                <p>상담 세부설정</p>
            </div>
            <select name="consult_genre" id="consult_genre">
                <option value="">상담유형</option>
                <option value="정기상담">정규상담</option>
                <option value="상시상담">상시상담</option>
            </select>
            <select name="consult_topic" id="consult_topic">
                <option value="">상담주제</option>
                <option value="신규상담">신규상담</option>
                <option value="성적상담">성적상담</option>
                <option value="분기상담">분기상담</option>
                <option value="기타">기타</option>
            </select>
        </div>
        <div class="head_line">
            <div class="radio_box">
                <div class="radio_div"><input type="radio" name="object" value="학부모">
                    <p>학부모</p>
                </div>
                <div class="radio_div"><input type="radio" name="object" value="학생">
                    <p>학생</p>
                </div>
                <div class="radio_div"><input type="radio" name="object" value="기타">
                    <p>기타</p>
                </div>
            </div>
            <div class="radio_box">
                <div class="radio_div"><input type="radio" name="consult_way" value="전화">
                    <p>전화</p>
                </div>
                <div class="radio_div"><input type="radio" name="consult_way" value="대면">
                    <p>대면</p>
                </div>
            </div>
            <div class="radio_box">
                <div class="radio_div"><input type="radio" name="web_open" value="공개">
                    <p>공개</p>
                </div>
                <div class="radio_div"><input type="radio" name="web_open" value="비공개">
                    <p>비공개</p>
                </div>
            </div>
        </div>
        <div class="textarea_section"><textarea name="content" id="content" cols="30" rows="10"></textarea></div>
        <div class="btn_section">
            <div class="save_btn" onclick="submit()"><a href="#none">저장</a></div>
        </div>
        <div class="back_logo"><img src="img/logo_black.png" alt="back_logo"></div>
    </div>
    <input type="hidden" name="s_name" value="<?=$student_name?>">
</section>
</form>
</body>
</html>
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

    $( function() {
        $( "#datepicker" ).datepicker({
            showOn: "button",
            buttonImage: "img/calendar.png",
            buttonImageOnly: true,
            buttonText: "Select date",
            nextText: "다음달",
            prevText: "이전달",
            changeMonth: true,
            dayNames: ['월요일', '화요일', '수요일', '목요일', '금요일', '토요일', '일요일'],
            dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'],
            monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
            monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
            numberOfMonths: 1
        });
    } );

    function submit() {
        $("#consult_form").submit();
    }
</script>