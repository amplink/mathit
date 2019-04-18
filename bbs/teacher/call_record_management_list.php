<?php
include_once ('_common.php');
$class = $_GET['class'];
$test_genre = $_GET['genre'];
$title = $_GET['title'];
$d_order = $_GET['d_order'];
$d_uid = $_GET['d_uid'];
$c_uid = $_GET['c_uid'];
$s_uid = $_GET['s_uid'];

$sql = "select score1, score2, score3, grade, class, date, title 
from `teacher_score` where `d_uid`='$d_uid' and `c_uid`='$c_uid' and `s_uid`='$s_uid' and `class` = '$class' and `test_genre` = '$test_genre' and `title` = '$title';";
$result = mysqli_query($connect_db, $sql);

//반 평균
$cnt = 0;
$tot = 0;
$a_cnt = 0;
$score_list = array();
while($res = mysqli_fetch_array($result)) {
    $tot += $res['score1']+$res['score2']+$res['score3'];
    $score_list[$cnt] = $res['score1']+$res['score2']+$res['score3'];
    $cnt++;
    $a_cnt++;
    $grade = $res['grade'];
    $title = $res['title'];
    $date = $res['date'];
}

//동일 학년
$sql = "select score1, score2, score3 from `teacher_score` where `d_uid`='$d_uid' and `test_genre` = '$test_genre' and `grade` = '$grade';";
$result = mysqli_query($connect_db, $sql);
$a_score_list = array();
$a_tot = 0;
$a_cnt2 = 0;
while($res = mysqli_fetch_array($result)) {
    $a_tot += $res['score1']+$res['score2']+$res['score3'];
    $a_score_list[$cnt] = $res['score1']+$res['score2']+$res['score3'];
    $a_cnt2++;
}

//동일 레벨
$sql = "select score1, score2, score3 from `teacher_score` where `d_uid`='$d_uid' and `test_genre` = '$test_genre' and `class`='$class';";
$result = mysqli_query($connect_db, $sql);
$a_score_list1 = array();
$a_tot1 = 0;
$a_cnt1 = 0;
while($res = mysqli_fetch_array($result)) {
    $a_tot1 += $res['score1']+$res['score2']+$res['score3'];
    $a_score_list1[$cnt] = $res['score1']+$res['score2']+$res['score3'];
    $a_cnt1++;
}


