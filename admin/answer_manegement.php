<?php
include_once('_common.php');
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

//include_once(G5_THEME_PATH.'/head.php');
include_once('head.php');

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
                    $sql = "select * from `answer_master`";
                    $result = mysqli_query($connect_db, $sql);

                    $grade = array();
                    $unit = array();
                    $level = array();
                    $semester = array();
                    $book_type = array();
                    $j=0;

                    while($ac_data = mysqli_fetch_array($result)) {
                        $n = 0;
                        for($i=0; $i<count($grade)+1; $i++) {
                            if ($book_type[$i] == $ac_data['book_type'] && $unit[$i] == $ac_data['unit'] && $grade[$i] == $ac_data['grade'] && $level[$i] == $ac_data['level'] && $semester[$i] == $ac_data['semester']) {
                                $n = 1;
                            }
                        }


                       if($n != 1) {
                           echo '<tr>';
                           echo '     <td><span>'.$ac_data["grade"].'</span></td>';
                           echo '     <td><span>'.$ac_data["semester"].'</span></td>';
                           echo '     <td><span>'.$ac_data["unit"].'</span></td>';
                           echo '     <td><span>'.$ac_data["level"].'</span></td>';
                           echo '     <td><span>'.$ac_data["book_type"].'</span></td>';
                           echo '  </tr>';

                           $grade[$j] = $ac_data['grade'];
                           $unit[$j] = $ac_data['unit'];
                           $level[$j] = $ac_data['level'];
                           $semester[$j] = $ac_data['semester'];
                           $book_type[$j] = $ac_data['book_type'];
                           $j++;
                       }


                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="section_footer">
            <div class="list_btn_wrap">
                <div class="prev_btn"><a href="#none"><img src="img/prev.png" alt=""></a></div>
                <ul>
                    <li><a href="#none" class="on">1</a></li>
                    <li><a href="#none">2</a></li>
                    <li><a href="#none">3</a></li>
                    <li><a href="#none">4</a></li>
                    <li><a href="#none">5</a></li>
                </ul>
                <div class="next_btn"><a href="#none"><img src="img/next.png" alt=""></a></div>
            </div>
            <div class="button_wrap">
                <div class="add_btn"><a href="answer_add.php">정답지추가</a></div>
                <!-- <div class="modify_btn"><a href="#none">수정</a></div> -->
            </div>
        </div>
    </div>
</body>

</html>