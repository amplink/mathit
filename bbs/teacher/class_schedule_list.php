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
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/class_schedule_list.css" />
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
                <p class="left_text">수업계획표/일지</p>
            </div>
            <div class="head_right">
                <div class="class_menu on"><a href="class_schedule_list.php" class="on">조회</a></div>
                <div class="class_menu"><a href="class_schedule_write.php">작성</a></div>
            </div>
        </div>
    </div>
    <div class="contents_box">
        <div class="l_section">
            <div class="table_option_line">
                <p class="option_title">제출유형</p>
                <div class="option_contnets">
                    <div class="type_chk"><input type="checkbox">
                        <p>전체</p>
                    </div>
                    <div class="type_chk"><input type="checkbox">
                        <p>수업계획표</p>
                    </div>
                    <div class="type_chk"><input type="checkbox">
                        <p>수업일지</p>
                    </div>
                </div>
            </div>
            <div class="table_option_line">
                <p class="option_title">강사명</p>
                <div class="option_contnets">
                    <select name="teacher_select" id="teacher_select">
                        <option value="base">선택</option>
                        <option value="teacher_1">퇴계이황</option>
                    </select>
                </div>
            </div>
            <div class="table_option_line">
                <p class="option_title">제목</p>
                <div class="option_contnets">
                    <input type="text" placeholder="제목을 입력하세요">
                </div>
            </div>
            <div class="table_option_line">
                <p class="option_title">날짜</p>
                <div class="option_contnets">
                    <div class="date_range"><input type="text" id="from" name="from">
                    </div>
                    <span>~</span>
                    <div class="date_range"><input type="text" id="to" name="to">
                    </div>
                    <div class="search_btn"><a href="#none">검색</a></div>
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
                    <tbody>
                    <?php
                    $sql = "select * from `teacher_schedule`";
                    $result = mysqli_query($connect_db, $sql);
                    $i=1;
                    while($res = mysqli_fetch_array($result)) {
                        ?>
                        <tr onclick="call_content(<?=$res['seq']?>)">
                            <td><span><?=$i?></span></td>
                            <td><span><?=$res['title']?></span>
                                <div class="new">
                                    <p>new</p>
                                </div>
                            </td>
                            <td>
                                <?php if($res['file_url']) ?><div class="have_sign"></div>
                            </td>
                        </tr>
                        <?
                    }
                    ?>
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
    function call_content(seq) {
        $.ajax({
            type: "GET",
            url: "class_schedule_content.php?seq="+seq,
            dataType: "html",
            success: function(response){
                $(".r_section").html(response);
            }
        });
    }
</script>
