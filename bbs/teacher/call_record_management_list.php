<?php
include_once ('_common.php');
$class = $_GET['class'];
$test_genre = $_GET['genre'];
$title = $_GET['title'];

$sql = "select * from `teacher_score` where `class` = '$class' and `test_genre` = '$test_genre' and `title` = '$title';";
$result = mysqli_query($connect_db, $sql);

$cnt = 0;
$tot = 0;
$score_list = array();
while($res = mysqli_fetch_array($result)) {
    $tot += $res['score1']+$res['score2'];
    $score_list[$cnt] = $res['score1']+$res['score2'];
    $cnt++;
}

$sql = "select * from `teacher_score` where `title` = '$title' and `test_genre` = '$test_genre';";
$result = mysqli_query($connect_db, $sql);
$a_score_list = array();
$a_tot = 0;
$a_cnt = 0;
while($res = mysqli_fetch_array($result)) {
    $a_tot += $res['score1']+$res['score2'];
    $a_score_list[$cnt] = $res['score1']+$res['score2'];
    $a_cnt++;
}

$sql = "select * from `teacher_score` where `class` = '$class' and `test_genre` = '$test_genre' and `title` = '$title';";
$result = mysqli_query($connect_db, $sql);
$res = mysqli_fetch_array($result);
?>
<form action="record_management_del.php?class=<?=$class?>&test_genre=<?=$test_genre?>&title=<?=$title?>" method="post" id="score_form">
    <div class="right_box">
        <div class="right_box_1">
            <div class="r_left_box">
                <div class="division">
                    <p class="l_div_title">대상반</p>
                    <p class="r_div_content">
                        <span><?=$res['class']?></span>
                    </p>
                </div>
                <div class="division">
                    <p class="l_div_title">시험일</p>
                    <p class="r_div_content"><?=$res['date']?></p>
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
                            <p class="lt">100점 만점</p>
                            <p class="rt"><span style="color: blue;"><?=sprintf("%.1f", $a_tot/$a_cnt/2)?></span><span>점</span></p>
                        </div>
                        <div class="down_average">
                            <p class="lt">최고 점수</p>
                            <p class="rt"><span style="color: red;"><?=sprintf("%.1f", $a_tot/$a_cnt/2)?></span><span>점</span></p>
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
                    <p class="r_div_content"><?=$res['title']?></p>
                </div>
                <div class="division">
                    <p class="l_div_title">응시인원</p>
                    <p class="r_div_content"><span><?=$a_cnt?></span></p>
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
                    $sql = "select * from `teacher_score` where `class` = '$class' and `test_genre` = '$test_genre' and `title` = '$title' order by `seq`;";
                    $result = mysqli_query($connect_db, $sql);
                    while($res = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><input type="checkbox" name="chk_list[]" value="<?=$res['seq']?>"></td>
                            <td><span><input type="hidden" name="student[]" value="<?=$res['student']?>"><?=$res['student']?></span></td>
                            <td><span><input type="text" name="score1[]" value="<?=$res['score1']?>"> 점</span></td>
                            <td><span><input type="text" name="score2[]" value="<?=$res['score2']?>"> 점</span></td>
                            <td><span><?=sprintf("%.1f", ($res['score1']+$res['score2'])/2)?> 점</span></td>
                        </tr>
                        <?
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="add_btn_wrap">
        <div class="l_btn_wrap">
            <div class="score_delete_btn w_b" onclick="all_del_score()"><a>전체삭제</a></div>
            <div class="student_delete_btn w_b" onclick="del_score()"><a>선택삭제</a></div>
        </div>
        <div class="r_btn_wrap">
            <div class="excel_btn f_b"><a href="#none">EXCEL</a></div>
            <div class="print_btn f_b" onclick="print_data()"><a>출력</a></div>
            <div class="complete_btn f_b" onclick='save()'><a>저장</a></div>
        </div>
    </div>
</form>
<script>
    function print_data() {
        window.print();
    }

    function save() {
        $(window).unbind('beforeunload');
        $('#score_form').submit();
    }

    function del_score() {
        $('input[type=checkbox]:checked').parent().parent().css('display', 'none');
    }

    function all_del_score() {
        $('input[type=checkbox]').prop('checked', true);
        del_score();
    }
</script>