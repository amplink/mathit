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

                    $grade = "";
                    $unit = "";
                    $level = "";
                    $semester = "";
                    $book_type = "";

                    while($ac_data = mysqli_fetch_array($result)) {
                        if($book_type == $ac_data['book_type'] && $unit == $ac_data['unit'] && $grade == $ac_data['grade']
                            && $level == $ac_data['level'] && $semester == $ac_data['semester']) continue;
                       else {
                           echo '<tr>';
                           echo '     <td><span>'.$ac_data["grade"].'</span></td>';
                           echo '     <td><span>'.$ac_data["semester"].'</span></td>';
                           echo '     <td><span>'.$ac_data["unit"].'</span></td>';
                           echo '     <td><span>'.$ac_data["level"].'</span></td>';
                           echo '     <td><span>'.$ac_data["book_type"].'</span></td>';
                           echo '  </tr>';

                           $grade = $ac_data['grade'];
                           $unit = $ac_data['unit'];
                           $level = $ac_data['level'];
                           $semester = $ac_data['semester'];
                           $book_type = $ac_data['book_type'];
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