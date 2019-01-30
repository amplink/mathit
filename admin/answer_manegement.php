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
                        <th>학년</th>
                        <th>학기</th>
                        <th>단원</th>
                        <th>레벨</th>
                        <th>교재구분</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "select * from `answer_master` order by `event_time` asc";
                    $result = mysqli_query($connect_db, $sql);

                    $grade = array();
                    $unit = array();
                    $level = array();
                    $semester = array();
                    $book_type = array();
                    $j=0;
                    $t=1;
                    while($ac_data = mysqli_fetch_array($result)) {
                        $n = 0;
                        for($i=0; $i<count($grade)+1; $i++) {
                            if ($book_type[$i] == $ac_data['book_type'] && $unit[$i] == $ac_data['unit'] && $grade[$i] == $ac_data['grade'] && $level[$i] == $ac_data['level'] && $semester[$i] == $ac_data['semester']) {
                                $n = 1;
                            }
                        }


                       if($n != 1) {
                           if($t >= $page*10 && $t <= ($page*10+10)) {
                               echo '<tr>';
                               echo '     <td><span>' . $ac_data["grade"] . '</span></td>';
                               echo '     <td><span>' . $ac_data["semester"] . '</span></td>';
                               echo '     <td><span>' . $ac_data["unit"] . '</span></td>';
                               echo '     <td><span>' . $ac_data["level"] . '</span></td>';
                               echo '     <td><span>' . $ac_data["book_type"] . '</span></td>';
                               echo '</tr>';
                               //<a href="./update_answer_add.php?grade='.$ac_data['grade'].'&semester='.$ac_data['semester'].'&unit='.$ac_data['unit'].'&level='.$ac_data['level'].'&book_type='.$ac_data['book_type'].'">
                               $grade[$j] = $ac_data['grade'];
                               $unit[$j] = $ac_data['unit'];
                               $level[$j] = $ac_data['level'];
                               $semester[$j] = $ac_data['semester'];
                               $book_type[$j] = $ac_data['book_type'];
                               $j++;
                           }
                           $t++;
                       }


                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="section_footer">
            <div class="list_btn_wrap">
                <div class="prev_btn"><a href="./answer_manegement.php?page=<?=$page;?>"><img src="img/prev.png" alt=""></a></div>
                <ul>
                    <?
                    $count = $t;
                    for($i=0; $i<$count/10; $i++) {
                        $cnt = $i+1;
                        echo '<li><a href="./answer_manegement.php?page='.$cnt.'">'.$cnt.'</a></li>';
                    }
                    ?>
                </ul>
                <div class="next_btn"><a href="./answer_manegement.php?page=<?=$page+1;?>"><img src="img/next.png" alt=""></a></div>
            </div>
            <div class="button_wrap">
                <div class="add_btn"><a href="answer_add.php">정답지추가</a></div>
                <!-- <div class="modify_btn"><a href="#none">수정</a></div> -->
            </div>
        </div>
    </div>
</body>

</html>