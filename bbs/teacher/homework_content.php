<?php
include_once ('_common.php');
?>
<?php
$class_name = $_GET['class_name'];
$sql = "select * from `homework` 
        where 
		`class_name`='$class_name'
		and `d_uid`='$_GET[d_uid]'
		and `c_uid`='$_GET[c_uid]'
		and `s_uid`='$_GET[s_uid]'
		and `d_order`='$_GET[d_order]'";

if($_GET['st_id']) $sql .="and  match(student_id) against('*$_GET[st_id]*' in boolean mode) ";

$sql .="order by seq desc ";

$result = sql_query($sql);
$i=0;
while($res = mysqli_fetch_array($result)) {
    $start_date = str_replace("/", "-", $res['_from']);
    $start_date = explode('-', $start_date);
    $today_to_start = $start_date[2].'-'.$start_date[0].'-'.$start_date[1];
    $end_date = str_replace("/", "-", $res['_to']);
    $end_date = explode('-', $end_date);
    $today_to_end = $end_date[2].'-'.$end_date[0].'-'.$end_date[1];
    $today = date("Y-m-d");
    $c_start = date_create($today_to_start);
    $c_today = date_create($today);
    $c_end = date_create($today_to_end);
    $start_diff = date_diff($c_today, $c_start);
    $end_diff = date_diff($c_today, $c_end);
    $sd = $start_diff->format("%R%a");
    $ed = $end_diff->format("%R%a");
    ?>
    <div>
        <form action="homework_resend.php?seq=<?=$res['seq']?>" method="POST" id="resend_form<?=$i?>" enctype="multipart/form-data">
            <table class="homework_cont">
                <td>
                    <div class="x_btn"><img src="img/close.png" alt="delete_icon" onclick="del_homework('<?=$res['seq']?>','<?=$res['d_uid']?>','<?=$res['c_uid']?>','<?=$res['s_uid']?>','<?=$res['d_order']?>','<?=$res['student_id']?>')"></div>
                </td>
                <td>
                    <input type='text' name='title' value="<?=htmlspecialchars($res['name'], ENT_QUOTES)?>">
                </td>

                <td><select name="textbook" id="textbook<?=$i?>" onchange="chk_type(<?=$i?>)">
                        <?php
                        if($res['textbook']=="알파") {
                            ?>
                            <option value="알파" selected>알파</option>
                            <option value="베타">베타</option>
                            <?php
                        }else {
                            ?>
                            <option value="알파">알파</option>
                            <option value="베타" selected>베타</option>
                            <?php
                        }
                        ?>
                    </select></td>
                <td><select name="grade" id="grade<?=$i?>" onclick="book_info1(<?=$i?>)">
                        <option value="초3">초3</option>
                        <option value="초4">초4</option>
                        <option value="초5">초5</option>
                        <option value="초6">초6</option>
                        <option value="중1">중1</option>
                        <option value="중2">중2</option>
                        <option value="중3">중3</option>
                        <?php
                        echo "<script>$('#grade$i').val('".$res['grade']."');</script>";
                        ?>
                    </select></td>
                <td><select name="semester" id="semester<?=$i?>" onclick="book_info1(<?=$i?>)">
                        <?php
                        if($res['semester']=="1학기") {
                            ?>
                            <option value="1학기" selected>1학기</option>
                            <option value="2학기">2학기</option>
                            <?php
                        }else {
                            ?>
                            <option value="1학기">1학기</option>
                            <option value="2학기" selected>2학기</option>
                            <?php
                        }
                        ?>
                    </select></td>
                <td><select name="level" id="level<?=$i?>" onchange="chk_type(<?=$i?>)">
                        <option value="루트">루트</option>
                        <option value="파이">파이</option>
                        <option value="시그마">시그마</option>
                        <?php
                        echo "<script>$('#level$i').val('".$res['level']."');</script>";
                        ?>
                    </select></td>
                <td>
                    <select name="unit" id="unit<?=$i?>" onchange="chk_type(<?=$i?>)">
                        <?
                        $semester = $semester_arr[$res['semester']];
                        $grade = $grade_arr[$res['grade']];
                        $unit = $res['unit'];

                        $sql2 = "select value from `book_info` where `grade` = '$grade' and `semester` = '$semester';";
                        $result2 = mysqli_query($connect_db, $sql2);
                        while($res2 = mysqli_fetch_array($result2)) {
                            $sel = ($unit == $res2['value'])?"selected":"";
                            ?>
                            <option value="<?=$res2['value']?>" <?=$sel?>><?=$res2['value']?></option>
                            <?
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="corner1" id="corner1<?=$i?>" data-key="<?=$i?>" data-num="1" class="corner">
                        <?
                        $semester = $semester_arr[$res['semester']];
                        $grade = $grade_arr[$res['grade']];
                        $unit = $res['unit'];
                        $corner_arr = array();
                        $sql3 = "SELECT 
                           c_name
                        FROM 
                          `answer_master`  
                        WHERE 
                           book_type='".$res[textbook]."' 
                           AND grade='".$grade_arr[$res[grade]]."'
                           AND semester='".$semester_arr[$res[semester]]."'
                           AND unit = '".$res[unit]."'
                           AND level = '".$res[level]."'
                        GROUP BY c_name
                        ORDER BY c_name ASC";

                        $result3 = mysqli_query($connect_db, $sql3);
                        while($res3 = mysqli_fetch_array($result3)) {
                            $corner_arr[] = $res3['c_name'];
                            $sel = ($res['corner1'] == $res3['c_name'])?"selected":"";
                            ?>
                            <option value="<?=$res3['c_name']?>" <?=$sel?>><?=$res3['c_name']?></option>
                            <?
                        }
                        ?>

                    </select>
                </td>

                <td>
                    <select name="Q_number1[]" id="Q_number1_<?=$i?>" class="custumdropdown" custumdrop="question" multiple="multiple">
                        <?php
                        $q_1 = explode(",", $res['Q_number1']);
                        $cnt = 0;
                        $answer_arr = array();
                        $textbook = $res['textbook'];
                        $grade = $grade_arr[$res['grade']];
                        $semester = $semester_arr[$res['semester']];
                        $level = $res['level'];
                        $unit = $res['unit'];
                        $corner = $_GET['val'];

                        $sql4 = "SELECT 
								   item_number, c_name
								FROM 
								  `answer_master`  
								WHERE 
								   book_type='".$textbook."' 
								   AND grade='".$grade."'
								   AND semester='".$semester."'
								   AND unit = '".$unit."'
								   AND level = '".$level."'
								   AND (c_name = '".$res['corner1']."' OR c_name = '".$res['corner2']."'
								        OR c_name = '".$res['corner3']."' OR c_name = '".$res['corner4']."')
								ORDER BY seq, item_number ASC";

                        $result4 = mysqli_query($connect_db, $sql4);
                        while($res4 = mysqli_fetch_array($result4)){

                            $answer_arr[$res4['c_name']][] =  $res4['item_number'];
                            if($res4['c_name'] != $res['corner1']) continue;
                            $sel = (in_array($res4['item_number'],$q_1))?"selected":"";

                            echo "<option class='checkbox' value='".$res4['item_number']."' $sel>".$res4['item_number']."</option>";
                            $cnt++;
                        }

                        ?>
                    </select>
                </td>
                <td>
                    <select name="corner2" id="corner2<?=$i?>" data-key="<?=$i?>" data-num="2" class="corner">
                        <?php
                        foreach($corner_arr as $v){
                            $sel = ($res['corner2'] == $v)?"selected":"";
                            ?>
                            <option value="<?=$v?>" <?=$sel?>><?=$v?></option>
                            <?
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="Q_number2[]" id="Q_number2_<?=$i?>" class="custumdropdown" custumdrop="question" multiple="multiple">
                        <?php
                        $q_2 = explode(",", $res['Q_number2']);
                        foreach($answer_arr[$res['corner2']] as $k => $v){
                            $sel = (in_array($v,$q_2))?"selected":"";
                            echo "<option class='checkbox' value='".$v."' $sel>".$v."</option>";
                        }
                        ?>
                    </select>
                </td>

                <td>
                    <select name="corner3" id="corner3<?=$i?>" data-key="<?=$i?>" data-num="3" class="corner">
                        <?php
                        foreach($corner_arr as $v){
                            $sel = ($res['corner3'] == $v)?"selected":"";
                            ?>
                            <option value="<?=$v?>" <?=$sel?>><?=$v?></option>
                            <?
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="Q_number3[]" id="Q_number3_<?=$i?>" class="custumdropdown" custumdrop="question" multiple="multiple">
                        <?php
                        $q_3 = explode(",", $res['Q_number3']);
                        foreach($answer_arr[$res['corner3']] as $k => $v){
                            $sel = (in_array($v,$q_3))?"selected":"";
                            echo "<option class='checkbox' value='".$v."' $sel>".$v."</option>";
                        }
                        ?>
                    </select>
                </td>

                <td>
                    <select name="corner4" id="corner4<?=$i?>" data-key="<?=$i?>" data-num="4" class="corner">
                        <?php
                        foreach($corner_arr as $v){
                            $sel = ($res['corner4'] == $v)?"selected":"";
                            ?>
                            <option value="<?=$v?>" <?=$sel?>><?=$v?></option>
                            <?
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="Q_number4[]" id="Q_number4_<?=$i?>" class="custumdropdown" custumdrop="question" multiple="multiple">
                        <?php
                        $q_4 = explode(",", $res['Q_number4']);
                        foreach($answer_arr[$res['corner4']] as $k => $v){
                            $sel = (in_array($v,$q_4))?"selected":"";
                            echo "<option class='checkbox' value='".$v."' $sel>".$v."</option>";
                        }
                        ?>
                    </select>
                <td style="max-width: 200px; width: 200px;">
                    <?php
                    $_from = $res['_from'];
                    $_to = $res['_to'];
                    echo '<input type="text" name="from" id="from'.$i.'" style="width: 70px;" value="'.$_from.'" required>';
                    ?>
                </td>
                <td style="max-width: 200px; width: 200px;">
                    <?php
                    echo '<input type="text" name="to" id="to'.$i.'" style="width: 70px;" value="'.$_to.'" required>';
                    ?>
                </td>
                </td>
                <td>
                    <?php

                    $sql5 = "SELECT 
							  count(id) tot
							FROM 
							 `homework_assign_list`
							WHERE
							 h_id = '$res[seq]'
							AND
							 current_status IN('','a1','a2','s1')
					  ";
                    $result5 = mysqli_query($connect_db, $sql5);
                    $res5 = mysqli_fetch_array($result5);

                    $today = date("m/d/Y");
                    $today = strtotime(date($today));
                    $start = strtotime(date($res['_from']));
                    $end = strtotime(date($res['_to']));

                    if($start <= $today && $end >= $today && $res5[tot] > 0) {
                        ?>
                        <p class="ing_text" id="status_complete<?=$i?>" style="color: blue;cursor: pointer;" onclick="show_box(<?=$i?>)">진행중</p>
                        <div class="students_checks<?=$i?>" style="background:rgb(255, 228, 73);
                                                                                position: absolute;
                                                                                padding: 10px;width: 97px;right: 80px; visibility: hidden;">
                            <div class="checks_names_wrap">
                                <div style="float:right;cursor: pointer;" id="close_x_btn<?=$i?>" onclick="blind_box(<?=$i?>)"><b>X</b></div>
                            </div>
                            <?php
                            $students = $res['student'];
                            $students_id = $res['student_id'];
                            $students = explode(',', $students);
                            $students_id = explode(',', $students_id);
                            for($k=0; $k<count($students); $k++) {
                                $sql6 = "SELECT 
							               current_status
                                         FROM 
                                          `homework_assign_list`
                                         WHERE
                                           h_id = '$res[seq]'
                                         AND
                                           student_id = '$students_id[$k]'
                                  ";
                                $result6 = mysqli_query($connect_db, $sql6);
                                $res6 = mysqli_fetch_array($result6);
                                $status = ($res6['current_status'] == 's2' or $res6['current_status'] == 's3' )?"green|완료":"red|미완료";
                                $status = explode("|",$status);
                                ?>
                                <div class="checks_names_wrap">
                                    <div class="checks_names" style="float:left;display:block;"><?=$students[$k]?></div>
                                    <div class="checks_names_values" ><span id="chkNameVal1" class="checkNames_span <?=$status[0]?>_color_on"><?=$status[1]?></span></div>
                                </div>
                                <?php
                            }
                            ?>
                            <!--                            <div class="checks_names_wrap">-->
                            <!--                                <div class="checks_names" style="float:left;display:block;">고이즈미</div>-->
                            <!--                                <div class="checks_names_values" ><span id="chkNameVal1" class="checkNames_span green_color_on">완료</span></div>-->
                            <!--                            </div>-->
                            <!--                            <div class="checks_names_wrap">-->
                            <!--                                <div class="checks_names" style="float:left;display:block;">킹목사</div>-->
                            <!--                                <div class="checks_names_values" ><span id="chkNameVal2" class="checkNames_span orange_color_on">1차</span></div>-->
                            <!--                            </div>-->
                            <!--                            <div class="checks_names_wrap">-->
                            <!--                                <div class="checks_names" style="float:left;display:block;">조지부시</div>-->
                            <!--                                <div class="checks_names_values" ><span id="chkNameVal3" class="checkNames_span red_color_on">2차</span></div>-->
                            <!--                            </div>-->
                            <!--                            <div class="checks_names_wrap">-->
                            <!--                                <div class="checks_names" style="float:left;display:block;">홍길동</div>-->
                            <!--                                <div class="checks_names_values" ><span id="chkNameVal4" class="checkNames_span green_color_on">완료</span></div>-->
                            <!--                            </div>-->
                        </div>
                        <?php

                    }else if($start > $today) {
                        echo '<div class="resend_btn" onclick="resend('.$i.')" style="cursor:pointer"><a>재전송</a></div>';
                        //}else if($sd < 0 && $ed < 0 && $res5[tot] == 0) {
                    }else if($res5[tot] == 0) {
                        echo '<p class="complete_text">완료</p>';
                    }
                    //            if($sd < 0) {
                    //                if($res['checked']==0) {
                    //                    echo '<p class="ing_text" style=" color: blue;">진행중</p>';
                    //                }else echo '<p class="complete_text">완료</p>';
                    //            }else {
                    //                echo '<div class="resend_btn"><a>재전송</a></div>';
                    //            }
                    ?>
                </td>
            </table>
        </form>
    </div>
    <?php
    $i++;
}
?>
<script>
    function resend(e) {

        $('#resend_form'+e).submit();
    }
</script>
<script>
    $( function() {
        for(var i=0; i<<?php echo $i;?>; i++) {
            var dateFormat = "yy-mm-dd",
                from = $("#from" + i).datepicker({
                    showOn: "button",
                    buttonImage: "img/calendar.png",
                    buttonImageOnly: true,
                    buttonText: "Select date",
                    nextText: "다음달",
                    prevText: "이전달",
                    changeMonth: true,
                    dayNames: ['월요일', '화요일', '수요일', '목요일', '금요일', '토요일', '일요일'],
                    dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'],
                    monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
                    monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                    numberOfMonths: 1
                })
                    .on("change", function () {
                        to.datepicker("option", "minDate", getDate(this));
                    }),
                to = $("#to" + i).datepicker({
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
                    monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
                    monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
                    numberOfMonths: 1,
                    onSelect: function(dateText, inst) {
                        if($("#to").val() < "<?=date('m/d/Y')?>"){
                            alert('종료일을 확인해 주세요.');
                            $("#to").val('');
                        }
                    }
                })
                    .on("change", function () {
                        from.datepicker("option", "maxDate", getDate(this));
                    });
        }
        function getDate( element ) {
            var date;
            try {
                date = $.datepicker.parseDate( dateFormat, element.value );
            } catch( error ) {
                date = null;
            }
            return date;
        }




        $('.corner').change(function () {
            var idx = $(this).data("num");
            if($(this).val() != '선택'){
                var no = $(this).data("key");
                var params = $("#resend_form"+no).serialize();

                var n = no -1;
                $("#corner_no").val($(this).val());

                //alert($("#corner_no").val());
                $.ajax({
                    type: "POST",
                    url: "call_corner_content.php?no="+no+"&val="+$(this).val(),
                    data:params,
                    dataType: "json",
                    success: function(response){
                        console.log(response.str1);

                        //$('.custumdropdown').eq(0).empty();
                        //$('.combobox').eq(0).html("");

                        $("#Q_number"+idx+"_"+no).parent().parent().find('.identifier').html('선택');
                        $("#Q_number"+idx+"_"+no).parent().parent().find("input:checkbox[name='allChk']").prop("checked", false);
                        $("#Q_number"+idx+"_"+no).parent().parent().find('.combobox').html(response.str1);
                        $("#Q_number"+idx+"_"+no).append(response.str2);


                        //$("#Q_number"+no).append(response.str2);
                        $('.custumdropdown').eq(0).homework_manegement_add();
                    }
                });
            }


        });













    } );

    function show_box(e) {
        var size = <?php echo $i;?>;
        if($('.students_checks'+e).css('visibility', 'hidden')) {
            for(var i=0; i<size; i++) {
                $('.students_checks'+i).css('visibility', 'hidden');
            }
            $('.students_checks'+e).css('visibility', '');
        }
    }

    function blind_box(e) {
        $('.students_checks'+e).css('visibility', 'hidden');
    }

    function chk_type(e) {
        if($('#textbook'+e).val() == "베타") {
            $('#unit'+e+' option[value="총정리(1)"]').text("중간평가");
            $('#unit'+e+' option[value="총정리(1)"]').val("중간평가");

            $('#unit'+e+' option[value="총정리(2)"]').text("기말평가");
            $('#unit'+e+' option[value="총정리(2)"]').val("기말평가");
        }

        var textbook = $('#textbook'+e).val();
        var level = $('#level'+e).val();
        var book = $('#unit'+e).val();
        // alert(book);

        if(textbook == "알파" && (level == "루트" || level == "파이")) {
            if(book == "총정리(1)" || book == "총정리(2)") {
                for(var i=1; i<=4; i++) $('#corner'+i+e).html('<option value="개념마스터">개념마스터</option>' +
                    '<option value="개념확인">개념확인</option>');
            }else {
                for(var i=1; i<=4; i++) $('#corner'+i+e).html('<option value="개념마스터">개념마스터</option>' +
                    '                                                    <option value="개념확인">개념확인</option>' +
                    '                                                    <option value="서술과코칭">서술과코칭</option>' +
                    '                                                    <option value="이야기수학">이야기수학</option>');
            }
        }
        if(textbook == "알파" && level == "시그마") {
            if(book == "총정리(1)" || book == "총정리(2)") {
                for(var i=1; i<=4; i++) $('#corner'+i+e).html('<option value="유형마스터">유형마스터</option>' +
                    '<option value="유형확인">유형확인</option>');
            }
            for(var i=1; i<=4; i++) $('#corner'+i+e).html('<option value="유형마스터">유형마스터</option>' +
                '<option value="유형확인">유형확인</option>' +
                '<option value="서술과코칭">서술과코칭</option>' +
                '<option value="이야기수학">이야기수학</option>');
        }
        if(textbook == "베타" && (level == "루트" || level == "파이")) {
            if(book == "중간평가") {
                for(var i=1; i<=4; i++) $('#corner'+i+e).html('<option value="중간평가1회">중간평가1회</option>' +
                    '<option value="중간평가2회">중간평가2회</option>');
            }else if(book == "기말평가"){
                for(var i=1; i<=4; i++) $('#corner'+i+e).html('<option value="기말평가1회">기말평가1회</option>' +
                    '<option value="기말평가2회">기말평가2회</option>');
            }else {
                for(var i=1; i<=4; i++) $('#corner'+i+e).html('<option value="개념다지기">개념다지기</option>' +
                    '<option value="단원마무리">단원마무리</option>' +
                    '<option value="도전문제">도전문제</option>');
            }
        }
        if(textbook == "베타" && level == "시그마") {
            if(book == "중간평가") {
                for(var i=1; i<=4; i++) $('#corner'+i+e).html('<option value="중간평가1회">중간평가1회</option>' +
                    '<option value="중간평가2회">중간평가2회</option>');
            }else if(book == "기말평가"){
                for(var i=1; i<=4; i++) $('#corner'+i+e).html('<option value="기말평가1회">기말평가1회</option>' +
                    '<option value="기말평가2회">기말평가2회</option>');
            }else {
                for(var i=1; i<=4; i++) $('#corner'+i+e).html('<option value="실력확인">실력확인</option>' +
                    '<option value="단원마무리">단원마무리</option>' +
                    '<option value="도전문제">도전문제</option>');
            }
        }
    }
</script>