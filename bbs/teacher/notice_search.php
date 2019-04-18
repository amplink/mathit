<?php
include_once ('_common.php');

$search = "%".$_GET['search']."%";
$i=1;
$cnt = 0;
$sql = "select * from `teacher_notice` where `title` like '$search' order by `type` desc, `event_time` desc";
$result = mysqli_query($connect_db, $sql);
$thisTime=date("Y-m-d H:i:s");
while($res = mysqli_fetch_array($result)) {
    if($res['writer'] == "관리자") {
        $id = $res['title'];
        $sql = "select * from `notify` where `id`='$id';";
        $admin_res = sql_query($sql);
        $ad_res = mysqli_fetch_array($admin_res);
        ?>
        <tr onclick="call_content('<?=$ad_res['id']?>')">
            <td><span><?=$i?></span></td>
            <td><span><?php if($ad_res['type']=="중요공지") echo "[공지]";?><?=$ad_res['title']?></span>
                <?php
                $signdate = $res['event_time'];
                $someTime=strtotime($thisTime)-strtotime("$signdate GMT");
                $cha = ceil($someTime/(60*60*24));
                echo $cha;
                if($cha <= 2) {
                    ?>
                    <div class="new"><p>new</p></div>
                    <?php
                    $cnt++;
                }
                ?>
            </td>
            <td>
                <?php
                if($ad_res['attach_file_url']) echo "<div class='have_sign'></div>";
                ?>
            </td>
        </tr>
        <?php
    }else {
    ?>
    <tr onclick="call_content(<?=$res['seq']?>)">
        <td><span><?=$i?></span></td>
        <td><span><?php if($res['type']=="중요공지") echo "[공지]";?><?=$res['title']?></span>
            <?php
            $signdate = $res['event_time'];
            $someTime=strtotime($thisTime)-strtotime("$signdate GMT");
            $cha = ceil($someTime/(60*60*24));
            if($cha <= 2) {
                ?>
                <div class="new"><p>new</p></div>
                <?php
                $cnt++;
            }
            ?>
        </td>
        <td>
            <?php
            if($res['file_url']) echo "<div class='have_sign'></div>";
            ?>
        </td>
    </tr>
    <?
    }
    $i++;
}
echo "<script>$('#new_cnt').text('$cnt');</script>";
?>