<?php
include_once('_common.php');
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

//include_once(G5_THEME_PATH.'/head.php');
//190130김영모 페이지 번호 입력
$now_menu_number = 40;
include_once('head.php');
if(!$_GET['page']) {
    $page = 0;
}else {
    $page = $_GET['page']-1;
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" media="screen" href="css/answer_manegement.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Expires" content="Mon, 06 Jan 1990 00:00:01 GMT">
    <meta http-equiv="Expires" content="-1">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
</head>

<body>
<div class="section">
    <div class="head_section">
        <p>정답지 목록</p>
    </div>
    <div class="view_section">
        <table style="text-align: center;">
            <thead>
            <tr>
                <th><input type="checkbox" id="all_select"></th>
                <th>학년</th>
                <th>학기</th>
                <th>단원</th>
                <th>레벨</th>
                <th>교재구분</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <form action="answer_del.php?page=<?=($page+1)?>" method="post" id="answer_form">
                <?php
                $sql = "select * from `answer_master` where `level` in ('루트', '파이', '시그마') order by `grade` asc, `semester` asc, `unit` asc, field(`level`, '루트', '파이', '시그마'),`book_type` desc";
                $result = mysqli_query($connect_db, $sql);

                $grade = array();
                $unit = array();
                $level = array();
                $semester = array();
                $book_type = array();
                $j=0;
                $t=0;
                while($ac_data = mysqli_fetch_array($result)) {
                    $n = 0;
                    for($i=0; $i<count($grade)+1; $i++) {
                        if ($book_type[$i] == $ac_data['book_type'] && $unit[$i] == $ac_data['unit'] && $grade[$i] == $ac_data['grade'] && $level[$i] == $ac_data['level'] && $semester[$i] == $ac_data['semester']) {
                            $n = 1;
                        }
                    }
                    if($n != 1) {
                        if($j >= $page*15 && $j < ($page*15+15)) {
                            if($ac_data['grade'] <= 6) $r_grade = "초등 ".$ac_data['grade'];
                            else $r_grade = "중등 ".($ac_data['grade']-6);
                            $del_value = $ac_data['book_type']."|".$ac_data['unit']."|".$ac_data['grade']."|".$ac_data['semester']."|".$ac_data['level'];
                            echo '<tr>';
                            echo '     <td><input type="checkbox" name="answer_chk[]" value="'.$del_value.'"></td>';
                            echo '     <td><span>' . $r_grade . '</span></td>';
                            echo '     <td><span>' . $ac_data["semester"] . '학기</span></td>';
                            echo '     <td><span>' . $ac_data["unit"] . '</span></td>';
                            echo '     <td><span>' . $ac_data["level"] . '</span></td>';
                            echo '     <td><span>' . $ac_data["book_type"] . '</span></td>';
                            echo "     <td><a href='./update_answer_add.php?grade=".$ac_data['grade']."&semester=".$ac_data['semester']."&unit=".$ac_data['unit']."&level=".$ac_data['level']."&book_type=".$ac_data['book_type']."&page=".($page+1)."' style=''>수정</a></td>";
                            echo '</tr>';
                            $t++;
                        }
                        $grade[$j] = $ac_data['grade'];
                        $unit[$j] = $ac_data['unit'];
                        $level[$j] = $ac_data['level'];
                        $semester[$j] = $ac_data['semester'];
                        $book_type[$j] = $ac_data['book_type'];
                        $j++;
                    }

                }
                if(!$t) echo location_href("./answer_manegement.php?page=".$page);
                ?>
            </form>
            </tbody>
        </table>
    </div>
    <div class="section_footer">
        <div class="list_btn_wrap">
            <div class="prev_btn"><a href="./answer_manegement.php?page=<?=$page;?>"><img src="img/prev.png" alt=""></a></div>
            <ul>
                <?
                $count = $j;
                for($i=0; $i<$count/15; $i++) {
                    $cnt = $i+1;
                    if($cnt==$_GET['page']) echo '<li><a href="./answer_manegement.php?page='.$cnt.'" class="on">'.$cnt.'</a></li>';
                    else echo '<li><a href="./answer_manegement.php?page='.$cnt.'">'.$cnt.'</a></li>';
                }
                ?>
            </ul>
            <div class="next_btn"><a href="./answer_manegement.php?page=<?=$page+2;?>"><img src="img/next.png" alt=""></a></div>
        </div>
        <div class="button_wrap">
            <div class="add_btn"><a href="answer_add.php?page=<?=$page+1?>">정답지추가</a></div>
            <div class="modify_btn" onclick="del_answer();"><a href="#">삭제</a></div>
        </div>
    </div>
</div>
<?php
include_once('tail.php');
if($t != 15) echo "<script>$('.next_btn').hide();</script>";
$page++;
if($page == 1) echo "<script>$('.prev_btn').hide();</script>";
?>
</body>
</html>
<script>
    $("#all_select").on('click', function () {
        if($('#all_select').prop('checked')) $('input[type=checkbox]').prop('checked', true);
        else $('input[type=checkbox]').prop('checked', false);
    });

    function del_answer() {
        if(confirm("삭제하시겠습니까?")) $('#answer_form').submit();
    }
</script>