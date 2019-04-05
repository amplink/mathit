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
    <link rel="stylesheet" type="text/css" media="screen" href="css/scoring.css?v=20190403" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/swiper.min.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
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
    </style>
</head>

<body>
<section>

<?

    $corner = ($_GET['corner'])?$_GET['corner']:"1";

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

    $grade_arr = array("초3"=>"3", "초4"=>"4", "초5"=>"5", "초6"=>"6",  "중1"=>"7", "중2"=>"8", "중3"=>"9");
    $semester_arr = array("1학기"=>"1", "2학기"=>"2");
	$sql = "SELECT 
	           textbook, grade, semester, level, unit, corner1,
			   Q_number1, corner2, Q_number2,corner3, Q_number3
			FROM 
	          `homework`  
	        WHERE 
			  seq='$res[h_id]' AND client_id='$ac'";

	$result2 = mysqli_query($connect_db, $sql);
	$res2 = mysqli_fetch_array($result2);

	for($i=1,$tot=0; $i<5; $i++){
        if($res2['Q_number'.$i]) {
			$corner_arr[$i] =  $res2['corner'.$i];
			$Q_number_arr[$i] =  $res2['Q_number'.$i];
		}
	}

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
                <div class="resend_btn"><a href="#none">재전송 요청</a></div>
                <div class="complete_btn"><a href="javascript:complete()">완료</a></div>
                <div class="cancel_btn"><a href="#none">취소</a></div>
            </div>
        </div>
    </div>


	<form action="./scoring_act.php" name="scoreForm" id="scoreForm" method="post">
	    <input type="hidden" name="current_status" value="<?=$res['current_status']?>">
		<input type="hidden" name="id" value="<?=$res['id']?>">
		<input type="hidden" name="c_uid" value="<?=$res['c_uid']?>">
		<input type="hidden" name="d_uid" value="<?=$res['d_uid']?>">
		<input type="hidden" name="s_id" value="<?=$res['student_id']?>">
		<input type="hidden" name="tempSave" id="tempSave">
		<div class="scoring_box">


			<div class="l_section">
				<div class="title_section">
					<p><span><?=$res2['unit']?></span></p>
					<p><span>0<?=$corner?>.</span><span><?=$res2['corner'.$corner]?></span></p>
					<input type="hidden" name="corner_name" value="<?=$res2['corner'.$corner]?>">
				</div>
				<p>
				<span>
				 <select name="corner" onChange="chCorner(this.value)">
	<?
	$tot = count($corner_arr);
		for($i=1; $i<=$tot; $i++){
			if($i == $corner) $select = "selected";
			else                      $select = "";
			echo "<option value='".$i."' ".$select.">".$res2['corner'.$i]."</option>";
		}
	?>
				 
				 </select>
				</span>
				<span style="float:right">
                   <!--<span class="complete_btn"><a href="javascript:saveStep()">완료</a></span>-->
                   <a href="javascript:saveStep()">임시저장</a>
				</span>
				</p>
				<div class="score_board_table">
				<table>
					<thead>
					<tr>
						<th style="text-align:left;padding-left:40px">문항&nbsp;&nbsp;</th>
						<th style="text-align:center;padding-right:40px">정답</th>
						<th style="text-align:right;padding-right:35px"><input type="checkbox" id="allCheck"></th>
					</tr>
					</thead>
				</table>
				</div>
				<div class="score_board_table" style="height:500px;overflow:auto;margin-top:-1px">
				  <table>
					<tbody>


	<?
		$sql = "SELECT 
				   item_number, answer_image
				FROM 
				  `answer_master`  
				WHERE 
				   book_type='".$res2[textbook]."' 
				   AND grade='".$grade_arr[$res2[grade]]."'
				   AND semester='".$semester_arr[$res2[semester]]."'
				   AND unit = '".$res2[unit]."'
				   AND level = '".$res2[level]."'
				   AND c_name = '".$corner_arr[$corner]."'
				ORDER BY item_number ASC";

        $wrongData =  json_decode($wrong_anwer,true);
		$result3 = mysqli_query($connect_db, $sql);

		$wrongArr = explode(",",$wrongData[$corner]);

		while($res3 = mysqli_fetch_array($result3)) {

	?>
						<tr>
							<td><span><?=$res3['item_number']?></span></td>
							<td>
								<div class="img_input_place"><img src="<?=$res3['answer_image']?>" height="30"></div>
							</td>
							<td><input type="checkbox" name="marking[]" value="<?=$res3['item_number']?>" id="marking" class="marking" <? if(in_array($res3['item_number'], $wrongArr)) echo "checked"; ?>></td>
						</tr>

	<?
		}
	?>
						</tbody>
					  </table>
				</div>
			</div>
			<div class="r_section">
				<div class="paper_input swiper-container">
					<ul class="swiper-wrapper">
						<li class="swiper-slide">
							<div class="paper_img_input" style="overflow:auto;"><img src="http://localhost/student_mobile/data/img/1.png"></div>
						</li>
						<li class="swiper-slide">
							<div class="paper_img_input" style="overflow:auto;"><img src="http://localhost/student_mobile/data/img/3.jpg"></div>
						</li>
						<li class="swiper-slide">
							<div class="paper_img_input"></div>
						</li>
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
			if($("#allCheck").prop("checked")) { 
				$("input[type=checkbox]").prop("checked",true); 
			} else { 
				$("input[type=checkbox]").prop("checked",false); 
			} 
		});
	});

	function chCorner(obj){
		/*var chk = 0;
		$('.marking').each(function() {
			 if($(this).is(':checked')){
			    chk++;
			 }
		});

		if(chk == 0){
           location.href = "./scoring.php?h_id=<?=$_GET['h_id']?>&id=<?=$_GET['id']?>&corner="+obj;
		}else{
	  	  $("#tempSave").val("1");
          $("#scoreForm").submit();
		}*/
		location.href = "./scoring.php?h_id=<?=$_GET['h_id']?>&id=<?=$_GET['id']?>&corner="+obj;
	}

	function complete(){
		var chk = 0;
		$('.marking').each(function() {
			 if($(this).is(':checked')){
				//DATA += ","+($(this).val());
			    chk++;
			 }
		});

		if(chk == 0){
           if(!confirm('채점결과 만점 입니다. \n완료 할까요?')) return false;
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

</script>


</body>

</html>