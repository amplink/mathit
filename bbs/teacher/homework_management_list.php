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
                <div class="homework_menu on"><a href="homework_management_add.php" class="on">숙제생성</a></div>
                <div class="homework_menu"><a href="homework_management_list.php">숙제조회</a></div>
            </div>
        </div>
    </div>
        <div class="wrapper">
            <div class="left_box">
                <p class="box_title">출제 대상 선택</p>
                <div class="box_menu_wrap">
                    <p>학기</p>
                    <select name="year_select" id="year_select" onchange="select_year()">
                        <?php
                        for($i=0; $i<count($year); $i++) {
                            ?>
                            <option value="<?=$year[$i]?>"><?=$year[$i]?></option>
                            <?php
                        }
                        ?>

                    </select>
                    <select name="quarter_select" id="quarter_select" onchange="select_year()">
                        <?php
                        for($i=0; $i<count($quarter); $i++) {
                            ?>
                            <option value="<?=$quarter[$i]?>"><?=$quarter[$i]?></option>
                            <?php
                        }
                        ?>
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
                                <td onclick="lecture(<?=$d_uid[$i]?>,<?=$c_uid[$i]?>)"><span><?=$d_name[$i]?></span></td>
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
                        <input type="checkbox">
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
                        <tbody>
                        <?php
                        $sql = "select * from `homework`";
                        $result = sql_query($sql);
                        $i=0;
                        while($res = mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                                <td>
                                    <div class="x_btn"><img src="img/close.png" alt="delete_icon" onclick="del_homework('<?=$res['name']?>')"></div>
                                </td>
                                <td>
                                    <span><?=$res['name']?></span>
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
                                <td><select name="grade" id="grade<?=$i?>" onchange="">
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
                                <td><select name="semester" id="semester" onchange="">
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
                                <script>
                                    book_info(<?=$i?>);
                                </script>
                                <td>
                                    <select name="unit" id="unit">
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
                                        for($i=1; $i<=30; $i++) {
                                            if($q_1[$cnt] == $i) {
                                                echo "<option class='checkbox' value='$i' selected>$i</option>";
                                                $cnt++;
                                            }
                                            else echo "<option class='checkbox' value='$i'>$i</option>";
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
                                        for($i=1; $i<=30; $i++) {
                                            if($q_2[$cnt] == $i) {
                                                echo "<option class='checkbox' value='$i' selected>$i</option>";
                                                $cnt++;
                                            }
                                            else echo "<option class='checkbox' value='$i'>$i</option>";
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
                                        for($i=1; $i<=30; $i++) {
                                            if($q_3[$cnt] == $i) {
                                                echo "<option class='checkbox' value='$i' selected>$i</option>";
                                                $cnt++;
                                            }
                                            else echo "<option class='checkbox' value='$i'>$i</option>";
                                        }
                                        ?>
                                    </select>
                                </td>

                                <td>
                                    <select name="corner4[]" id="corner4<?=$i?>">
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
                                    <select name="Q_number4" id="Q_number4" class="custumdropdown" custumdrop="question" multiple="multiple">
                                        <?php
                                        $q_4 = explode(",", $res['Q_number4']);
                                        $cnt = 0;
                                        for($i=1; $i<=30; $i++) {
                                            if($q_4[$cnt] == $i) {
                                                echo "<option class='checkbox' value='$i' selected>$i</option>";
                                                $cnt++;
                                            }
                                            else echo "<option class='checkbox' value='$i'>$i</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <span>2018-07-01</span>
                                </td>
                                <td>
                                    <span>2018-08-01</span>
                                </td>
                                <td>
                                    <?php
                                    $date = str_replace("/", "-", $res['_from']);
                                    $date = explode('-', $date);
                                    $datee = $date[2].'-'.$date[0].'-'.$date[1];
                                    $today = date("Y-m-d");
                                    $c_date = date_create($datee);
                                    $c_today = date_create($today);
                                    $diff = date_diff($c_today, $c_date);
                                    $k = $diff->format("%R%a");
                                    if($k < 0) {
                                        if($res['checked']==0) {
                                            echo '<p class="ing_text" style=" color: blue;">진행중</p>';
                                        }else echo '<p class="complete_text">완료</p>';
                                    }else if($k > 0) {
                                        echo '<div class="resend_btn" style="display: none;"><a href="#none">재전송</a></div>';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
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

    function lecture(a, b) {
        $.ajax({
            type: "GET",
            url: "call_student_homework.php?d_uid="+a+"&c_uid="+b,
            dataType: "html",
            success: function(response){
                $("#students").html(response);
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
</script>
</body>

</html>