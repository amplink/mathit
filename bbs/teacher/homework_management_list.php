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
    <link rel="stylesheet" type="text/css" media="screen" href="css/homework_manegement_add.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/homework_manegement_list.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery-ui.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/common.js"></script>
    <script src="js/homework_manegement_add.js"></script>
    <script>
        $( function() {
            var dateFormat = "yy-mm-dd",
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
    <style>
        .students_checks{
            display: none;
        }
        .checks_names_wrap{
            overflow: hidden;
            margin: 4px;
        }
        .checks_names_values{
            float: right;
            cursor: pointer;
            font-weight: bold;
        }
        .checkNames_span{
            /*padding: 5px;*/
        }
        .red_color_on{
            color:red;
        }
        .orange_color_on{
            color:orange;
        }
        .green_color_on{
            color:green;
        }
    </style>
</head>
<body>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">숙제관리</p>
            </div>
            <div class="head_right">
                <div class="homework_menu"><a href="homework_management_add.php">숙제생성</a></div>
                <div class="homework_menu on"><a href="homework_management_list.php" class="on">숙제조회</a></div>
            </div>
        </div>
    </div>
        <div class="wrapper">
            <div class="left_box">
                <p class="box_title">출제 대상 선택</p>
                <div class="box_menu_wrap">
                    <p>학기</p>
                    <select name="year_select" id="year_select" onchange="move_page()">
                        <?php
                        for($i=2018; $i<2030; $i++) {
                            echo "<option value='$i'>$i"."년"."</option>";
                        }
                        ?>
                    </select>
                    <select name="quarter_select" id="quarter_select" onchange="move_page()">
                        <option value="1">1분기</option>
                        <option value="2">2분기</option>
                        <option value="3">3분기</option>
                        <option value="4">4분기</option>
                    </select>
                </div>
                <div class="grade_select_box select_table content">
                    <table>
                        <thead>
                        <tr>
                            <th>수업목록</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        for($i=0; $i<count($d_name); $i++) {
                            ?>
                            <tr>
                                <td onclick="lecture(<?=$d_uid[$i]?>,<?=$c_uid[$i]?>,'<?=$d_name[$i]?>')"><span><?=$d_name[$i]?></span></td>
                            </tr>
                            <?
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="student_list_box select_table">
                    <table>
                        <thead>
                        <tr>
                            <th>학생목록</th>
                        </tr>
                        </thead>
                        <tbody id="students">
                        </tbody>
                    </table>
                </div>
            </div>
        <div class="right_wrap">
            <div class="right_box">
                <p class="box_title">숙제목록</p>
                <div class="table_option_wrap">
                    <div class="table_option">
                        <input type="checkbox" id="clear" onchange="clear_btn()">
                        <p>완료한 숙제 목록에서 제외</p>
                    </div>
                </div>
                <div class="homework_list_table">
                    <table>
                        <thead>
                        <tr>
                            <th></th>
                            <th>숙제명</th>
                            <th>교재구분</th>
                            <th>학년</th>
                            <th>학기</th>
                            <th>레벨</th>
                            <th>단원명</th>

                            <th>코너명</th>
                            <th>문항번호</th>

                            <th>코너명</th>
                            <th>문항번호</th>

                            <th>코너명</th>
                            <th>문항번호</th>

                            <th>코너명</th>
                            <th>문항번호</th>

                            <th>시작일</th>
                            <th>종료일</th>
                            <th>상태</th>
                        </tr>
                        </thead>
                        <tbody id="homework_content">

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <div class="add_btn_wrap">
                <div class="add_btn"><a href="#none">등록</a></div>
            </div> -->
        </div>
    </div>
</section>
<!--<form action="homework_resend.php" id="resend_form">-->
<!--    <input type="hidden" name="r_name" id="r_name">-->
<!--    <input type="hidden" name="r_textbook" id="r_textbook">-->
<!--    <input type="hidden" name="r_grade" id="r_grade">-->
<!--    <input type="hidden" name="r_semester" id="r_semester">-->
<!--    <input type="hidden" name="r_unit" id="r_unit">-->
<!--    <input type="hidden" name="">-->
<!--</form>-->
<script>
    $(document).ready(function () {
        $('.grade_select_box table tbody tr').click(function () {
            if ($(this).hasClass('on') === true) {
                $(this).removeClass('on')
            } else {
                $(this).addClass('on');
                $('.grade_select_box table tbody tr').not(this).removeClass('on');
            }
        })
        $('.class_select_box table tbody tr').click(function () {
            if ($(this).hasClass('on') === true) {
                $(this).removeClass('on')
            } else {
                $(this).addClass('on');
                $('.class_select_box table tbody tr').not(this).removeClass('on');
            }
        })
        $('.student_list_box table tbody tr').click(function () {
            if ($(this).hasClass('on') === true) {
                $(this).removeClass('on')
            } else {
                $(this).addClass('on');
                $('.student_list_box table tbody tr').not(this).removeClass('on');
            }
        })

        $('.custumdropdown').homework_manegement_add();
    })

    var status_complete_onoff = 0;
    $(document).ready(function () {
        $("#status_complete").on("click", function(){
            toggle_status_complete();

        });
        $("#close_x_btn").on("click", function(){
            toggle_status_complete();
        });
    });

    function lecture(a, b, c) {
        $.ajax({
            type: "GET",
            url: "call_student_homework.php?d_uid="+a+"&c_uid="+b,
            dataType: "html",
            success: function(response){
                $("#students").html(response);
                $.ajax({
                   url: "homework_content.php?class_name="+c,
                   success: function(response) {
                       $("#homework_content").html(response);
                       $('.custumdropdown').homework_manegement_add();
                   }
                });
            }
        });
    }

    function del_homework(e) {
        if(confirm("삭제하시겠습니까?")) {
            location.href = "del_homework.php?name="+e;
        }
    }

    function toggle_status_complete(){
        if(status_complete_onoff == 1){
            $(".students_checks").hide();
            status_complete_onoff = 0;
        }else{
            $(".students_checks").show();
            status_complete_onoff = 1;
        }
    }

    function move_page() {
        var a = $('#quarter_select').val();
        var b = $('#year_select').val();
        // alert(a);
        location.href = './homework_management_list.php?s_year='+b+'&s_quarter='+a;
    }

    function clear_btn() {
        // if($('#clear').attr('checked', false)) $('.complete_text').parent().parent().hide();
        // else $('.complete_text').parent().parent().show();
    }

    function book_info1(e) {
        var tt = $("#grade"+e).val();
        var ttt = $("#semester"+e).val();
        var grade, semester;

        if(tt=="초3") grade = 3;
        if(tt=="초4") grade = 4;
        if(tt=="초5") grade = 5;
        if(tt=="초6") grade = 6;
        if(tt=="중1") grade = 7;
        if(tt=="중2") grade = 8;
        if(tt=="중3") grade = 9;

        if(ttt=="1학기") semester = 1;
        if(ttt=="2학기") semester = 2;

        $.ajax({
            type: "GET",
            url: "call_book_info.php?grade="+grade+"&semester="+semester,
            dataType: "html",
            success: function(response) {
                $("#unit"+e).html(response);
            }
        })
    }

    $("#year_select").val(<?php echo $s_year;?>);
    $("#quarter_select").val(<?php echo $s_quarter;?>);

    $('.ui-datepicker-trigger').css('width', '20px');
</script>
</body>

</html>