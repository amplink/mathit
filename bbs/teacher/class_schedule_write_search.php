<?php
include_once ('_common.php');
$type = $_GET['type'];
$title = $_GET['title'];
$writer = $_GET['writer'];

if($type == 'undefined') $type = "";

$search_type = "%".$type."%";
$search_title = "%".$title."%";
$search_writer = "%".$writer."%";
$ac = $_SESSION['client_no'];

$t_uid = $_SESSION['t_uid'];
$t_name = $_SESSION['t_name'];
$sql = "select `type` from `teacher_setting` where `t_id`='$t_uid';";
$result = sql_query($sql);
$res = mysqli_fetch_array($result);
$t_type = $res['type'];

if($_SESSION['admin']) {
    $t_type='관리자';
    $t_name = "관리자";
}

if($type && $title && $writer) $sql = "select * from `teacher_schedule` where `s_range` = '$t_type' or `s_range` = '전체' or `writer`='$t_name' and `type` like '$search_type' and `title` like '$search_title' and `writer` like '$search_writer' order by `event_time` desc;";
else if($type && $title) $sql = "select * from `teacher_schedule` where `s_range` = '$t_type' or `s_range` = '전체' or `writer`='$t_name' and `type` like '$search_type' and `title` like '$search_title' order by `event_time` desc;";
else if($type && $writer) $sql = "select * from `teacher_schedule` where `s_range` = '$t_type' or `s_range` = '전체' or `writer`='$t_name' and `type` like '$search_type' and `writer` like '$search_writer' order by `event_time` desc;";
else if($title && $writer) $sql = "select * from `teacher_schedule` where  `s_range` = '$t_type' or `s_range` = '전체' or `writer`='$t_name' and `writer` like '$search_writer' and `title` like '$search_title' order by `event_time` desc;";
else if($type) $sql = "select * from `teacher_schedule` where `s_range` = '$t_type' or `s_range` = '전체' or `writer`='$t_name' and `type` like '$search_type' order by `event_time` desc;";
else if($title) $sql = "select * from `teacher_schedule` where `s_range` = '$t_type' or `s_range` = '전체' or `writer`='$t_name' and `title` like '$search_title' order by `event_time` desc;";
else if($writer) $sql = "select * from `teacher_schedule` where `s_range` = '$t_type' or `s_range` = '전체' or `writer`='$t_name' and `writer` like '$writer' order by `event_time` desc;";
else $sql = "select * from `teacher_schedule` where `s_range` = '$t_type' or `s_range` = '전체' or `writer`='$t_name'  order by `event_time` desc;";

$result = mysqli_query($connect_db, $sql);
$i=1;
$thisTime=date("Y-m-d H:i:s");
if($result) {
    while($res = mysqli_fetch_array($result)) {
        if($res['s_range']=="비공개" && $res['writer'] != $t_name) {
            continue;
        }
        else {
            ?>
            <tr onclick="call_content(<?=$res['seq']?>)">
                <td><span><?=$i?></span></td>
                <td><span><?=$res['title']?></span>
                    <?php
                    $signdate = $res['event_time'];
                    $someTime=strtotime($thisTime)-strtotime("$signdate GMT");
                    $cha = ceil($someTime/(60*60*24));
                    //                echo $cha;
                    if($cha <= 2) {
                        ?>
                        <div class="new"><p>new</p></div>
                        <?php
                        $cnt++;
                    }
                    ?>
                </td>
                <td>
                    <?php if($res['file_url']) {
                        ?>
                        <div class="have_sign"></div>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?
            $i++;
        }
    }
}
?>
