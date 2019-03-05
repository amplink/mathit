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
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/record_manegement_list.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
</head>

<body>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">성적조회</p>
            </div>
            <div class="head_right">
                <div class="homework_menu on"><a href="record_management_list.php" class="on">성적조회</a></div>
                <div class="homework_menu"><a href="record_management_add.php">성적입력</a></div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="left_box">
            <p class="box_title">출제대상 선택</p>
            <div class="box_menu_wrap">
                <p>학기</p>
                <select name="year_select" id="year_select">
                    <?
                    for($i=0; $i<count($year); $i++) echo "<option value='".$year[$i]."'>".$year[$i]."</option>";
                    ?>
                </select>
                <select name="quarter_select" id="quarter_select">
                    <?
                    for($i=0; $i<count($quarter); $i++) echo "<option value='".$quarter[$i]."'>".$quarter[$i]."</option>";
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
                            <td onclick="lecture('<?=$d_name[$i]?>')"><span><?=$d_name[$i]?></span></td>
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
            <div class="select_table grade_select_box content">
                <table>
                    <thead>
                        <tr>
                            <th>시험목록</th>
                        </tr>
                    </thead>
                    <tbody id="test_list">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="right_wrap">

        </div>
    </div>
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
    });

    var class_name;
    var test_genre;

    function lecture(e) {
        class_name = e;
        $.ajax({
            type: "GET",
            url: "call_test_list.php?class="+class_name+"&genre="+test_genre,
            dataType: "html",
            success: function(response){
                $("#test_list").html(response);
            }
        });
    }

    function chk_test_genre(e) {
        if(e==1) test_genre = "중간평가";
        if(e==2) test_genre = "기말평가";
        if(e==3) test_genre = "분기테스트";
        if(e==4) test_genre = "입반테스트";
        // alert("call_test_list.php?class="+class_name+"&genre="+test_genre);
        $.ajax({
            type: "GET",
            url: "call_test_list.php?class="+class_name+"&genre="+test_genre,
            dataType: "html",
            success: function(response){
                $("#test_list").html(response);
            }
        });
    }

    function call_data(e) {
        // alert("call_record_management_list.php?class="+class_name+"&genre="+test_genre+"&title="+e);
        $.ajax({
            type: "GET",
            url: "call_record_management_list.php?class="+class_name+"&genre="+test_genre+"&title="+e,
            dataType: "html",
            success: function(response){
                $(".right_wrap").html(response);
            }
        });
    }
</script>
</body>

</html>