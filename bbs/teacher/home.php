<?php
include_once ('./_common.php');
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
    <link rel="stylesheet" type="text/css" media="screen" href="css/index.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
</head>

<body>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">학기</p>
                <div class="day_select">
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
            </div>
            <div class="head_right">
                <div class="hw_make_btn"><a href="homework_manegement_add.html">숙제생성</a></div>
                <div class="scoring_shortcut_btn"><a href="student_manegement_score_all.html">채점바로가기</a></div>
            </div>
        </div>
    </div>
    <div class="class_table_section" style="z-index: 1;">
        <table>
            <thead>
            <tr>
                <th class="schedule">교시</th>
                <th class="blank">시간</th>
                <th class="day on">월</th>
                <th class="day">화</th>
                <th class="day">수</th>
                <th class="day">목</th>
                <th class="day">금</th>
                <th class="day">토</th>
                <th class="day">일</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1교시</td>
                <td>pm 4:00 ~ 5:30</td>
                <?php
                for($i=0; $i<7; $i++) {
                    if($day[0][$i]) {
                        ?>
                        <td>
                            <a href="student_manegement_record.html">
                                <div class="class_info">
                        <?php
                        for($j=0; $j<count($time); $j++) {
                            if($time[$j] == 1) {
                                echo "<p>".$d_name[$j]."</p>";
                            }
                        }
                        ?>
                                </div>
                            </a>
                        </td>
                        <?php
                    }else {
                        echo "<td></td>";
                    }
                }
                ?>
            </tr>
            <tr>
                <td>2교시</td>
                <td>pm 5:30 ~ 7:00</td>
                <?php
                for($i=0; $i<7; $i++) {
                    if($day[0][$i]) {
                        ?>
                        <td>
                            <a href="student_manegement_record.html">
                                <div class="class_info">
                                    <?php
                                    for($j=0; $j<count($time); $j++) {
                                        if($time[$j] == 2) {
                                            echo "<p>".$d_name[$j]."</p>";
                                        }
                                    }?>
                                </div>
                            </a>
                        </td>
                        <?php
                    }else {
                        echo "<td></td>";
                    }
                }
                ?>
            </tr>
            <tr>
                <td>3교시</td>
                <td>pm 7:00 ~ 8:30</td>
                <?php
                for($i=0; $i<7; $i++) {
                    if($day[0][$i]) {
                        ?>
                        <td>
                            <a href="student_manegement_record.html">
                                <div class="class_info">
                                    <?php
                                    for($j=0; $j<count($time); $j++) {
                                        if($time[$j] == 3) {
                                            echo "<p>".$d_name[$j]."</p>";
                                        }
                                    }?>
                                </div>
                            </a>
                        </td>
                        <?php
                    }else {
                        echo "<td></td>";
                    }
                }
                ?>
            </tr>
            <tr>
                <td>4교시</td>
                <td>pm 8:30 ~ 10:00</td>
                <?php
                for($i=0; $i<7; $i++) {
                    if($day[0][$i]) {
                        ?>
                        <td>
                            <a href="student_manegement_record.html">
                                <div class="class_info">
                                    <?php
                                    for($j=0; $j<count($time); $j++) {
                                        if($time[$j] == 4) {
                                            echo "<p>".$d_name[$j]."</p>";
                                        }
                                    }?>
                                </div>
                            </a>
                        </td>
                        <?php
                    }else {
                        echo "<td></td>";
                    }
                }
                ?>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="notice_list_wrap">
        <div class="notice_title">
            <p>공지사항</p>
        </div>
        <div class="notice_contents_wrap">
            <?php
            $sql = "select * from `teacher_notice` order by `seq` desc";
            $result = mysqli_query($connect_db, $sql);
            $i=1;
            while($res = mysqli_fetch_array($result)) {
                ?>
                <div class="notice_content">
                    <a href="./notice_list.php?seq=<?=$res['seq']?>"><span>&#149;</span><?=$res['title']?></a>
                </div>
                <?
                if($i==5) break;
                $i++;
            }

            ?>
        </div>
    </div>
</section>

</body>

</html>
<script>

</script>
