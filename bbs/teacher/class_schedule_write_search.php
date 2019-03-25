<?php
include_once ('_common.php');
$type = $_GET['type'];
$title = $_GET['title'];
$writer = $_GET['writer'];

if($type == 'undefined') $type = "";

$search_type = "%".$type."%";
$search_title = "%".$title."%";
$search_writer = "%".$writer."%";


if($type && $title && $writer) $sql = "select * from `teacher_schedule` where `type` like '$search_type' and `title` like '$search_title' and `writer` like '$search_writer';";
else if($type && $title) $sql = "select * from `teacher_schedule` where `type` like '$search_type' and `title` like '$search_title';";
else if($type && $writer) $sql = "select * from `teacher_schedule` where `type` like '$search_type' and `writer` like '$search_writer';";
else if($title && $writer) $sql = "select * from `teacher_schedule` where  `writer` like '$search_writer' and `title` like '$search_title';";
else if($type) $sql = "select * from `teacher_schedule` where `type` like '$search_type';";
else if($title) $sql = "select * from `teacher_schedule` where `title` like '$search_title';";
else if($writer) $sql = "select * from `teacher_schedule` where `writer` like '$writer';";
else $sql = "select * from `teacher_schedule`;";

$result = mysqli_query($connect_db, $sql);
$i=1;
if($result) {
    while($res = mysqli_fetch_array($result)) {
        ?>
        <tr onclick="call_content(<?=$res['seq']?>)">
            <td><span><?=$i?></span></td>
            <td><span><?=$res['title']?></span>
                <div class="new">
                    <p>new</p>
                </div>
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
?>
