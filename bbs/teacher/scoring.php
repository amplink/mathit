<?php
include_once ('_common.php');
include_once ('head.php');
?>

<link rel="stylesheet" type="text/css" media="screen" href="css/scoring.css?v=20190403" />
<link rel="stylesheet" type="text/css" media="screen" href="css/swiper.min.css" />
<script src="js/swiper.min.js"></script>
<style>
    html, body {
        position: relative;
        height: 100%;
    }
    body {
        margin: 0;
        padding: 0;
    }
    .swiper-container {
        width: 100%;
        height: 100%;
    }
    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }
    label{vertical-align:-1px}
    .input_chk{width:13px;height:13px;vertical-align:text-top}

</style>

<section>

    <?

    $corner = 1;

    $sql = "SELECT 
	           id, class_name, student_name, h_id, current_status, 
			   wrong_anwer_1, wrong_anwer_2, apply_count,
			   student_id,  d_uid, c_uid 
			FROM
	          `homework_assign_list`  
	        WHERE 
			  id='$_GET[id]' AND client_id='$ac'";

    $result = mysqli_query($connect_db, $sql);
    $res = mysqli_fetch_array($result);

    $wrong_anwer = $res['wrong_anwer_'.$res['apply_count']];

    $sql = "SELECT 
	           textbook, grade, semester, level, unit, corner1,
			   Q_number1, corner2, Q_number2, corner3, Q_number3, corner4, Q_number4
			FROM 
	          `homework`  
	        WHERE 
			  seq='$res[h_id]' AND client_id='$ac'";

    $result2 = mysqli_query($connect_db, $sql);
    $res2 = mysqli_fetch_array($result2);

    for($i=1; $i<5; $i++){
        if($res2['Q_number'.$i]) {
            $corner_arr[$i] =  $res2['corner'.$i];
            $Q_number_arr[$i] =  $res2['Q_number'.$i];
        }
    }

    $tot = count($corner_arr);

    ?>

    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">
                    <span><?=$res['class_name']?></span>
                </p>
                <!--<p>
                    <span>(</span>
                    <span>월수금</span>
                    <span> 반</span>
                    <span>)</span>
                </p>-->
                <p>
                    <span> - </span>
                    <span><?=$res['student_name']?></span>
                    <span> 학생</span>
                </p>
            </div>
            <div class="head_right">
                <?
                if($res['current_status'] == 'a1' or $res['current_status'] == 'a2'){
                    ?>
                    <div class="resend_btn"><a>재전송 요청</a></div>
                    <div class="complete_btn"><a href="javascript:complete()">완료</a></div>
                    <?
                }
                ?>
                <div class="cancel_btn"><a href="javascript:history.back()">취소</a></div>
            </div>
        </div>
    </div>


    <form action="./scoring_act.php" name="scoreForm" id="scoreForm" method="post">
        <input type="hidden" name="current_status" value="<?=$res['current_status']?>">
        <input type="hidden" name="id" value="<?=$res['id']?>">
        <input type="hidden" name="c_uid" value="<?=$res['c_uid']?>">
        <input type="hidden" name="d_uid" value="<?=$res['d_uid']?>">
        <input type="hidden" name="s_id" value="<?=$res['student_id']?>">
        <input type="hidden" name="h_id" value="<?=$res['h_id']?>">
        <input type="hidden" name="tempSave" id="tempSave">
        <input type="hidden" name="cornerType" id="cornerType" value="1">
        <input type="hidden" name="cornerTot" id="cornerTot" value="<?=$tot?>">
        <div class="scoring_box" style="padding-bottom: 20px;">


            <div class="l_section">
                <div class="title_section">
                    <p><span><?=$res2['unit']?></span></p>
                    <p><span>0<?=$corner?>.</span><span><?=$res2['corner'.$corner]?></span></p>
                    <input type="hidden" name="corner_name" value="<?=$res2['corner'.$corner]?>">
                </div>
                <p>
                <div style="width:500px;height:1px">
                    <div style="text-align:left">
                        <?
                        for($i=1; $i<=$tot; $i++){
                            if($i == $corner) $chk = "checked";
                            else              $chk = "";
                            echo "&nbsp;&nbsp;&nbsp;<input type='radio' class='input_chk' name='corner' value='".$i."' ".$chk." onclick='cornerView(".$i.")'><span style='font-size:16px;'><label for=''>".$res2['corner'.$i]."</label></span>";
                        }

                        ?>
                    </div>
                </div>
                <div style="height:25px"></div>
                <!--<span style="float:right">
                   <a href="javascript:saveStep()">임시저장</a>
                </span>-->
                </p>
                <div class="score_board_table">
                    <table>
                        <thead>
                        <tr>
                            <th style="width: 70px;">문항</th>
                            <th style="width: 390px;">정답</th>
                            <th><input type="checkbox" id="allCheck"></th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="score_board_table" style="height:597px;overflow:auto;margin-top:-1px">



                    <?
                    $sql = "SELECT 
				   item_number, answer_image, c_name, new
				FROM 
				  `answer_master`  
				WHERE 
				   book_type='".$res2[textbook]."' 
				   AND grade='".$grade_arr[$res2[grade]]."'
				   AND semester='".$semester_arr[$res2[semester]]."'
				   AND unit = '".$res2[unit]."'
				   AND level = '".$res2[level]."'
				   -- AND c_name = '".$corner_arr[$corner]."'
				ORDER BY c_name, seq ASC";

                    $wrongData =  json_decode($wrong_anwer,true);
                    //print_r($wrongData);
                    $result3 = mysqli_query($connect_db, $sql);
                    $group = array();
                    foreach ( $result3 as $value ) {
                        $group[$value['c_name']][] = $value;
                    }

                    $tot = count($group);

                    for($i=1; $i<=$tot; $i++){

                        $chkAnswers = explode(",",$Q_number_arr[$i]);
                        if($i == 1) $style = "show";
                        else        $style = "none";
                        echo "<div id='corner_$i' style='display:$style'>				  
			       <table>
					<tbody>";
                        for($j=0; $j<=count($group[$res2['corner'.$i]]); $j++){
                            
							if($group[$res2['corner'.$i]][$j]['new'] == 1){
							   $img_url = "data:image/jpeg;base64,".base64_encode($group[$res2['corner'.$i]][$j]['answer_image']);
							}else{
                               $img_url = $group[$res2['corner'.$i]][$j]['answer_image'];
							}

                            if(!$group[$res2['corner'.$i]][$j]['item_number']) continue;
                            if(!in_array($group[$res2['corner'.$i]][$j]['item_number'], $chkAnswers)) continue;

                            $wrongArr = explode(",",$wrongData[$i]);
                            ?>

                            <tr class="group_<?=$i?>">
                                <td width="70"><span><?=$group[$res2['corner'.$i]][$j]['item_number']?></span></td>
                                <td width="390">
                                    <div class="img_input_place"><img src="<?=$img_url?>"></div>
                                </td>
                                <td><input type="checkbox" name="marking<?=$i?>[]" value="<?=$add?><?=$group[$res2['corner'.$i]][$j]['item_number']?>" id="marking" class="marking<?=$i?>" <? if(in_array($group[$res2['corner'.$i]][$j]['item_number'], $wrongArr)) echo "checked"; ?>></td>
                            </tr>
                            <?

                        }
                        echo "</tbody></table></div>";
                    }
                    ?>

                </div>
            </div>
            <div class="r_section" style="padding-top:20px">
                <div class="paper_input swiper-container">
                    <ul class="swiper-wrapper">

                        <?php
                        $sql = "SELECT * FROM 
					    `upload_photo` 
					   WHERE 
					    id = '$_GET[id]' 
					   ORDER BY sort asc";
                        $result4 = mysqli_query($connect_db, $sql);
                        $i = 0;
                        while ($res4 = mysqli_fetch_array($result4)) {
                            ++$i;
                            ?>

                            <li class="swiper-slide">
                                <div class="paper_img_input" style="overflow:auto;"><img src="http://student.mathitlms.co.kr/data/photo/<?=$res4['reg_month']?>/<?=$res4['id']?>/<?=$res4['file_name']?>" style="height:750px"></div>
                            </li>
                            <?
                        }
                        ?>
                    </ul>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </form>
