<?php
include_once ('_common.php');
include_once ('head.php');

$link = "/api/math/student?client_no=".$_SESSION['client_no']."&id=".$_GET['s_id'];
$r = api_calls_get($link);
$student_name = $r[3];

$link = "/api/math/class?client_no=".$_SESSION['client_no'];
$r = api_calls_get($link);
for($i=0; $i<count($r); $i++) {
    if($r[$i][0] == $_GET['d_uid'] && $r[$i][1] == $_GET['c_uid'] && $r[$i][1] == $_GET['s_uid']) {
        $class = $r[$i][4];
    }
}
$sql = "select * from `teacher_score` 
         where 
		`d_uid` = '$_GET[d_uid]' 
		and `d_uid` = '$_GET[d_uid]' 
		and `c_uid` = '$_GET[c_uid]'
		and `s_uid` = '$_GET[s_uid]'
		and `student_id` = '$_GET[s_id]'
		order by `date`;
		";
$result = mysqli_query($connect_db, $sql);
?>

<link rel="stylesheet" type="text/css"  href="css/student_manegement_personal_record.css" />


<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">
                    <span><?=$class?></span>
                </p>
                <p> 성적표 </p>
                <p>
                    <span> - <?=$student_name?></span>
                </p>
            </div>
            <div class="head_right">
            </div>
        </div>
    </div>
    <div class="student_table_section">
        <table>
            <thead>
            <tr>
                <th>순번</th>
                <th>시험명</th>
                <th>응시일</th>
                <th>성적표</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $cnt = 1;
            while($res = mysqli_fetch_array($result)) {
                if($res['test_genre'] == '분기테스트' or $res['test_genre'] == '입반테스트')  $type= "quarter";
                else                                                                          $type= "mid";
                ?>
                <tr>
                    <td><?=$cnt?></td>
                    <td><span><?=$res['year']?>/<?=$res['quarter']?>분기 <?=$res['test_genre']?></span></td>
                    <td><span><?=substr($res['date'],-4)?>-<?=substr($res['date'],0,2)?>-<?=substr($res['date'],3,2)?></span></td>
                    <td>
                        <div class="paper">
                            <!--<a href="student_management_personal_mid_record_detail.php?d_uid=<?=$_GET['d_uid']?>&c_uid=<?=$_GET['c_uid']?>&s_uid=<?=$_GET['s_uid']?>&s_name=<?=$student_name?>&title=<?=$res['title']?>&s_id=<?=$res['student_id']?>">-->
                            <a href="student_management_personal_<?=$type?>_record_detail.php?no=<?=$res['seq']?>&s_id=<?=$_GET['s_id']?>&d_uid=<?=$_GET['d_uid']?>&c_uid=<?=$_GET['c_uid']?>&s_uid=<?=$_GET['s_uid']?>">
                                <img src="img/paper.png" alt="paper_icon">
                            </a>
                        </div>
                        <div class="print"><a href="javascript:print_send('<?=$type?>','<?=$res[seq]?>')"><img src="img/printer.png" alt="printer_icon"></a></div>
                        <div class="mail"><a href="javascript:sms_send('<?=$type?>','<?=$res[seq]?>')"><img src="img/mail.png" alt="mail_icon"></a></div>
                    </td>
                </tr>
                <?
                $cnt++;
            }
            ?>
            </tbody>
        </table>
    </div>
</section>
<script>


    function print_send(gubun, no) {
        var url = "student_management_personal_"+gubun+"_record_detail.php?no="+no+"&flag=1";
        window.open(url,"PopupWin", "top=-200,width=1300,height=900");
    }


    function sms_send(gubun, no) {
        var url = "student_management_personal_"+gubun+"_record_detail_print.php?no="+no+"&flag=2";
        window.open(url,"PopupWin", "top=-200,width=1500,height=800");
    }
</script>
</body>

</html>