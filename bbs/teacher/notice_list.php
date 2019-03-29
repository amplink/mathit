<?php
include_once ('_common.php');
include_once ('head.php');
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
    <link rel="stylesheet" type="text/css" media="screen" href="css/notice_list.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
</head>
<body>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">공지사항</p>
            </div>
            <div class="head_right">
                <div class="write_btn"><a href="notice_write.php">공지사항 등록</a></div>
            </div>
        </div>
    </div>
    <div class="contents_box">
        <div class="l_section">
            <div class="table_option_line">
                <p class="option_title">공지 검색</p>
                <div class="option_contnets">
                    <input type="text" placeholder="공지 제목으로 검색합니다" id="search_val">
                    <div class="search_btn" onclick="search();"><a>검색</a></div>
                </div>
            </div>
            <div class="table_option_line">
                <p class="option_title">공지 목록</p>
                <div class="option_contnets">
<!--                    <p>-->
<!--                        <span>새공지</span>-->
<!--                        <span>9</span>-->
<!--                        <span>개</span>-->
<!--                    </p>-->
                </div>
            </div>
            <div class="class_schedule_table">
                <table>
                    <thead>
                    <tr>
                        <th>번호</th>
                        <th>제목</th>
                        <th>첨부파일</th>
                    </tr>
                    </thead>
                    <tbody id="notice_val">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="r_section">

        </div>
    </div>
</section>
</body>

</html>
<script>
    $.ajax({
        type: "GET",
        url: "notice_search.php?search="+$('#search_val').val(),
        dataType: "html",
        success: function(response){
            $("#notice_val").html(response);
        },
    });
    function call_content(seq) {
        $.ajax({
            type: "GET",
            url: "notice_content.php?seq="+seq,
            dataType: "html",
            success: function(response){
                $(".r_section").html(response);
            }
        });
    }
    function chch() {
        $('#side').val($('#rr').val());
    }

    function search() {
        $.ajax({
            type: "GET",
            url: "notice_search.php?search="+$('#search_val').val(),
            dataType: "html",
            success: function(response){
                $("#notice_val").html(response);
            }
        });
    }
    $('#search_val').keyup(function(e) {
        if(e.keyCode == 13) search();
    });

    function del_content(e) {
        var a = confirm("삭제하시겠습니까?");
        if(a == true) {
            location.href = "notice_write_chk.php?t=2&seq="+e;
        }
    }

    ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        });
</script>
<?php
if($_GET['seq']) echo "<script>call_content($seq);</script>";
?>