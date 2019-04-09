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
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/record_manegement_add.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
    <script src="js/jquery-ui.js"></script>
</head>

<body>
<section>
    <form action="record_management_add_chk.php" method="post" id="record_form">
	<input type="hidden" name="d_id" id="d_id">
	<input type="hidden" name="c_id" id="c_id">
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">성적입력</p>
            </div>
            <div class="head_right">
                <div class="homework_menu"><a href="record_management_list.php">성적조회</a></div>
                <div class="homework_menu on"><a href="record_management_add.php" class="on">성적입력</a></div>
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
                    for($i=0; $i<count($d_name); $i++) {
                        ?>
                        <tr>
                            <td onclick="lecture('<?=$d_name[$i]?>','<?=$d_yoie[$i]?>','<?=$d_uid[$i]?>','<?=$c_uid[$i]?>')"><span><?=$d_name[$i]?></span></td>
                        </tr>
                        <?
                    }
                    ?>
                    </tbody>
                </table>
            </div>
<!--            <div class="class_select_box select_table">-->
<!--                <table>-->
<!--                    <thead>-->
<!--                    <tr>-->
<!--                        <th>번호</th>-->
<!--                        <th>반 이름</th>-->
<!--                        <th>담당 교사</th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                    <tbody>-->
<!--                    --><?php
//                    $cnt = 1;
//                    for($i=0; $i<count($day); $i++) {
//                        echo "<tr><td>$cnt</td><td><span>";
//                        for($j=0; $j<7; $j++) {
//                            if($day[$i][$j] == 1) {
//                                if($j==0) echo "월";
//                                if($j==1) echo "화";
//                                if($j==2) echo "수";
//                                if($j==3) echo "목";
//                                if($j==4) echo "금";
//                                if($j==5) echo "토";
//                                if($j==6) echo "일";
//                            }
//                        }
//                        echo "</span></td><td><span>".$_SESSION['t_name']."</span></td>";
//                        $cnt++;
//                    }
//                    ?>
<!--                    </tbody>-->
<!--                </table>-->
<!--            </div>-->
            <div class="student_list_box select_table">
                <table>
                    <thead>
                    <tr>
                        <th>시험 유형</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td onclick="chk_test_genre(1)"><span>중간평가</span></td>
                    </tr>
                    <tr>
                        <td onclick="chk_test_genre(2)"><span>기말평가</span></td>
                    </tr>
                    <tr>
                        <td onclick="chk_test_genre(3)"><span>분기테스트</span></td>
                    </tr>
                    <tr>
                        <td onclick="chk_test_genre(4)"><span>입반테스트</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="right_wrap">
            <div class="right_box">
                <div class="right_box_1">
                    <div class="r_left_box">
                        <div class="division">
                            <p class="l_div_title">대상반</p>
                            <a id="text_class"></a>
                            <input type="hidden" name="class" id="class">
                        </div>
                        <div class="division" style="padding-top:5px">
                            <p class="l_div_title">시험일</p>
                            <input type="text" name="date" id="datepicker">
                        </div>
                        <div class="division">
                            <p class="l_div_title">기준 만점</p>
                            <input type="text" placeholder="기준점수" name="standard_score" value="100" id="standard_score" style="width: 100px;">
                            <span> 점</span>
                        </div>
                    </div>
                    <div class="r_right_box">
                        <div class="division">
                            <p class="l_div_title">시험유형</p><a id="text_genre"></a><input type="hidden" name="test_genre" id="test_genre">
                        </div>
                        <div class="division">
                            <p class="l_div_title">시험명</p><input type="text" placeholder="시험명을 입력해주세요" name="title" id="title">
                        </div>
                        <div class="division">
                            <p class="l_div_title">영역별 점수</p>
                            <div class="score_input"><input type="text" placeholder="점수" name="sub_score1" value="100" id="sub_score1"><span> 점</span></div>
                            <div class="score_input"><input type="text" placeholder="점수" name="sub_score2" value="100" id="sub_score2"><span> 점</span></div>
                        </div>
                    </div>
                </div>
                <div class="right_box_2">
                    <div class="student_each_score_table">
                        <table>
                            <thead>
                            <tr>
                                <th>학생명</th>
                                <th>1회</th>
                                <th>2회</th>
                                <th>평균 점수</th>
                            </tr>
                            </thead>
                            <tbody id="student_list">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="add_btn_wrap">
                <div class="l_btn_wrap">
                    <div class="sms_btn"><a href="#none">SMS발송</a></div>
                    <div class="print_btn"><a href="#none">출력</a></div>
                </div>
                <div class="r_btn_wrap">
                    <div class="complete_btn" onclick="submit()"><a>평가완료</a></div>
                </div>
            </div>
        </div>
    </div>
    </form>
</section>
</body>
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
    })
    
    function lecture(e, f, a, b) {
        $('#text_class').text(e);
        $('#class').val(e);
		$("#d_yoie").val(f);
        $.ajax({
            type: "GET",
            url: "call_student_list.php?class="+e,
            dataType: "html",
            success: function(response){
                $("#student_list").html(response);
            }
        });
		$("#d_id").val(a);
		$("#c_id").val(b);
    }

    function chk_test_genre(e) {
        if(e==1) {
            $('#text_genre').text("중간평가");
            $('#test_genre').val("중간평가");
        }
        if(e==2) {
            $('#text_genre').text("기말평가");
            $('#test_genre').val("기말평가");
        }
        if(e==3) {
            $('#text_genre').text("분기테스트");
            $('#test_genre').val("분기테스트");
        }
        if(e==4) {
            $('#text_genre').text("입반테스트");
            $('#test_genre').val("입반테스트");
        }
    }

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
        $('.ui-datepicker-trigger').width(25);
        $('.ui-datepicker-trigger').css('top', "4px");
        $('.ui-datepicker-trigger').css('position', "relative");
        $('.ui-datepicker-trigger').css('margin-left', "8px");
    } );

    function set_avg(e) {
        var k = e-1;
        var t = parseInt($('#score_add'+e).val(), 10);
        var p = parseInt($('#score_add'+k).val(), 10);
        var val;
        if(p) val = (t+p)/2;
        else val = t;

        $('#avg'+e/2).text(val+"점");
    }

    function set_avg1(e) {
        var k = e+1;
        var t = parseInt($('#score_add'+e).val(), 10);
        var p = parseInt($('#score_add'+k).val(), 10);
        var val;
        if(p) val = (t+p)/2;
        else val = t;

        $('#avg'+k/2).text(val+"점");
    }

    function move_page() {
        var a = $('#quarter_select').val();
        var b = $('#year_select').val();
        // alert(a);
        location.href = './record_management_add.php?s_year='+b+'&s_quarter='+a;
    }

    $("#year_select").val(<?php echo $s_year;?>);
    $("#quarter_select").val(<?php echo $s_quarter;?>);

    $(window).bind('beforeunload', function () {
        return "저장하지 않고 페이지를 벗어나시겠습니까?";
    });

    function submit() {
        if($('#title').val() && $('#datepicker').val() && $('#standard_score').val() && $('#sub_score1').val() && $('#sub_score2').val() && $('#test_genre').val()) {
            $(window).unbind('beforeunload');
            $('#record_form').submit();
        }else {
            alert('입력값이 빠진것이  없는지 확인해주세요.');
        }
    }
</script>
</body>

</html>