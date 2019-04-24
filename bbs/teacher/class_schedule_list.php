<?php
include_once ('_common.php');
include_once ('head.php');
?>

    <link rel="stylesheet" type="text/css" media="screen" href="css/class_schedule_list.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/notice_list.css" />
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

<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">수업관리</p>
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
                <p class="option_title">제출 유형</p>
                <div class="option_contnets">
                    <div class="type_chk"><input type="radio" value="" name="type">
                        <p>전체</p>
                    </div>
                    <div class="type_chk"><input type="radio" value="수업계획표" name="type">
                        <p>수업계획표</p>
                    </div>
                    <div class="type_chk"><input type="radio" value="수업일지" name="type">
                        <p>수업일지</p>
                    </div>
                </div>
            </div>
            <div class="table_option_line">
                <p class="option_title">작성자</p>
                <div class="option_contnets">
                    <select name="teacher_select" id="teacher_select">
                        <option value="">전체</option>
                        <?php
                        $link = "/api/math/teacher_list?client_no=".$ac;
                        $r = api_calls_get($link);
                        for($i=1; $i<count($r); $i++) {
                            echo "<option value='".$r[$i][3]."'>".$r[$i][3]."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="table_option_line">
                <p class="option_title">제목</p>
                <div class="option_contnets">
                    <input type="text" placeholder="제목을 입력하세요" id="title">
                    <div class="search_btn" onclick="search()"><a>검색</a></div>
                </div>
            </div>
<!--            <div class="table_option_line">-->
<!--                <p class="option_title">날짜</p>-->
<!--                <div class="option_contnets">-->
<!--                    <div class="date_range"><input type="text" id="from" name="from">-->
<!--                    </div>-->
<!--                    <span>~</span>-->
<!--                    <div class="date_range"><input type="text" id="to" name="to">-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
            <div class="class_schedule_table">
                <table>
                    <thead>
                    <tr>
                        <th>번호</th>
                        <th>제목</th>
                        <th>첨부파일</th>
                    </tr>
                    </thead>
                    <tbody id="schedule_list">
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

    search();
    function search() {
        var type = $("input[name=type]:checked").val();
        var writer = $("#teacher_select").val();
        var title = $("#title").val();

        $.ajax({
            type : "GET",
            url: "class_schedule_write_search.php?type="+type+"&title="+title+"&writer="+writer,
            dataType: "html",
            success: function(response) {
                $("#schedule_list").html(response);
            }
        })
    }

    $('#title').keyup(function(e) {
        if(e.keyCode == 13) search();
    });
    function attach_file_del(seq) {
        $.ajax({
            type: "GET",
            url: "class_schedule_file_del.php?seq="+seq,
            success: function(response) {
                search();
                call_content(seq);
            }
        })
    }
</script>
