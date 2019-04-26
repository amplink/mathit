<?php
include_once ('_common.php');
include_once ('head.php');

$class = $_GET['class'];
$test_genre = $_GET['test_genre'];
$title = $_GET['title'];
?>

    <link rel="stylesheet" type="text/css" href="css/record_manegement_list.css" />

    <section>
        <div class="head_section">
            <div class="head_section_1400">
                <div class="head_left">
                    <p class="left_text">성적조회</p>
                </div>
                <div class="head_right">
                    <div class="homework_menu"><a href="record_management_add.php">성적입력</a></div>
                    <div class="homework_menu on"><a href="record_management_list.php" class="on">성적조회</a></div>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <div class="left_box" style="overflow: scroll; max-height: 685px;">
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
                            <tr class="select_box1">
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
                            <th>담당 교사</th>
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
                            <th>시험 유형</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="select_box2">
                            <td onclick="chk_test_genre(1)"><span>중간평가</span></td>
                        </tr>
                        <tr class="select_box2">
                            <td onclick="chk_test_genre(2)"><span>기말평가</span></td>
                        </tr>
                        <tr class="select_box2">
                            <td onclick="chk_test_genre(3)"><span>분기테스트</span></td>
                        </tr>
                        <tr class="select_box2">
                            <td onclick="chk_test_genre(4)"><span>입반테스트</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="test_select_box select_table grade_select_box content">
                    <table>
                        <thead>
                        <tr>
                            <th>시험 목록</th>
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
            //$('.grade_select_box table tbody tr').click(function () {
            $(document).on("click",".select_box1",function(){

                if ($(this).hasClass('on') === true) {
                    // $(this).removeClass('on')
                } else {
                    $(this).addClass('on');
                    $('.grade_select_box table tbody tr').not(this).removeClass('on');
                }
            })

            $(document).on("click",".select_box4",function(){
                if ($(this).hasClass('on') === true) {
                    // $(this).removeClass('on')
                } else {
                    $(this).addClass('on');
                    $('.class_select_box table tbody tr').not(this).removeClass('on');
                }
            })

            $(document).on("click",".select_box2",function(){
                if ($(this).hasClass('on') === true) {
                    $(this).removeClass('on')
                } else {
                    $(this).addClass('on');
                    $('.student_list_box table tbody tr').not(this).removeClass('on');
                }
            })

            $(document).on("click",".select_box3",function(){
                if ($(this).hasClass('on') === true) {
                    $(this).removeClass('on')
                } else {
                    $(this).addClass('on');
                    $('.test_select_box table tbody tr').not(this).removeClass('on');
                }
            })
        });

        $(window).bind('beforeunload', function () {
            return "저장하지 않고 페이지를 벗어나시겠습니까?";
        });

        var d_uid;
        var c_uid;
        var s_uid;
        var d_order;
        var test_genre;
        var class_name;

        function lecture(e) {
            $.ajax({
                type: "GET",
                url: "call_student_list.php?class="+e,
                dataType: "html",
                success: function(response){
                    $("#class_name").html(response);
                    $("#test_list").empty();
                    $(".right_wrap").empty();
                    $('.select_box2').removeClass('on');
                    d_uid = "";
                    c_uid = "";
                    s_uid = "";
                    d_order = "";
                    test_genre = "";
                }
            });
            class_name = e;
        }

        function chk_test_genre(e) {
            if(e==1) test_genre = "중간평가";
            if(e==2) test_genre = "기말평가";
            if(e==3) test_genre = "분기테스트";
            if(e==4) test_genre = "입반테스트";

            $.ajax({
                type: "GET",
                url: "call_test_list.php?d_uid="+d_uid+"&c_uid="+c_uid+"&s_uid="+s_uid+"&test_genre="+test_genre,
                dataType: "html",
                success: function(response){
                    $("#test_list").html(response);
                }
            });
        }

        function call_data(e) {
            if(test_genre == "입반테스트" || test_genre == "분기테스트") {
                $.ajax({
                    type: "GET",
                    url: "call_record_management_list2.php?d_uid="+d_uid+"&c_uid="+c_uid+"&s_uid="+s_uid+"&class="+class_name+"&genre="+test_genre+"&title="+e+"&d_order="+d_order,
                    dataType: "html",
                    success: function(response){
                        $(".right_wrap").html(response);
                    }
                });
            }else {
                $.ajax({
                    type: "GET",
                    url: "call_record_management_list.php?d_uid="+d_uid+"&c_uid="+c_uid+"&s_uid="+s_uid+"&class="+class_name+"&genre="+test_genre+"&title="+e+"&d_order="+d_order,
                    dataType: "html",
                    success: function(response){
                        $(".right_wrap").html(response);
                    }
                });
            }
        }

        function set_plus(e) {
            var k = e+1;
            var kk = e+2;
            var a = parseInt($('#score_add'+e).val());
            var b = parseInt($('#score_add'+k).val());
            var c = parseInt($('#score_add'+kk).val());
            var val;

            if(a && b && c) val = a+b+c;
            else if(a && b) val = a+b;
            else if(a && c) val = a+c;
            else if(b && c) val = b+c;
            else if(a) val = a;
            else if(b) val = b;
            else if(c) val = c;

            $('#plus'+e).text(val+" 점");
        }

        function set_avg1(e) {
            var k = e+1;
            var t = parseInt($('#score_add'+e).val(), 10);
            var p = parseInt($('#score_add'+k).val(), 10);
            var val;
            if(t && p) {
                val = (t+p)/2;
            }else if(t) {
                val = t;
            }else {
                val = p;
            }

            $('#avg'+k/2).text(val+"점");
        }

        function call_student_form(d, c, s, n) {
            d_uid = d;
            c_uid = c;
            s_uid = s;
            d_order = n;
            $("#test_list").empty();
            $(".right_wrap").empty();
            $('.select_box2').removeClass('on');
            var s_type = $('#s_type').val();

            if(s_type==1) test_genre = "중간평가";
            if(s_type==2) test_genre = "기말평가";
            if(s_type==3) test_genre = "분기테스트";
            if(s_type==4) test_genre = "입반테스트";

            $.ajax({
                type: "GET",
                url: "call_test_list.php?d_uid="+d+"&c_uid="+c+"&s_uid="+s+"&test_genre="+test_genre,
                dataType: "html",
                success: function(response){
                    $("#test_list").html(response);
                }
            });

        }

        function save(title) {
            $(window).unbind('beforeunload');
            var url = $('#url').val();
            $.ajax({
                url: url,
                type: 'post',
                data: $('#score_form').serialize(),
                success: function(response) {
                    alert('완료되었습니다.');
                    if(response == 1) call_data(title);
                    else location.href = './record_management_list.php';
                }
            });
            return false;
        }

        function move_page() {
            var a = $('#quarter_select').val();
            var b = $('#year_select').val();
            // alert(a);
            location.href = './record_management_list.php?s_year='+b+'&s_quarter='+a;
        }

        $("#year_select").val(<?php echo $s_year;?>);
        $("#quarter_select").val(<?php echo $s_quarter;?>);
    </script>
    </body>

    </html>
<?php
if($class) {
    if($test_genre == "중간평가") $e = 1;
    if($test_genre == "기말평가") $e = 2;
    if($test_genre == "입반테스트") $e = 4;
    if($test_genre == "분기테스트") $e = 3;

    echo "<script>lecture('$class');chk_test_genre($e);call_data('$title')</script>";
}
?>