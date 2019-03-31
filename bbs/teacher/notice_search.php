<?php
include_once ('_common.php');

$search = "%".$_GET['search']."%";
$i=1;

$sql = "select * from `notify` where `title` like '$search';";
$result = sql_query($sql);

while($res = mysqli_fetch_array($result)) {
    ?>
    <tr onclick="call_content('<?=$res['id']?>')">
        <td><span><?=$i?></span></td>
        <td><span><?=$res['title']?></span>
            <div class="new">
                <p>new</p>
            </div>
        </td>
        <td>
            <?php
            if($res['attach_file_url']) echo "<div class='have_sign'></div>";
            ?>
        </td>
    </tr>
    <?php
    $i++;
}

$sql = "select * from `teacher_notice` where `title` like '$search';";
$result = mysqli_query($connect_db, $sql);

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
            <?php
            if($res['file_url']) echo "<div class='have_sign'></div>";
            ?>
        </td>
    </tr>
    <?
    $i++;
}

?>