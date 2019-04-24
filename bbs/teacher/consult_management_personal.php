<?php
include_once ('_common.php');
include_once ('head.php');
$student_name = $_GET['s_name'];
$s_id = $_GET['s_id'];
$s_name = $_GET['s_name'];
$d_uid = $_GET['d_uid'];
$c_uid = $_GET['c_uid'];

if($_GET['month'] == 'all'){
   $start = "";
   $end = "";
}
?>

    <link rel="stylesheet" type="text/css" media="screen" href="css/consult_manegement_personal.css" />
    <script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
    <script>
        $( function() {
            var dateFormat = "mm/dd/yy",
                from = $( "#from" )
                    .datepicker({
                        showOn: "button",
                        buttonImage: "img/calendar.png",
                        buttonImageOnly: true,
                        buttonText: "Select date",
                        nextText: "다음달",
                        prevText: "이전달",
                        changeMonth: true,
                        dayNames: ['월요일', '화요일', '수요일', '목요일', '금요일', '토요일', '일요일'],
                        dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'],
                        monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
                        monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
                        numberOfMonths: 2
                    })
                    .on( "change", function() {
                        to.datepicker( "option", "minDate", getDate( this ) );
                    }),
                to = $( "#to" ).datepicker({
                    showOn: "button",
                    buttonImage: "img/calendar.png",
                    buttonImageOnly: true,
                    buttonText: "Select date",
                    nextText: "다음달",
                    prevText: "이전달",
                    changeMonth: true,
                    dayNames: ['월요일', '화요일', '수요일', '목요일', '금요일', '토요일', '일요일'],
                    dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'],
                    monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
                    monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
                    numberOfMonths: 2
                })
                    .on( "change", function() {
                        from.datepicker( "option", "maxDate", getDate( this ) );
                    });

            function getDate( element ) {
                var date;
                try {
                    date = $.datepicker.parseDate( dateFormat, element.value );
                } catch( error ) {
                    date = null;
                }

                return date;
            }
        } );
    </script>

<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p>&nbsp;&nbsp;상담내역</p>
            </div>
            <div class="head_right">
                <div class="consult_mane_btn"><a href="consult_management_write.php?s_id=<?=$s_id?>&d_uid=<?=$_GET['d_uid']?>&c_uid=<?=$_GET['c_uid']?>">상담관리</a></div>
            </div>
        </div>
    </div>
    <div class="student_consult_box">
        <div class="head_line">
		
		  <form action="<?=$_SERVER['PHP_SELF']?>" method="get" id="form_search">
		    <input type="hidden" name="s_id" id="s_id" value="<?=$_GET['s_id']?>">
			<input type="hidden" name="s_name" id="s_name" value="<?=$_GET['s_name']?>">
			<input type="hidden" name="d_uid" id="d_uid" value="<?=$_GET['d_uid']?>">
			<input type="hidden" name="c_uid" id="c_uid" value="<?=$_GET['c_uid']?>">
			<input type="hidden" name="month" id="month" value="<?=$_GET['month']?>">

            <div class="day_input">
                <div class="date_range">
                    <input type="text" id="from" name="start" value="<?=$start?>">
                </div>
                <span> ~ </span>
                <div class="date_range">
                    <input type="text" id="to" name="end" value="<?=$end?>">
                </div>
            </div>
            <div class="search_btn"><a href="javascript:consult_search();">검색</a></div>
            <div class="month_btn_wrap">
                <div class="month_btn"><a href="javascript:month_ago('1');">1개월</a></div>
                <div class="month_btn"><a href="javascript:month_ago('2');">2개월</a></div>
                <div class="month_btn"><a href="javascript:month_ago('3');">3개월</a></div>
                <div class="month_btn"><a href="javascript:month_ago('all');">전체</a></div>
            </div>
          </form>
        </div>
        <div class="consult_table">
            <table>
                <thead>
                <tr>
                    <th>선택</th>
                    <th>학생명</th>
                    <th>상담일</th>
                    <th>상담자</th>
                    <th>대상</th>
                    <th>상담유형</th>
                    <th>상담주제</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "select * from `teacher_consult` where `t_name` = '".$_SESSION['t_name']."'";

				if(is_numeric($_GET['month'])){
                    $sql .= " and (date >= date_format(date_add(now(), interval -".$_GET['month']." month), '%m/%d/%Y')
					               and date <= date_format(now(), '%m/%d/%Y'))";
				}
				else if($start && $end){
                    $sql .= " and (date BETWEEN '".$start."' and '".$end."') ";
				}

                $result = mysqli_query($connect_db, $sql);
                while($res = mysqli_fetch_array($result)) {
                    ?>
                    <tr onclick="call_consult(<?=$res['seq']?>);">
                        <td><span><input type="radio" name="t" id="<?=$res['seq']?>"></span></td>
                        <td><span><?=$res['s_name']?></span></td>
                        <td><span><?=$res['date']?></span></td>
                        <td><span><?=$res['t_name']?></span></td>
                        <td><span><?=$res['object']?></span></td>
                        <td><span><?=$res['consult_genre']?></span></td>
                        <td><span><?=$res['consult_topic']?></span></td>
                    </tr>
                    <?
                }
                ?>
                </tbody>
            </table>
        </div>
        <form action="consult_management_personal_chk.php?s_id=<?=$s_id?>&s_name=<?=$s_name?>&d_uid=<?=$d_uid?>&c_uid=<?=$c_uid?>" method="post" id="consult_form">
        <div id="content_c"></div>
        <div class="textarea_input_section">
            <p>상담내용</p><br>
            <div id="textarea"></div>
        </div>
        </form>
    </div>
</section>
</body>
</html>
<script>
    function call_consult(seq) {
        $("#"+seq).prop("checked", true);
        $.ajax({
            type: "GET",
            url: "call_consult.php?seq="+seq,
            dataType: "html",
            success: function(response){
                $("#textarea").html(response);
            },
            error: function (e) {
                alert("불러오기 실패");
            }
        });
    }

    function submit_val() {
        $("#consult_form").submit();
    }

    function del_val() {
        $("#consult_form").attr('action', "consult_management_personal_del.php?s_id=<?php echo $s_id;?>&s_name=<?php echo $s_name;?>&d_uid=<?php echo $d_uid;?>&c_uid=<?php echo $c_uid;?>");
        $("#consult_form").submit();
    }

	function consult_search(){
		$("#month").val("");
		$("#form_search").submit();
	}

	function month_ago(m){
        $("#month").val(m);
		$("#form_search").submit();
	}
</script>