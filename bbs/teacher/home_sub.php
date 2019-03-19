<?php
include_once ('./_common.php');
include_once ('head_sub.php');
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
                    <select name="year_select" id="year_select" onchange="move_page()">
                        <?php
                        for($i=2018; $i<2030; $i++) {
                            echo "<option value='$i'>$i"."년"."</option>";
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
            </div>
            <div class="head_right">
                <div class="hw_make_btn"><a href="homework_management_add.php">숙제생성</a></div>
                <div class="scoring_shortcut_btn"><a href="student_management_score_all.php">채점바로가기</a></div>
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
                            <div class="class_info">
                                <?php
                                for($j=0; $j<count($time); $j++) {
                                    if($time[$j] == 1) {
                                        echo "<a href='student_management_record.php?d_uid=".$d_uid[$j]."&c_uid=".$c_uid[$j]."'>".$d_name[$j]."</a><br>";
                                    }
                                }
                                ?>
                            </div>
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
                            <div class="class_info">
                                <?php
                                for($j=0; $j<count($time); $j++) {
                                    if($time[$j] == 2) {
                                        echo "<a href='student_management_record.php?d_uid=".$d_uid[$j]."&c_uid=".$c_uid[$j]."'>".$d_name[$j]."</a><br>";
                                    }
                                }?>
                            </div>
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
                            <div class="class_info">
                                <?php
                                for($j=0; $j<count($time); $j++) {
                                    if($time[$j] == 3) {
                                        echo "<a href='student_management_record.php?d_uid=".$d_uid[$j]."&c_uid=".$c_uid[$j]."'>".$d_name[$j]."</a><br>";
                                    }
                                }?>
                            </div>
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
                            <div class="class_info">
                                <?php
                                for($j=0; $j<count($time); $j++) {
                                    if($time[$j] == 4) {
                                        echo "<a href='student_management_record.php?d_uid=".$d_uid[$j]."&c_uid=".$c_uid[$j]."'>".$d_name[$j]."</a><br>";
                                    }
                                }?>
                            </div>
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
    function move_page() {
        var a = $('#quarter_select').val();
        var b = $('#year_select').val();
        // alert(a);
        location.href = './home_sub.php?s_year='+b+'&s_quarter='+a;
    }

    $("#year_select").val(<?php echo $s_year;?>);
    $("#quarter_select").val(<?php echo $s_quarter;?>);
</script>
