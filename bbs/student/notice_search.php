<?php
include_once ('_common.php');

$ac = $_SESSION['client_id'];
$search = "%".$_GET['search']."%";
$page = $_GET['page'];
$student = "%학생%";
$start = ($page-1)*10;

$sub_uid = explode(', ', $_SESSION['d_uid']);
for($i=0; $i<count($sub_uid); $i++) {
    if(count($sub_uid)-1 == $i) $d_uid .= $sub_uid[$i];
    else $d_uid .= $sub_uid[$i]."|";
}
//alert_msg($d_uid);
$sql = "select * from `teacher_notice` where (`title` like '$search' and `client_id`='$ac' and `n_range` like '$student' and `d_uid` RLIKE '$d_uid') or (`target` like '$search' and `client_id`='$ac' and `n_range` like '$student') order by `type` desc, `event_time` desc ";
$sql = $sql."limit ".$start.",10";
//echo $sql;
$result = sql_query($sql);
$i=0;
while($res = mysqli_fetch_array($result)) {
    $time = explode(' ', $res['event_time']);
    $time = $time[0];
    if(strpos($res['title'], ":")) {
        $id = $res['title'];
        $sql = "select * from `notify` where `id`='$id';";
        $admin_res = sql_query($sql);
        $ad_res = mysqli_fetch_array($admin_res);
        ?>
        <div class="notice_list">
            <a href="notice_read.php?seq=<?=$res['seq']?>&page=<?=$page?>">
                <div class="up_section">
                    <div class="number" style="<?php if($res['type'] == '중요공지') echo "width: 20%;"; else echo "width: 10%;";?>"><span class="emphasis"><?php if($ad_res['type'] == "중요공지") echo "[중요] ";?>공지</span></div>
                    <div class="notice_title"><span class="emphasis"><?=$ad_res['title']?>
                            <?php
                            if($ad_res['attach_file_url']) {
                                ?>
                                <img src="./img/disc.png" style="width: 13px; height: 13px;">
                                <?php
                            }
                            ?>
                        </span></div>
                    <div class="date"><span><?=$time?></span></div>
                </div>
                <div class="down_section">
                    <div class="writer"><span>작성자 : 관리자</span><span style="margin-left: 20px;">캠퍼스 명 : <?=$_SESSION['client_name']?></span></div>
                </div>
            </a>
        </div>
        <?php
    }else {
        ?>
        <div class="notice_list">
            <a href="notice_read.php?seq=<?=$res['seq']?>&page=<?=$page?>">
                <div class="up_section">
                    <div class="number" style="<?php if($res['type'] == '중요공지') echo "width: 20%;"; else echo "width: 10%;";?>"><span class="emphasis"><?php if($res['type'] == "중요공지") echo "[중요] ";?>공지</span></div>
                    <div class="notice_title"><span class="emphasis"><?=$res['title']?>
                            <?php if($res['file_url']) {
                                ?>
                                <img src="./img/disc.png" style="width: 13px; height: 13px;">
                                <?php
                            }
                            ?>
                        </span></div>
                    <div class="date"><span><?=$time?></span></div>
                </div>
                <div class="down_section">
                    <div class="writer"><span>작성자 : <?=$res['writer']?></span><span style="margin-left: 20px;">캠퍼스 명 : <?=$_SESSION['client_name']?></span></div>
                </div>
            </a>
        </div>
        <?
    }
    $i++;
}
$hh = 72*(10-$i);
?>
<div class="page_wrap" style="margin-top: <?=$hh?>px;bottom:10px;width:98%">
    <div class="page_wrap_wrap">
        <div class="left_btn" style="<?php if($page==1) echo "visibility: hidden;";?>"><a href="notice.php?page=<?=$page-1?>&search=<?=$_GET['search']?>"><img src="img/prev_btn.png" alt="prev_btn_icon"></a></div>
        <div class="page_btn_wrap">
            <?php
            $sql = "select * from `teacher_notice` where (`title` like '$search' or `target` like '$search') and `client_id`='$ac' and `n_range` like '$student' and `d_uid` RLIKE '$d_uid' order by `type` desc, `event_time` desc ";
            $result = sql_query($sql);
            $cnt = 0;
            $last = 0;
            while($res = mysqli_fetch_array($result)) $cnt++;
            for($i=0; $i<$cnt/10; $i++) {
                ?>
                <div class="page_btn"><a href="notice.php?page=<?=$i+1?>&search=<?=$_GET['search']?>" id="<?=$i+1?>"><?=$i+1?></a></div>
                <?
                $last++;
            }
            ?>
        </div>
        <div class="right_btn" style="<?php if($page==$last) echo "visibility: hidden;";?>"><a href="notice.php?page=<?=$page+1?>&search=<?=$_GET['search']?>"><img src="img/next_btn.png" alt="next_btn_icon"></a></div>
    </div>
</div>
<script>
    $('#'+page).addClass("on");
</script>
