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
    <link rel="icon" type="image/png" sizes="96x96" href="img/f.png">
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/student_manegement_score_all.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
</head>

<body>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">미 채점 목록</p>
                <p>- 전체</p>
            </div>
            <div class="head_right">
            </div>
        </div>
    </div>
    <div class="student_table_section">
        <table>
            <thead>
            <tr>
                <th>학년 / 학급명</th>
                <th>학생명</th>
                <th>숙제명</th>
                <th>제출기한</th>
                <th>제출상태</th>
                <th>채점상태</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $sql = "select * from `homework`";
                $result = mysqli_query($connect_db, $sql);
                while($res = mysqli_fetch_array($result)) {
                    $student_name = explode(",", $res['student']);
                    if($student_name[1]) {
                        for($i=0; $i<count($student_name); $i++) {
                            ?>
                            <tr>
                                <td><span><?=$res['grade']?></span><span><?=$res['level']?></span></td>
                                <td><span><?=$student_name[$i]?></span></td>
                                <td><span><?=$res['name']?></span><br><?=$res['grade']."-".$res['semester']."-".$res['unit']?></td>
                                <td><span><?=$res['_from']?> ~ <?=$res['_to']?></span></td>
                                <td>
                                    <!-- 나중에 처리 -->
                                    <div class="chk_box on"></div>
                                    <div class="chk_box"></div>
                                </td>
                                <td>
                                    <div class="scoring_btn"><a href="#none">채점하기</a></div>
                                </td>
                            </tr>
                            <?php
                        }
                    }else {
                        ?>
                        <tr>
                            <td><span><?=$res['grade']?></span><span><?=$res['level']?></span></td>
                            <td><span><?=$res['student']?></span></td>
                            <td><span><?=$res['name']?></span><br><?=$res['grade']."-".$res['semester']."-".$res['unit']?></td>
                            <td><span><?=$res['_from']?> ~ <?=$res['_to']?></span></td>
                            <td>
                                <!-- 나중에 처리 -->
                                <div class="chk_box on"></div>
                                <div class="chk_box"></div>
                            </td>
                            <td>
                                <div class="scoring_btn"><a href="#none">채점하기</a></div>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</section>
</body>

</html>
