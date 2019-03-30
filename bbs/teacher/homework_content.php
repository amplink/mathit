<?php
include_once ('_common.php');
$class_name = $_GET['class_name'];

$sql = "select * from `homework` where `class_name`='$class_name';";
$result = sql_query($sql);
$i=0;
?>
<?php
while($res = mysqli_fetch_array($result)) {
    ?>
    <tr>
        <td>
            <div class="x_btn"><img src="img/close.png" alt="delete_icon" onclick="del_homework('<?=$res['name']?>')"></div>
        </td>
        <td>
            <span><?=$res['name']?></span>
        </td>

        <td><select name="textbook" id="textbook">
                <?php
                if($res['textbook']=="알파") {
                    ?>
                    <option value="알파" selected>알파</option>
                    <option value="베타">베타</option>
                    <?php
                }else {
                    ?>
                    <option value="알파">알파</option>
                    <option value="베타" selected>베타</option>
                    <?php
                }
                ?>
            </select></td>
        <td><select name="grade" id="grade<?=$i?>" onchange="">
                <option value="초3">초3</option>
                <option value="초4">초4</option>
                <option value="초5">초5</option>
                <option value="초6">초6</option>
                <option value="중1">중1</option>
                <option value="중2">중2</option>
                <option value="중3">중3</option>
                <?php
                echo "<script>$('#grade$i').val('".$res['grade']."');</script>";
                ?>
            </select></td>
        <td><select name="semester" id="semester" onchange="">
                <?php
                if($res['semester']=="1학기") {
                    ?>
                    <option value="1학기" selected>1학기</option>
                    <option value="2학기">2학기</option>
                    <?php
                }else {
                    ?>
                    <option value="1학기">1학기</option>
                    <option value="2학기" selected>2학기</option>
                    <?php
                }
                ?>
            </select></td>
        <td><select name="level" id="level<?=$i?>">
                <option value="루트">루트</option>
                <option value="파이">파이</option>
                <option value="시그마">시그마</option>
                <?php
                echo "<script>$('#level$i').val('".$res['level']."');</script>";
                ?>
            </select></td>
        <script>
            book_info(<?=$i?>);
        </script>
        <td>
            <select name="unit" id="unit">
                <option value="<?=$res['unit']?>"><?=$res['unit']?></option>
            </select>
        </td>
        <td>
            <select name="corner1" id="corner1<?=$i?>">
                <option value="개념마스터">개념마스터</option>
                <option value="개념확인">개념확인</option>
                <option value="서술과 코칭">서술과 코칭</option>
                <option value="이야기수학">이야기수학</option>
                <option value="개념다지기">개념다지기</option>
                <option value="단원마무리">단원마무리</option>
                <option value="도전 문제">도전 문제</option>
                <?php
                echo "<script>$('#corner1$i').val('".$res['corner1']."');</script>";
                ?>
            </select>
        </td>

        <td>
            <select name="Q_number1[]" id="Q_number1" class="custumdropdown" custumdrop="question" multiple="multiple">
                <?php
                $q_1 = explode(",", $res['Q_number1']);
                $cnt = 0;
                for($i=1; $i<=30; $i++) {
                    if($q_1[$cnt] == $i) {
                        echo "<option class='checkbox' value='$i' selected>$i</option>";
                        $cnt++;
                    }
                    else echo "<option class='checkbox' value='$i'>$i</option>";
                }
                ?>
            </select>
        </td>
        <td>
            <select name="corner2" id="corner2<?=$i?>">
                <option value="개념마스터">개념마스터</option>
                <option value="개념확인">개념확인</option>
                <option value="서술과 코칭">서술과 코칭</option>
                <option value="이야기수학">이야기수학</option>
                <option value="개념다지기">개념다지기</option>
                <option value="단원마무리">단원마무리</option>
                <option value="도전 문제">도전 문제</option>
                <?php
                echo "<script>$('#corner2$i').val('".$res['corner2']."');</script>";
                ?>
            </select>
        </td>
        <td>
            <select name="Q_number2[]" id="Q_number2" class="custumdropdown" custumdrop="question" multiple="multiple">
                <?php
                $q_2 = explode(",", $res['Q_number2']);
                $cnt = 0;
                for($i=1; $i<=30; $i++) {
                    if($q_2[$cnt] == $i) {
                        echo "<option class='checkbox' value='$i' selected>$i</option>";
                        $cnt++;
                    }
                    else echo "<option class='checkbox' value='$i'>$i</option>";
                }
                ?>
            </select>
        </td>

        <td>
            <select name="corner3" id="corner3<?=$i?>">
                <option value="개념마스터">개념마스터</option>
                <option value="개념확인">개념확인</option>
                <option value="서술과 코칭">서술과 코칭</option>
                <option value="이야기수학">이야기수학</option>
                <option value="개념다지기">개념다지기</option>
                <option value="단원마무리">단원마무리</option>
                <option value="도전 문제">도전 문제</option>
                <?php
                echo "<script>$('#corner3$i').val('".$res['corner3']."');</script>";
                ?>
            </select>
        </td>
        <td>
            <select name="Q_number3[]" id="Q_number3" class="custumdropdown" custumdrop="question" multiple="multiple">
                <?php
                $q_3 = explode(",", $res['Q_number3']);
                $cnt = 0;
                for($i=1; $i<=30; $i++) {
                    if($q_3[$cnt] == $i) {
                        echo "<option class='checkbox' value='$i' selected>$i</option>";
                        $cnt++;
                    }
                    else echo "<option class='checkbox' value='$i'>$i</option>";
                }
                ?>
            </select>
        </td>

        <td>
            <select name="corner4[]" id="corner4<?=$i?>">
                <option value="개념마스터">개념마스터</option>
                <option value="개념확인">개념확인</option>
                <option value="서술과 코칭">서술과 코칭</option>
                <option value="이야기수학">이야기수학</option>
                <option value="개념다지기">개념다지기</option>
                <option value="단원마무리">단원마무리</option>
                <option value="도전 문제">도전 문제</option>
                <?php
                echo "<script>$('#corner4$i').val('".$res['corner4']."');</script>";
                ?>
            </select>
        </td>
        <td>
            <select name="Q_number4" id="Q_number4" class="custumdropdown" custumdrop="question" multiple="multiple">
                <?php
                $q_4 = explode(",", $res['Q_number4']);
                $cnt = 0;
                for($i=1; $i<=30; $i++) {
                    if($q_4[$cnt] == $i) {
                        echo "<option class='checkbox' value='$i' selected>$i</option>";
                        $cnt++;
                    }
                    else echo "<option class='checkbox' value='$i'>$i</option>";
                }
                ?>
            </select>
        </td>
        <td>
            <span>2018-07-01</span>
        </td>
        <td>
            <span>2018-08-01</span>
        </td>
        <td>
            <?php
            $date = str_replace("/", "-", $res['_from']);
            $date = explode('-', $date);
            $datee = $date[2].'-'.$date[0].'-'.$date[1];
            $today = date("Y-m-d");
            $c_date = date_create($datee);
            $c_today = date_create($today);
            $diff = date_diff($c_today, $c_date);
            $k = $diff->format("%R%a");
            if($k < 0) {
                if($res['checked']==0) {
                    echo '<p class="ing_text" style=" color: blue;">진행중</p>';
                }else echo '<p class="complete_text">완료</p>';
            }else if($k > 0) {
                echo '<div class="resend_btn" style="display: none;"><a href="#none">재전송</a></div>';
            }
            ?>
        </td>
    </tr>
    <?php
    $i++;
}
?>
