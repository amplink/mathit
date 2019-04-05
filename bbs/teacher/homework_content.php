<?php
include_once ('_common.php');
?>
<?php
$class_name = $_GET['class_name'];
$sql = "select * from `homework` where `class_name`='$class_name';";
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
                    <div class="x_btn"><img src="img/close.png" alt="delete_icon" onclick="del_homework('<?=$res['name']?>')"></div>
                </td>
                <td>
                    <input type='text' name='title' value='<?=$res['name']?>'>
                </td>

                <td><select name="textbook" id="textbook">
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
                <td><select name="grade" id="grade<?=$i?>" onchange="book_info1(<?=$i?>)">
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
                <td><select name="semester" id="semester<?=$i?>" onchange="book_info1(<?=$i?>)">
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
                <td><select name="level" id="level<?=$i?>">
                        <option value="루트">루트</option>
                        <option value="파이">파이</option>
                        <option value="시그마">시그마</option>
                        <?php
                        echo "<script>$('#level$i').val('".$res['level']."');</script>";
                        ?>
                    </select></td>
                <td>
                    <select name="unit" id="unit<?=$i?>">
                        <option value="<?=$res['unit']?>"><?=$res['unit']?></option>
                    </select>
                </td>
                <td>
                    <select name="corner1" id="corner1<?=$i?>">
                        <option value="개념마스터">개념마스터</option>
                        <option value="개념확인">개념확인</option>
                        <option value="서술과 코칭">서술과 코칭</option>
                        <option value="이야기수학">이야기수학</option>
                        <option value="개념다지기">개념다지기</option>
                        <option value="단원마무리">단원마무리</option>
                        <option value="도전 문제">도전 문제</option>
                        <?php
                        echo "<script>$('#corner1$i').val('".$res['corner1']."');</script>";
                        ?>
                    </select>
                </td>

                <td>
                    <select name="Q_number1[]" id="Q_number1" class="custumdropdown" custumdrop="question" multiple="multiple">
                        <?php
                        $q_1 = explode(",", $res['Q_number1']);
                        $cnt = 0;
                        for($j=1; $j<=30; $j++) {
                            if($q_1[$cnt] == $j) {
                                echo "<option class='checkbox' value='$j' selected>$j</option>";
                                $cnt++;
                            }
                            else echo "<option class='checkbox' value='$j'>$j</option>";
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="corner2" id="corner2<?=$i?>">
                        <option value="개념마스터">개념마스터</option>
                        <option value="개념확인">개념확인</option>
                        <option value="서술과 코칭">서술과 코칭</option>
                        <option value="이야기수학">이야기수학</option>
                        <option value="개념다지기">개념다지기</option>
                        <option value="단원마무리">단원마무리</option>
                        <option value="도전 문제">도전 문제</option>
                        <?php
                        echo "<script>$('#corner2$i').val('".$res['corner2']."');</script>";
                        ?>
                    </select>
                </td>
                <td>
                    <select name="Q_number2[]" id="Q_number2" class="custumdropdown" custumdrop="question" multiple="multiple">
                        <?php
                        $q_2 = explode(",", $res['Q_number2']);
                        $cnt = 0;
                        for($j=1; $j<=30; $j++) {
                            if($q_2[$cnt] == $j) {
                                echo "<option class='checkbox' value='$j' selected>$j</option>";
                                $cnt++;
                            }
                            else echo "<option class='checkbox' value='$j'>$j</option>";
                        }
                        ?>
                    </select>
                </td>

                <td>
                    <select name="corner3" id="corner3<?=$i?>">
                        <option value="개념마스터">개념마스터</option>
                        <option value="개념확인">개념확인</option>
                        <option value="서술과 코칭">서술과 코칭</option>
                        <option value="이야기수학">이야기수학</option>
                        <option value="개념다지기">개념다지기</option>
                        <option value="단원마무리">단원마무리</option>
                        <option value="도전 문제">도전 문제</option>
                        <?php
                        echo "<script>$('#corner3$i').val('".$res['corner3']."');</script>";
                        ?>
                    </select>
                </td>
                <td>
                    <select name="Q_number3[]" id="Q_number3" class="custumdropdown" custumdrop="question" multiple="multiple">
                        <?php
                        $q_3 = explode(",", $res['Q_number3']);
                        $cnt = 0;
                        for($j=1; $j<=30; $j++) {
                            if($q_3[$cnt] == $j) {
                                echo "<option class='checkbox' value='$j' selected>$j</option>";
                                $cnt++;
                            }
                            else echo "<option class='checkbox' value='$j'>$j</option>";
                        }
                        ?>
                    </select>
                </td>

                <td>
                    <select name="corner4" id="corner4<?=$i?>">
                        <option value="개념마스터">개념마스터</option>
                        <option value="개념확인">개념확인</option>
                        <option value="서술과 코칭">서술과 코칭</option>
                        <option value="이야기수학">이야기수학</option>
                        <option value="개념다지기">개념다지기</option>
                        <option value="단원마무리">단원마무리</option>
                        <option value="도전 문제">도전 문제</option>
                        <?php
                        echo "<script>$('#corner4$i').val('".$res['corner4']."');</script>";
                        ?>
                    </select>
                </td>
                <td>
                    <select name="Q_number4[]" id="Q_number4" class="custumdropdown" custumdrop="question" multiple="multiple">
                        <?php
                        $q_4 = explode(",", $res['Q_number4']);
                        $cnt = 0;
                        for($j=1; $j<=30; $j++) {
                            if($q_4[$cnt] == $j) {
                                echo "<option class='checkbox' value='$j' selected>$j</option>";
                                $cnt++;
                            }
                            else echo "<option class='checkbox' value='$j'>$j</option>";
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
                    if($sd < 0 && $ed > 0) {
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
                            $students = explode(',', $students);
                            for($k=0; $k<count($students); $k++) {
                                ?>
                                <div class="checks_names_wrap">
                                    <div class="checks_names" style="float:left;display:block;"><?=$students[$k]?></div>
                                    <div class="checks_names_values" ><span id="chkNameVal1" class="checkNames_span green_color_on">완료</span></div>
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

                    }else if($sd > 0 && $ed > 0) {
                        echo '<div class="resend_btn" onclick="resend('.$i.')"><a>재전송</a></div>';
                    }else if($sd < 0 && $ed < 0) {
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
                        numberOfMonths: 2
                    })
                        .on("change", function () {
                            to.datepicker("option", "minDate", getDate(this));
                        }),
                    to = $("#to" + i).datepicker({
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
                        numberOfMonths: 2
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
</script>