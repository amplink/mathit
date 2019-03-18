<?php
include_once ('_common.php');
session_start();

$search = "%".$_GET['search']."%";
$sql = "select * from `teacher_notice` where `title` like '$search';";
$result = mysqli_query($connect_db, $sql);

$i=1;
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