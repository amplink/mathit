<?php
include_once('_common.php');

define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

//include_once(G5_THEME_PATH.'/head.php');
include_once('head.php');

?>

<script src="js/jquery-3.3.1.min.js"></script>
    <div class="section">
        <div class="head_section">
            <div class="l_title">
                <p>공지사항</p>
            </div>
            <div class="search_box_wrap">
                <div class="search_input_box"><input type="text"></div>
                <div class="search_btn"><a href="#none">검색</a></div>
            </div>
        </div>
        <div class="view_section">
            <table>
                <thead>
                    <tr style="text-align:center">
                        <th><input type="checkbox"></th>
                        <th>번호</th>
                        <th>유형</th>
                        <th>제목</th>
                        <th>공지범위</th>
                    </tr>
                </thead>
                <tbody>
                <form action="notice_home_del.php" method="POST" id="notice_form">
                    <?php
                    $sql = "select * from `notify`";
                    $result = mysqli_query($connect_db, $sql);
                    $i=1;

                    while($res = mysqli_fetch_array($result)) {
                        $target = "";
                        if($res['type']==0) $type = "전체공지";
                        else if($res['type']==1) $type = "일반공지";
                        else if($res['type']==2) $type = "중요공지";
                        $range = explode(",", $res['target']);
                        foreach($range as $t) {
                            if($t == 0) $target .= "전임강사,";
                            else if($t == 1) $target .= "채점강사,";
                            else if($t == 2) $target .= "학생,";
                        }

                        $target[count($target)-2] = "\0";

                        echo "<tr><td><input type='checkbox' name='notice_chk[]' value='".$res['id']."'></td><td>$i</td><td>".$type."</td><td>".$res['title']."</td><td>$target</td></tr>";
                        $i++;
                    }
                    ?>
                </form>
                </tbody>
            </table>
        </div>
        <div class="section_footer">
            <div class="list_btn_wrap">
                <div class="prev_btn"><a href="#none"><img src="img/prev.png" alt=""></a></div>
                <ul>
                    <li><a href="#none" class="on">1</a></li>
                    <li><a href="#none">2</a></li>
                    <li><a href="#none">3</a></li>
                    <li><a href="#none">4</a></li>
                    <li><a href="#none">5</a></li>
                </ul>
                <div class="next_btn"><a href="#none"><img src="img/next.png" alt=""></a></div>
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
    function del_notice() {
        $('#notice_form').submit();
    }
</script>