?>
<form method="post" id="score_form">
    <input type="hidden" value="record_management_del.php?class=<?=$class?>&test_genre=<?=$test_genre?>&title=<?=$title?>" id="url">
    <div class="right_box" id="right_box">
        <div class="right_box_1">
            <div class="r_left_box">
                <div class="division">
                    <p class="l_div_title">대상반</p>
                    <p class="r_div_content">
                        <span><?=$class?></span>
                    </p>
                </div>
                <div class="division">
                    <p class="l_div_title">시험일</p>
                    <p class="r_div_content"><? echo substr($date,-4)."-".substr($date,0,2)."-".substr($date,3,2)?></p>
                </div>
                <div class="division col2">
                    <p class="l_div_title">반평균</p>
                    <div class="score_average">
                        <div class="up_average">
                            <p class="lt">100점 만점</p>
                            <p class="rt"><span style="color: blue;"><?=sprintf("%.1f", ($tot/$cnt/2))?></span><span>점</span></p>
                        </div>
                        <div class="down_average">
                            <p class="lt">최고 점수</p>
                            <p class="rt"><span style="color: red;"><?=sprintf("%.1f", max($score_list)/$cnt/2)?></span><span>점</span></p>
                        </div>
                    </div>
                </div>
                <div class="division col2">
                    <p class="l_div_title">전체평균</p>
                    <div class="score_average">
                        <div class="up_average">
                            <p class="lt">동일레벨</p>
                            <p class="rt"><span style="color: blue;"><?=sprintf("%.1f", $a_tot1/$a_cnt1/2)?></span><span>점</span></p>
                        </div>
                        <div class="down_average">
                            <p class="lt">동일학년</p>
                            <p class="rt"><span style="color: red;"><?=sprintf("%.1f", $a_tot/$a_cnt2/2)?></span><span>점</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="r_right_box">
                <div class="division">
                    <p class="l_div_title">시험유형</p>
                    <p class="r_div_content"><?=$test_genre?></p>
                </div>
                <div class="division">
                    <p class="l_div_title">시험명</p>
                    <p class="r_div_content"><?=$title?></p>
                </div>
                <div class="division">
                    <p class="l_div_title">응시인원</p>
                    <p class="r_div_content"><span><?=$cnt?></span></p>
                </div>
            </div>
        </div>
        <div class="right_box_2">
            <div class="student_each_score_table">
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <th>학생명</th>
                        <th>1회</th>
                        <th>2회</th>
                        <th>평균 점수</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $sql = "select * from `teacher_score` where `d_uid`='$d_uid' and `c_uid`='$c_uid' and `s_uid`='$s_uid' and `class` = '$class' and `test_genre` = '$test_genre' and `title` = '$title' order by `seq`;";
                    $result = mysqli_query($connect_db, $sql);
                    $i=1;
                    $cnt=1;
                    while($res = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><input type="checkbox" name="chk_list[]" value="<?=$res['seq']?>"></td>
                            <td><span><input type="hidden" name="student[]" value="<?=$res['student']?>"><?=$res['student']?></span></td>
                            <td><span><input type="text" name="score1[]" value="<?=$res['score1']?>" onchange="set_avg1(<?=$cnt?>)" id="score_add<?=$cnt?>"> 점</span></td>
                            <?php $cnt++;?>
                            <td><span><input type="text" name="score2[]" value="<?=$res['score2']?>" onchange="set_avg(<?=$cnt?>)" id="score_add<?=$cnt?>"> 점</span></td>
                            <td><span id="avg<?=$i?>"><?=sprintf("%.1f", ($res['score1']+$res['score2'])/2)?> 점</span></td>
                        </tr>
                        <?
                        $i++;
                        $cnt++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="add_btn_wrap">
        <div class="l_btn_wrap">
            <div class="score_delete_btn w_b" onclick="all_del_score()" style="cursor: pointer;"><a>전체삭제</a></div>
            <div class="student_delete_btn w_b" onclick="del_score()" style="cursor: pointer;"><a>선택삭제</a></div>
        </div>
        <div class="r_btn_wrap">
            <div class="excel_btn f_b" onclick="excel_down()" style="cursor: pointer;"><a>EXCEL</a></div>
            <div class="print_btn f_b" onclick="info_print()" style="cursor: pointer;"><a>출력</a></div>
            <div class="complete_btn f_b" onclick='save()' onmouseover="cursor()"><a>저장</a></div>
        </div>
    </div>
</form>
<script>
    function print_data() {
        window.print();
    }

    function del_score() {
        $('input[type=checkbox]:checked').parent().parent().css('display', 'none');
    }

    function all_del_score() {
        $('input[type=checkbox]').prop('checked', true);
        del_score();
    }
    function cursor() {
        $('.complete_btn').css('cursor', 'pointer');
    }

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

    function excel_down() {
        location.href="./excel_down.php?d_uid=<?=$_GET['d_uid']?>&c_uid=<?=$_GET['c_uid']?>&s_uid=<?=$_GET['s_uid']?>&class=<?=$_GET['class']?>&genre=<?=$_GET['genre']?>&title=<?=$_GET['title']?>&d_order=<?=$_GET['d_order']?>";
    }

    function info_print() {
        var initBody = document.body.innerHTML;
        window.onbeforeprint = function () {
            document.body.innerHTML = document.getElementById("right_box").innerHTML;
        }
        window.onafterprint = function () {
            document.body.innerHTML = initBody;
        }
        window.print();
    }
</script>