</section>
<script>
    var swiper = new Swiper('.swiper-container', {
        pagination: {
            el: '.swiper-pagination',
            type: 'fraction',
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    $(function(){
        $("#allCheck").click(function(){
            var no = $("#cornerType").val();
            if($("#allCheck").prop("checked")) {
                $(".marking"+no).prop("checked",true);
            } else {
                $(".marking"+no).prop("checked",false);
            }
        });
    });

    function chCorner(obj){
        location.href = "./scoring.php?h_id=<?=$_GET['h_id']?>&id=<?=$_GET['id']?>&corner="+obj;
    }

    function complete(){
        var chk = 0;
		if(doubleSubmitCheck()) return;
        $('[class ^= marking]').each(function() {
            if($(this).is(':checked')){
                //DATA += ","+($(this).val());
                chk++;
            }
        });

        if(chk == 0){
            if(confirm('채점결과 만점 입니다. \n완료 할까요?')){
                $("#scoreForm").submit();
            }else{
                return false;
            }
        }

        $("#scoreForm").submit();
    }

    function saveStep(){
        var chk = 0;
        $("#tempSave").val("1");
        $('.marking').each(function() {
            if($(this).is(':checked')){
                chk++;
            }
        });

        if(chk == 0){
            alert("오답 체크가 안되었습니다.");
            return false;
        }

        $("#scoreForm").submit();
    }

    function cornerView(no){
        var chk = 0;
        $("[id ^= 'corner_']").hide();
        $("#corner_"+no).show();
        $("#cornerType").val(no);
        var n = 0;
        $(".marking"+no).each(function() {
            if($(".marking"+no).eq(n).is(':checked')){
                chk++;
            }
            n++;
        });

        if(chk != $(".marking"+no).length) $("#allCheck").prop("checked",false);
        else                               $("#allCheck").prop("checked",true);

    }


    $('.img_input_place img').each(function() {
        var maxWidth = 350;
        var maxHeight = 350;
        var ratio = 0;
        var width = $(this).width();
        var height = $(this).height();
        if(width > maxWidth){
            ratio = maxWidth / width;
            $(this).css("width", maxWidth);
            $(this).css("height", height * ratio);
            height = height * ratio;
        }
        var width = $(this).width();
        var height = $(this).height();

        if(height > maxHeight){
            ratio = maxHeight / height;
            $(this).css("height", maxHeight);
            $(this).css("width", width * ratio);
            width = width * ratio;
        }
    });


    /*
        $('.paper_img_input img').each(function() {
            var maxWidth = 700;
            var maxHeight = 750;
            var ratio = 0;
            var width = $(this).width();
            var height = $(this).height();
            if(width > maxWidth){
                ratio = maxWidth / width;
                $(this).css("width", maxWidth);
                $(this).css("height", height * ratio);
                height = height * ratio;
            }
            var width = $(this).width();
            var height = $(this).height();

            if(height > maxHeight){
                ratio = maxHeight / height;
                $(this).css("height", maxHeight);
                $(this).css("width", width * ratio);
                width = width * ratio;
            }
        });
    */
    $('.resend_btn').click(function (){
        var s_id = $('input[name="s_id"]').val();
		if(doubleSubmitCheck()) return;
        $.ajax({
            url: 'scoring_resend.php?s_id='+s_id+"&id=<?=$_GET['id']?>",
            success: function (res) {
                alert('재전송 요청 하였습니다.');
                location.href="./scoring_list.php?s_id=<?=$res['student_id']?>&d_uid=<?=$res['d_uid']?>&c_uid=<?=$res['c_uid']?>";

            }
        });
    });


    var doubleSubmitFlag = false;
    function doubleSubmitCheck(){
        if(doubleSubmitFlag){
            return doubleSubmitFlag;
        }else{
            doubleSubmitFlag = true;
            return false;
        }
    }
</script>


</body>

</html>