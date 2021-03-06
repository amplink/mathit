<?php
include_once ('_common.php');
include_once ('head.php');
?>

<link rel="stylesheet" type="text/css" media="screen" href="css/student_manegement_score_all.css" />

<style>
    .disabledbutton {
        pointer-events: none;
        opacity: 0.4;
    }
</style>
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
    <div class="student_table_section" style="overflow: auto">
        <table>
            <thead>
            <tr>
                <th>학년 / 학급명</th>
                <th>학생명</th>
                <th>숙제명</th>
                <th>제출기간</th>
                <th>제출상태</th>
                <th>채점상태</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $sql = "SELECT 
	           A.*,
			   B._from, B._to, B.name, B.grade, B.semester, B.unit, B.level, B.class_name,
			   B.Q_number1, B.Q_number2, B.Q_number3, B.d_order
			FROM 
	          `homework_assign_list` A 
			INNER JOIN 
			  `homework` B
			ON B.seq = A.h_id
	        WHERE 
			 A.current_status NOT IN ('s2','s3')
			AND A.client_id='$ac'
			AND B.class_name in ('초등 3학년(루트)', '초등 3학년(파이)', '초등 3학년(시그마)', '초등 4학년(루트)', '초등 4학년(파이)', '초등 4학년(시그마)', '초등 5학년(루트)', '초등 5학년(파이)', '초등 5학년(시그마)', '초등 6학년(루트)', '초등 3학년(파이)', '초등 6학년(시그마)', '중등 1학년(루트)', '중등 1학년(파이)', '중등 1학년(시그마)', '중등 2학년(루트)', '중등 2학년(파이)', '중등 2학년(시그마)',  '중등 3학년(루트)',  '중등 3학년(파이)',  '중등 3학년(시그마)')
			ORDER BY  field(B.class_name, '초등 3학년(루트)', '초등 3학년(파이)', '초등 3학년(시그마)', '초등 4학년(루트)', '초등 4학년(파이)', '초등 4학년(시그마)', '초등 5학년(루트)', '초등 5학년(파이)', '초등 5학년(시그마)', '초등 6학년(루트)', '초등 3학년(파이)', '초등 6학년(시그마)', '중등 1학년(루트)', '중등 1학년(파이)', '중등 1학년(시그마)', '중등 2학년(루트)', '중등 2학년(파이)', '중등 2학년(시그마)',  '중등 3학년(루트)',  '중등 3학년(파이)',  '중등 3학년(시그마)') 
			, A.student_name, B._from, B._to
			";

            $result = mysqli_query($connect_db, $sql);
            while($res = mysqli_fetch_array($result)) {
//	    $d_uid = $res['d_uid'];
//	    $c_uid = $res['c_uid'];
//	    $s_uid = $res['s_uid'];
//	    $ssql = "select * from `homework` where `d_uid`='$d_uid' and `c_uid`='$c_uid' and `s_uid`='$s_uid';";
//	    $rresult = sql_query($ssql);
//	    $rr = mysqli_fetch_array($rresult);
                ?>
                <tr>
                    <td><span><?=$res['class_name']?>(<?=$res['d_order']?>)</span></td>
                    <td><span><?=$res['student_name']?></span></td>
                    <td><span><?=$res['name']?></span><br><?=$res['grade']."-".$res['semester']."-".$res['unit']?></td>
                    <td><span><?=substr($res['_from'],6,4)?>-<?=substr($res['_from'],0,2)?>-<?=substr($res['_from'],3,2)?> ~ <?=substr($res['_to'],6,4)?>-<?=substr($res['_to'],0,2)?>-<?=substr($res['_to'],3,2)?></span></td>
                    <td>
                        <?
                        $chk1 = ($res['apply_status_1'] == 'Y')?"on":"";
                        $chk2 = ($res['apply_status_2'] == 'Y')?"on":"";
                        ?>
                        <!-- 나중에 처리 -->
                        <div class="chk_box <?=$chk1?>"></div>
                        <div class="chk_box <?=$chk2?>"></div>
                    </td>
                    <td>
                        <?php
                        $addStyle = ($res['current_status'] == 'a1' or $res['current_status'] == 'a2') ? "" : "disabledbutton";
                        ?>
                        <div class="scoring_btn <?=$addStyle?>"><a href="scoring.php?id=<?= $res['id'] ?>">채점하기 </a></div>

                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</section>
</body>

</html>