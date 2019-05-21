<?php
include_once ('_common.php');
include_once ('head.php');

$Banlist  = api_calls_get("/api/math/class?client_no=".$ac);
$studentlist = api_calls_get("/api/math/student_list?client_no=".$ac);
$teacherlist = api_calls_get("/api/math/teacher_list?client_no=".$ac);
?>

<link rel="stylesheet" type="text/css" media="screen" href="css/homework_manegement_add.css?v=20190407" />
<script>
    $( function() {
        var dateFormat = "mm/dd/yy",
            from = $( "#from" )
                .datepicker({
                    defaultDate: "<?=date('m/d/Y')?>",
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
                })
                .on( "change", function() {
                    to.datepicker( "option", "minDate", getDate( this ) );
                }),
            to = $( "#to" ).datepicker({
                defaultDate: "<?=date('m/d/Y')?>",
                showOn: "button",
                buttonImage: "img/calendar.png",
                buttonImageOnly: true,
                minDate: new Date(),
                buttonText: "Select date",
                nextText: "다음달",
                prevText: "이전달",
                changeMonth: true,
                dayNames: ['월요일', '화요일', '수요일', '목요일', '금요일', '토요일', '일요일'],
                dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'],
                monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
                monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
                numberOfMonths: 1,
                onSelect: function(dateText, inst) {
                    var to = $("#to").val();
                    var toArray = to.split('/');
                    var selDate = toArray[2]+toArray[0]+toArray[1];
                    var today = "<?=date('Ymd')?>";

                    if(selDate < today){
                        alert('종료일을 확인해 주세요.');
                        $("#to").val('');
                    }
                }
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
    .container { margin:110px auto; max-width:640px; text-align: start; }
</style>
<!--<script src="js/homework_manegement_add.js"></script>-->

<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">숙제관리</p>
            </div>
            <div class="head_right">
                <div class="homework_menu on"><a href="homework_management_add.php" class="on">숙제생성</a></div>
                <div class="homework_menu"><a href="homework_management_list.php">숙제조회</a></div>
            </div>
        </div>
    </div>
    <form method='post' action='homework_saved_at_db.php' id="all">
        <div class="wrapper">
            <div class="left_box">
                <p class="box_title">출제 대상 선택</p>
                <div class="box_menu_wrap">
                    <p>학기</p>
                    <select name="year_select" id="year_select" onchange="move_page()">
                        <?php
                        $last_year = date(Y);
                        for($i=2019; $i<= $last_year; $i++) {
                            $selected = ($i == $last_year)?"selected":"";
                            echo "<option value='{$i}' {$selected}>{$i}"."년"."</option>";
                        }
                        ?>
                    </select>
                    <input type="hidden" name="d_yoie" id="d_yoie">
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
                            <th>수업 목록</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        for($i=0; $i<count($d_name2); $i++) {
                            ?>
                            <tr>
                                <td onclick="lecture('<?=$d_name2[$i]?>')"><span><?=$d_name2[$i]?></span></td>
                            </tr>
                            <?
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="class_select_box select_table">
                    <table>
                        <thead>
                        <tr>
                            <th>번호</th>
                            <th>반 이름</th>
                            <th>담임 교사</th>
                        </tr>
                        </thead>
                        <tbody id="class_name">

                        </tbody>
                    </table>
                </div>
                <div class="student_list_box select_table">
                    <table>
                        <thead>
                        <tr>
                            <th>학생 목록</th>
                        </tr>
                        </thead>
                        <tbody id="students">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="right_wrap">
                <div class="right_box">
                    <div class="right_box_1">
                        <p class="box_title">숙제 정보 입력</p>
                        <div class="homework_title_input">
                            <p class="l_text">숙제명</p>
                            <input type="text" placeholder="숙제명을 입력해주세요" name ="name" id="name">
                            <input type="hidden" name="class_name" id="class_name1">
                            <input type="hidden" name="corner_no" id="corner_no" value="corner1">
                            <input type="hidden" name="d_id" id="d_id">
                            <input type="hidden" name="c_id" id="c_id">
                            <input type="hidden" name="s_id" id="s_id">
                        </div>
                        <div class="homework_deadline_wrap">
                            <div class="date_range">
                                <p class="l_text">시작일</p><input type="text" name="from" id="from" readOnly required>
                            </div>
                            <span style="margin-right: 20px;">~</span>
                            <div class="date_range">
                                <p class="l_text">종료일</p><input type="text" name="to" id="to" readOnly required>
                            </div>
                        </div>
                    </div>
                    <div class="right_box_2">
                        <p class="box_title">교재 선택</p>
                        <div class="book_table">
                            <div class="book_table">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>교재구분</th>
                                        <th>학년</th>
                                        <th>학기</th>
                                        <th>레벨</th>
                                        <th>단원명</th>

                                        <th>코너명</th>
                                        <th>문항번호</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td><select name="textbook" id="textbook" onchange="chk_type()">
                                                <option value="알파">알파</option>
                                                <option value="베타">베타</option>
                                            </select></td>
                                        <td><select name="grade" id="grade" onchange="book_info()">
                                                <option value="초3">초3</option>
                                                <option value="초4">초4</option>
                                                <option value="초5">초5</option>
                                                <option value="초6">초6</option>
                                                <option value="중1">중1</option>
                                                <option value="중2">중2</option>
                                                <option value="중3">중3</option>
                                            </select></td>
                                        <td><select name="semester" id="semester" onchange="book_info()">
                                                <option value="1학기">1학기</option>
                                                <option value="2학기">2학기</option>
                                            </select></td>
                                        <td><select name="level" id="level" onchange="chk_type()">
                                                <option value="루트">루트</option>
                                                <option value="파이">파이</option>
                                                <option value="시그마">시그마</option>
                                            </select></td>
                                        <td>
                                            <select name="unit" id="unit" onchange="chk_type()">

                                            </select>
                                        </td>
                                        <td>
                                            <select name="corner1" id="corner1" class="corner" onclick="cornerSel('1');" data-key="1">

                                            </select>
                                        </td>
                                        <td>
                                            <select name="Q_number1[]" id="Q_number1" class="custumdropdown1" id="custumdropdown1" custumdrop="question" multiple="multiple">
                                                <?php
                                                for($i=1; $i<=30; $i++) echo "<option class='checkbox' value='$i'>$i</option>";
                                                ?>
                                            </select>
                                            <script src="js/homework_manegement_add.js?v=201904051"></script>

                                            <script>
                                                $(function() {
                                                    $('[id^=Q_number]').empty();
                                                    //$('.custumdropdown').homework_manegement_add();

                                                });
                                            </script>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td><td></td><td></td><td></td><td></td>
                                        <td>
                                            <select name="corner2" id="corner2" class="corner" onclick="cornerSel('2');" data-key="2">

                                            </select>
                                        </td>
                                        <td>
                                            <select name="Q_number2[]" id="Q_number2" class="custumdropdown2" id="custumdropdown2" custumdrop="question" multiple="multiple">
                                                <?php
                                                for($i=1; $i<=30; $i++) echo "<option class='checkbox' value='$i'>$i</option>";
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td><td></td><td></td><td></td><td></td>
                                        <td>
                                            <select name="corner3" id="corner3" class="corner" onclick="cornerSel('3');" data-key="3">

                                            </select>
                                        </td>
                                        <td>
                                            <select name="Q_number3[]" id="Q_number3" class="custumdropdown3" id="custumdropdown3" custumdrop="question" multiple="multiple">
                                                <?php
                                                for($i=1; $i<=30; $i++) echo "<option class='checkbox' value='$i'>$i</option>";
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td><td></td><td></td><td></td><td></td>
                                        <td>
                                            <select name="corner4" id="corner4" class="corner" onclick="cornerSel('4');" data-key="4">

                                            </select>
                                        </td>
                                        <td>
                                            <select name="Q_number4[]" id="Q_number4" class="custumdropdown4" id="custumdropdown4" custumdrop="question" multiple="multiple">
                                                <?php
                                                for($i=1; $i<=30; $i++) echo "<option class='checkbox' value='$i'>$i</option>";
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
    </form>
    <div class="add_btn_wrap">
        <div class="add_btn" onclick="submit();" style="cursor: pointer;"><a>등록</a></div>
    </div>
    </div> <!-- end <div class="right_wrap"> -->
    </div> <!-- end <div class="wrapper"> -->
</section>
<script>
    $(document).ready(function () {
        $('.grade_select_box table tbody tr').click(function () {
            if ($(this).hasClass('on') === true) {
                $(this).removeClass('on')
            } else {
                $(this).addClass('on');
                $('.grade_select_box table tbody tr').not(this).removeClass('on');
            }
        });

        $('.class_select_box table tbody tr').click(function () {
            if ($(this).hasClass('on') === true) {
                $(this).removeClass('on')
            } else {
                $(this).addClass('on');
                $('.class_select_box table tbody tr').not(this).removeClass('on');
            }
        });

        $('.student_list_box table tbody tr').click(function () {
            if ($(this).hasClass('on') === true) {
                $(this).removeClass('on')
            } else {
                $(this).addClass('on');
                $('.student_list_box table tbody tr').not(this).removeClass('on');
            }
        });


        $('.corner').change(function () {

            if($(this).val() != '선택'){

                var params = $("#all").serialize();
                var no = $(this).data("key");
                var n = no -1;
                $("#corner_no").val($(this).val());
                // alert(no);
                //alert(n);
                //alert($("#corner_no").val());
                $.ajax({
                    type: "POST",
                    url: "call_corner_content.php?no="+no+"&val="+$(this).val(),
                    data:params,
                    dataType: "json",
                    success: function(response){
                        // console.log(response.str2);
                        //if(response) console.log(response.str1);
                        //$('.identifier').eq(n).html('선택');
                        //$("input:checkbox[name='allChk']").eq(n).prop("checked", false);

                        if(!response.str1) alert('해당코너의 항목이 없습니다.');

                        $("#Q_number"+no).parent().parent().find('.identifier').html('선택');
                        $("#Q_number"+no).parent().parent().find("input:checkbox[name='allChk']").prop("checked", false);

                        //$('.combobox:eq('+n+')').html(response.str1);
                        $("#Q_number"+no).parent().parent().find('.combobox').html(response.str1);
                        $("#Q_number"+no).append(response.str2);
                        $('.custumdropdown'+no).homework_manegement_add();

                    }
                });
            }


        });

        //$('.custumdropdown input[type=checkbox]').prop("checked", true);
        select_year();
        book_info();
        chk_type();
        // $('.allChk').click();
        //$('.allChk').prop('checked', true);
    });
    function submit() {
        var startDate = $("#from").val(); //2017-12-10
        var startDateArr = startDate.split('/');

        var endDate = $("#to").val(); //2017-12-09
        var endDateArr = endDate.split('/');

        var startDateCompare = new Date(startDateArr[2], parseInt(startDateArr[0])-1, startDateArr[1]);
        var endDateCompare = new Date(endDateArr[2], parseInt(endDateArr[0])-1, endDateArr[1]);

        if(startDateCompare.getTime() > endDateCompare.getTime()) {

            alert("시작날짜와 종료날짜를 확인해 주세요.");
            return;
        }

        if($("input[name=student_list\\[\\]]").val()) {
            if($("#name").val() && $("#from").val() && $("#to").val()) {
                if($("#corner1").val() == "선택"){
                    alert("코너명을 선택해주세요.");
                    return false;
                }else if($(".identifier:eq(0)").text() == "선택"){
                    alert("문항번호를 선택해주세요.");
                    return false;
                }else{
					if(doubleSubmitCheck()) return;
                    $(window).unbind('beforeunload');
                    $('#all').submit();
                }
            }else {
                alert('입력이 빠진 것이 없는지 확인해주세요.');
            }
        }
        else alert("학생을 선택해주세요.");

    }
    var Banlist =  [];
    var yq = 0;
    function select_year() {
        $("#classlist").empty();
        var y = document.getElementById("year_select");
        var year = y.options[y.selectedIndex].text;
        var q = document.getElementById("quarter_select");
        var quarter = q.options[q.selectedIndex].text;
        yq  = year+" "+quarter;
        Banlist = <?= json_encode($Banlist) ?>;
        for(var i=0; i<Banlist.length; i++) {
            if(Banlist[i][3] == yq){
                $("#classlist").append("<tr ><td >"+Banlist[i][4]+"</td></tr>");
            }
        }
        // $("#classlist").children().click(select_SuUp);
    }

    function student_select() {
        if ($(this).hasClass('on') === true) {
            $(this).removeClass('on')
        } else {
            $(this).addClass('on');
            $('.student_list_box table tbody tr').not(this).removeClass('on');
        }
    }

    // function lecture() {
    // 	$("#d_yoie").val(d);
    //     $.ajax({
    //         type: "GET",
    //         url: "call_student_homework.php?d_uid="+a+"&c_uid="+b,
    //         dataType: "html",
    //         success: function(response){
    //             $("#students").html(response);
    //             $("#class_name").val(c);
    //         }
    //     });
    // 			$("#d_id").val(a);
    // 			$("#c_id").val(b);
    // 			$("#s_id").val(e);
    // }
    function lecture(e) {
        $.ajax({
            type: "GET",
            url: "call_student_list.php?class="+e,
            dataType: "html",
            success: function(response){
                $("#class_name").html(response);
                $("#class_name1").val(e);
                $("#students").empty();
            }
        });
    }

    function call_student_form(d, c, s, n) {
        $('#d_id').val(d);
        $('#c_id').val(c);
        $('#s_id').val(s);
        $('#d_yoie').val(n);
        $.ajax({
            type: "GET",
            url: "call_student_homework.php?d_uid="+d+"&c_uid="+c,
            dataType: "html",
            success: function(response){
                $("#students").html(response);
            }
        });
    }

    function book_info() {
        var tt = $("#grade").val();
        var ttt = $("#semester").val();
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
                $("#unit").html(response);
                chk_type();
            }
        });

        if($('#textbook').val() == "베타") {
            $('#unit option[value="총정리(1)"]').text("중간평가");
            $('#unit option[value="총정리(1)"]').val("중간평가");

            $('#unit option[value="총정리(2)"]').val("기말평가");
            $('#unit option[value="총정리(2)"]').val("기말평가");
        }
    }

    function chk_type() {
        if($('#textbook').val() == "베타") {
            $('#unit option[value="총정리(1)"]').text("중간평가");
            $('#unit option[value="총정리(1)"]').val("중간평가");

            $('#unit option[value="총정리(2)"]').text("기말평가");
            $('#unit option[value="총정리(2)"]').val("기말평가");
        }

        var textbook = $('#textbook').val();
        var level = $('#level').val();
        var book = $('#unit').val();
        // alert(book);

        if(textbook == "알파" && (level == "루트" || level == "파이")) {
            if(book == "총정리(1)" || book == "총정리(2)") {
                for(var i=1; i<=4; i++) $('#corner'+i).html('<option>선택</option><option value="개념마스터">개념마스터</option>' +
                    '<option value="개념확인">개념확인</option>');
            }else {
                for(var i=1; i<=4; i++) $('#corner'+i).html('<option>선택</option><option value="개념마스터">개념마스터</option>' +
                    '                                                    <option value="개념확인">개념확인</option>' +
                    '                                                    <option value="서술과코칭">서술과코칭</option>' +
                    '                                                    <option value="이야기수학">이야기수학</option>');
            }
        }
        if(textbook == "알파" && level == "시그마") {
            if(book == "총정리(1)" || book == "총정리(2)") {
                for(var i=1; i<=4; i++) $('#corner'+i).html('<option>선택</option><option value="유형마스터">유형마스터</option>' +
                    '<option value="유형확인">유형확인</option>');
            }
            for(var i=1; i<=4; i++) $('#corner'+i).html('<option>선택</option><option value="유형마스터">유형마스터</option>' +
                '<option value="유형확인">유형확인</option>' +
                '<option value="서술과코칭">서술과코칭</option>' +
                '<option value="이야기수학">이야기수학</option>');
        }
        if(textbook == "베타" && (level == "루트" || level == "파이")) {
            if(book == "중간평가") {
                for(var i=1; i<=4; i++) $('#corner'+i).html('<option>선택</option><option value="중간평가1회">중간평가1회</option>' +
                    '<option value="중간평가2회">중간평가2회</option>');
            }else if(book == "기말평가"){
                for(var i=1; i<=4; i++) $('#corner'+i).html('<option>선택</option><option value="기말평가1회">기말평가1회</option>' +
                    '<option value="기말평가2회">기말평가2회</option>');
            }else {
                for(var i=1; i<=4; i++) $('#corner'+i).html('<option>선택</option><option value="개념다지기">개념다지기</option>' +
                    '<option value="단원마무리">단원마무리</option>' +
                    '<option value="도전문제">도전문제</option>');
            }
        }
        if(textbook == "베타" && level == "시그마") {
            if(book == "중간평가") {
                for(var i=1; i<=4; i++) $('#corner'+i).html('<option>선택</option><option value="중간평가1회">중간평가1회</option>' +
                    '<option value="중간평가2회">중간평가2회</option>');
            }else if(book == "기말평가"){
                for(var i=1; i<=4; i++) $('#corner'+i).html('<option>선택</option><option value="기말평가1회">기말평가1회</option>' +
                    '<option value="기말평가2회">기말평가2회</option>');
            }else {
                for(var i=1; i<=4; i++) $('#corner'+i).html('<option>선택</option><option value="실력확인">실력확인</option>' +
                    '<option value="단원마무리">단원마무리</option>' +
                    '<option value="도전문제">도전문제</option>');
            }
        }

    }

    function move_page() {
        var a = $('#quarter_select').val();
        var b = $('#year_select').val();
        // alert(a);
        location.href = './homework_management_add.php?s_year='+b+'&s_quarter='+a;
    }

    function cornerSel(no){

        /* if($("#corner"+no).val() != '선택'){
            var n = no - 1;
            var params = $("#all").serialize();

            $("#corner_no").val("corner"+no);
            //alert($("#corner_no").val());
            $.ajax({
               type: "POST",
               url: "call_corner_content.php",
               data:params,
               dataType: "json",
               success: function(response){
                 // console.log(response);
                 if(response) console.log(response.str1);
                 alert(response.str2);
                 //$("#Q_number"+no).empty();
                 //$('.combobox').children().empty();
                 //$('.combobox').eq(n).html(response.str1);

                // $('.combobox:eq('+n+')').html(response.str1);
                $("#Q_number"+no).append(response.str2);
                 $('.custumdropdown'+no).homework_manegement_add(response.str1);
               }
            });
         }*/
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

    $(window).bind('beforeunload', function () {
        return "저장하지 않고 페이지를 벗어나시겠습니까?";
    });

    $("#year_select").val(<?php echo $s_year;?>);
    $("#quarter_select").val(<?php echo $s_quarter;?>);
</script>
</body>

</html>