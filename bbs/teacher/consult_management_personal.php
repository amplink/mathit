<?php
include_once ('_common.php');
include_once ('head.php');
$student_name = $_GET['s_name'];
$s_id = $_GET['s_id'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MathIt - teacher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="96x96" href="img/f.png">
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/consult_manegement_personal.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/common.js"></script>
    <script>
        $( function() {
            var dateFormat = "mm/dd/yy",
                from = $( "#from" )
                    .datepicker({
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
                        numberOfMonths: 2
                    })
                    .on( "change", function() {
                        to.datepicker( "option", "minDate", getDate( this ) );
                    }),
                to = $( "#to" ).datepicker({
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
                    numberOfMonths: 2
                })
                    .on( "change", function() {
                        from.datepicker( "option", "maxDate", getDate( this ) );
                    });

            function getDate( element ) {
                var date;
                try {
                    date = $.datepicker.parseDate( dateFormat, element.value );
                } catch( error ) {
                    date = null;
                }

                return date;
            }
        } );
    </script>
</head>

<body>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p>&nbsp;&nbsp;상담내역 - <?=$student_name?></p>
            </div>
            <div class="head_right">
                <div class="consult_mane_btn"><a href="consult_management_write.php?s_id=<?=$s_id?>&d_uid=<?=$_GET['d_uid']?>&c_uid=<?=$_GET['c_uid']?>">상담관리</a></div>
            </div>
        </div>
    </div>
    <div class="student_consult_box">
        <div class="head_line">
            <div class="day_input">
                <div class="date_range">
                    <input type="text" id="from">
                </div>
                <span> ~ </span>
                <div class="date_range">
                    <input type="text" id="to">
                </div>
            </div>
            <div class="search_btn"><a href="#none">검색</a></div>
            <div class="month_btn_wrap">
                <div class="month_btn"><a href="#none">1개월</a></div>
                <div class="month_btn"><a href="#none">2개월</a></div>
                <div class="month_btn"><a href="#none">3개월</a></div>
                <div class="month_btn"><a href="#none">전체</a></div>
            </div>

        </div>
        <div class="consult_table">
            <table>
                <thead>
                <tr>
                    <th>상담일</th>
                    <th>학생명</th>
                    <th>상담자</th>
                    <th>대상</th>
                    <th>유형</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "select * from `teacher_consult` where `t_name` = '".$_SESSION['t_name']."';";
                $result = mysqli_query($connect_db, $sql);
                while($res = mysqli_fetch_array($result)) {
                    ?>
                    <tr onclick="call_consult(<?=$res['seq']?>);">
                        <td><span><?=$res['date']?></span></td>
                        <td><span><?=$res['s_name']?></span></td>
                        <td><span><?=$res['t_name']?></span></td>
                        <td><span><?=$res['object']?></span></td>
                        <td><span><?=$res['consult_genre']?></span></td>
                    </tr>
                    <?
                }
                ?>
                </tbody>
            </table>
        </div>
        <form action="consult_management_personal_chk.php" method="post" id="consult_form">
        <div id="content_c"></div>
        <div class="textarea_input_section">
            <p>상담내용</p><br>
            <div id="textarea"></div>
        </div>
        </form>
    </div>
</section>
</body>
</html>
<script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
<script>
    function call_consult(seq) {
        $.ajax({
            type: "GET",
            url: "call_consult.php?seq="+seq,
            dataType: "html",
            success: function(response){
                $("#textarea").html(response);
            },
            error: function (e) {
                alert("불러오기 실패");
            }
        });
    }

    function submit_val() {
        $("#consult_form").submit();
    }

    function del_val() {
        $("#consult_form").attr('action', "consult_management_personal_del.php");
        $("#consult_form").submit();
    }
</script>