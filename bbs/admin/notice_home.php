<?php
include_once('_common.php');

define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}
//190130김영모 페이지 번호 입력
$now_menu_number = 20;

//include_once(G5_THEME_PATH.'/head.php');\
include_once('head.php');
$num = 1;
if(!$_GET['page']) {
    $page = 0;
}else {
    $page = $_GET['page']-1;
}
?>

<script src="js/jquery-3.3.1.min.js"></script>
<div class="section">
    <div class="head_section">
        <div class="l_title">
            <p>공지사항</p>
        </div>
        <div class="search_box_wrap">
            <div class="search_input_box"><input type="text" id="search_val"></div>
            <div class="search_btn" onclick="search();"><a href="#none">검색</a></div>
        </div>
    </div>
    <div class="view_section">
        <table>
            <thead>
            <tr style="text-align:center">
                <th style="width: 3%;"><input type="checkbox" id="all_select"></th>
                <th style="width: 5%">번호</th>
                <th style="width: 10%;">유형</th>
                <th style="">제목</th>
                <th style="width: 13%;">작성일</th>
                <th style="width: 15%;">학원명</th>
                <th style="width: 11%;">공지범위</th>
                <th style="width: 4%;">&nbsp</th>
            </tr>
            </thead>
            <tbody>
            <form action="notice_home_del.php" method="POST" id="notice_form">
                <?php
                $sql = "select * from `academy`";
                //190131 손민석 검색기능 추가 {
                if($_GET["sch_kwd"]){
                    $sql = $sql."WHERE ";
                    $sql = $sql." 'title' LIKE AND '%".$_GET["sch_kwd"]."%' ";
                    $sql = $sql." 'contents' LIKE AND '%".$_GET["sch_kwd"]."%' ";
                    $sql = $sql." 'title' LIKE AND '%".$_GET["sch_kwd"]."%' ";
                }
                // }
                $result = mysqli_query($connect_db, $sql);
                $client_arr = array();
                while($res = mysqli_fetch_array($result)) {
                    $client_arr[$res['client_id']] = $res['client_name'];
                }

                $sql = "select * from `notify` ORDER BY `event_time` DESC, `type` DESC";
                $result = mysqli_query($connect_db, $sql);
                $i=1;
                $count = 0;

                while($res = mysqli_fetch_array($result)) {
                    $size = 1;
                    $target = "";
//                        if($res['type']==0) $type = "전체공지";
//                        else if($res['type']==1) $type = "일반공지";
//                        else if($res['type']==2) $type = "중요공지";
                    $client_id = $res['client_id'];
                    $sql = "select * from `academy` where `client_id`='$client_id';";
                    $rr = sql_query($sql);
                    $rrr = mysqli_fetch_array($rr);

                    if($res['target'] == "전임강사,채점강사,학생") $res['target'] = "전체";
                    if($res['attach_file']) $res['title'] = $res['title']. "<img src='img/disc.png' width='18' height='18'>";
                    if($i >= $page*10 && $i <= ($page*10+10)) echo "<tr><td><input type='checkbox' name='notice_chk[]' value='".$res['id']."'></td><td>".$i."</a></td><td>".$res['type']."</td><td>".$res['title']."</td><td>".$res['event_time']."</td><td>".$rrr['client_name']."</td><td>".$res['target']."</td><td><a style='' href='./update_notice_add.php?id=".$res['id']."'>수정</a></td></tr>";
                    $i++;
                }
                ?>
            </form>
            </tbody>
        </table>
    </div>
    <div class="section_footer">
        <div class="list_btn_wrap">
            <div class="prev_btn"><a href="./notice_home.php?page=<?=$page;?>"><img src="img/prev.png" alt=""></a></div>
            <ul>
                <?
                $count = $i;
                for($i=0; $i<$count/10; $i++) {
                    $cnt = $i+1;
                    echo '<li><a href="./notice_home.php?page='.$cnt.'">'.$cnt.'</a></li>';
                }
                ?>
            </ul>
            <div class="next_btn"><a href="./notice_home.php?page=<?=$page+1;?>"><img src="img/next.png" alt=""></a></div>
        </div>
        <div class="button_wrap">
            <div class="add_btn"><a class="btn" href="notice_add.php">공지등록</a></div>
            <div class="delete_btn" onclick="del_notice();"><a href="#none">삭제</a></div>
        </div>
    </div>
</div>
<?php
include_once('tail.php');
?>
<script>
    $("#all_select").on('click', function () {
        if($('#all_select').prop('checked')) $('input[type=checkbox]').prop('checked', true);
        else $('input[type=checkbox]').prop('checked', false);
    });

    function del_notice() {
        if(confirm("삭제하시겠습니까?")) $('#notice_form').submit();
    }

    function search() {
        location.href = './search_notice_home.php?search='+$('#search_val').val();
    }
</script>
