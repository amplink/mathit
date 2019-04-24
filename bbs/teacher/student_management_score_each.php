<?php
include_once ('_common.php');
include_once ('head.php');

$link = "/api/math/class_stu?client_no=".$_SESSION['client_no']."&d_uid=".$_GET['d_uid']."&c_uid=".$_GET['c_uid'];
$r = api_calls_get($link);

for($i=0; $i<count($d_name); $i++) {
    if($d_uid[$i] == $_GET['d_uid'] && $c_uid[$i] == $_GET['c_uid']) {
        $class_name = $d_name[$i];
        $class_type = $d_yoie[$i];
    }
}

?>

    <link rel="stylesheet" type="text/css" media="screen" href="css/student_manegement_score_each.css" />

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
					<p class="left_text">미 채점 목록 - <span><?=$class_name?>(<?=$class_type?>)</span></p>
				</div>
                <div class="head_right">
                </div>
            </div>
        </div>
        <div class="student_table_section">
            <table>
                <thead>
                    <tr>
                        <th>학생명</th>
                        <th>숙제명</th>
                        <th>제출기한</th>
                        <th>제출상태</th>
                        <th>채점상태</th>
                    </tr>
                </thead>

                <tbody>


				<?php


                $sql = "SELECT 
	                         A.*,
			                 B._from, B._to, B.name, B.grade, B.semester, B.unit, B.level,
			                 B._from, B._to
			            FROM 
	                      `homework_assign_list` A 
			            INNER JOIN 
			              `homework` B
			            ON B.seq = A.h_id
	                   WHERE 
	                          B.d_uid = $_GET[d_uid]
	                      AND B.c_uid = $_GET[c_uid]
	                      AND B.s_uid = $_GET[s_uid]
                          AND   (A.score_status_1='N' OR A.score_status_2='N')
                          AND (A.current_status != 's2' AND A.current_status != 's3')	                      
			              AND A.client_id='$ac'
			              AND B.level in ('루트', '파이', '시그마')
			           ORDER BY
			              A.student_name, B._from";

                $result = mysqli_query($connect_db, $sql);
                while ($res = mysqli_fetch_array($result)) {


                    ?>
					<tr>
						<td><span><?=$res['student_name']?></span></td>
                        <td><span><?=$res['name']?></span><br><?=$res['grade']."-".$res['semester']."-".$res['unit']?></td>
						<td><span><?=substr($res['_from'],-4)?>-<?=substr($res['_from'],0,2)?>-<?=substr($res['_from'],3,2)?></span>
							<span> ~ </span>
							<span><?=substr($res['_to'],-4)?>-<?=substr($res['_to'],0,2)?>-<?=substr($res['_to'],3,2)?></span></td>
						<td>
                         <?
                            $chk1 = ($res['apply_status_1'] == 'Y')?"on":"";
                            $chk2 = ($res['apply_status_2'] == 'Y')?"on":"";
                         ?>
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
					<?
				}
				?>

	               </tbody>
            </table>
        </div>
    </section>

</body>

</html>