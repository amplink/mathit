<?
include_once('_common.php');
include_once('head.php');
//"./update_answer_add.php?grade='.$ac_data['grade'].'&semester='.$ac_data['semester'].'&unit='.$ac_data['unit'].'&level='.$ac_data['level'].'&book_type='.$ac_data['book_type'].'"
$grade = $_GET['grade'];
$semester = $_GET['semester'];
$unit = $_GET['unit'];
$level = $_GET['level'];
$book_type = $_GET['book_type'];
$page = $_GET['page'];

if($book_type == "베타") {
    echo "<script>location.href='./update_answer_add_beta.php?grade=".$grade."&semester=".$semester."&unit=".$unit."&level=".$level."&book_type=".$book_type."&page=".$page."';</script>";
}

?>

<link rel="stylesheet" type="text/css" media="screen" href="css/common.css?v=20190423" />
<link rel="stylesheet" type="text/css" media="screen" href="css/answer_add_2.css" />
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/answer_add.js"></script>
<style>
    .pt-17 {
        padding-top: 17px;
    }
    .pt-7 {
        vertical-align: middle;
    }
</style>
<link rel="stylesheet" type="text/css" media="screen" href="css/nanumsquare.css" />

<form enctype='multipart/form-data' action="update_answer_add_chk.php?page=<?=$page?>" method="POST" id="answer_add_form">

    <div class="section" style="width:100%">
        <div class="head_section"  style="width:calc(100% - 100px)">
            <div class="upside">
                <p>교재정보 등록</p>
                <div class="btn_wrap">
                    <div class="complete_btn" onclick="myFunction()"><a href="#">완료</a></div>
                    <div class="cancel_btn" onclick="button_can()"><a href="./answer_manegement.php?page=<?=$page?>">취소</a></div>
                </div>
            </div>
            <div class="downside">
                <table>
                    <thead>
                    <tr>
                        <th>교재구분</th>
                        <th>학년</th>
                        <th>학기</th>
                        <th>단원</th>
                        <th>레벨</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?
                        //                        $sql = "select * from `answer_master` where `grade` = '$grade' and `semester` = '$semester' and `unit` = '$unit' and `level` = '$level' and `book_type` = '$book_type';";
                        //                        $g = mysqli_query($connect_db, $sql);
                        //
                        //                        $a = mysqli_fetch_array($g);
                        //

                        ?>
                        <td><select name="book_type" id="textbook" disabled>
                                <option value="알파" selected>알파</option>
                                <option value="베타">베타</option>
                            </select></td>
                        <td><select name="grade" id="grade" disabled>
                                <option value="3">초3</option>
                                <option value="4">초4</option>
                                <option value="5">초5</option>
                                <option value="6">초6</option>
                                <option value="7">중1</option>
                                <option value="8">중2</option>
                                <option value="9">중3</option>
                            </select></td>
                        <td><select name="semester" id="semester" disabled>
                                <option value="1">1학기</option>
                                <option value="2">2학기</option>
                            </select></td>
                        <td><select name="unit" id="unit" onclick="book_info();" disabled>
                                <div id="unit_data">
                                    <option value="<?=$unit?>" selected><?=$unit?></option>
                                </div>
                            </select></td>
                        <td><select name="level" id="level" disabled>
                                <option value="루트">루트</option>
                                <option value="파이">파이</option>
                                <option value="시그마">시그마</option>
                            </select></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="view_section"  style="width:calc(100% - 60px)">
            <div class="upside_2">
                <p>정답지 작성</p>
                <div class="r_nav">
                    <div class="r_nav_menu" onclick="change(1)">
                        <p class="on" id="nav_1">
                            <?
                            if($level == "시그마") echo "유형마스터";
                            else echo "개념마스터";
                            ?>
                        </p>
                    </div>
                    <div class="r_nav_menu" onclick="change(2)">
                        <p class="" id="nav_2">
                            <?
                            if($level == "시그마") echo "유형확인";
                            else echo "개념확인";
                            ?>
                        </p>
                    </div>
                    <div class="r_nav_menu" onclick="change(3)">
                        <p class="" id="nav_3">서술과코칭</p>
                    </div>
                    <div class="r_nav_menu" onclick="change(4)">
                        <p class="" id="nav_4">이야기수학</p>
                    </div>
                </div>
            </div>
            <!-- 개념마스터 -->
            <div class="downside_2" id="section_1">
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <th>문항번호</th>
                        <th colspan="2">정답이미지</th>
                        <th colspan="2">풀이이미지</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?
                    if($level == "시그마") $c_name = "유형마스터";
                    else $c_name = "개념마스터";
                    $sql = "select * from `answer_master` where `grade` = '$grade' and `semester` = '$semester' and `unit` = '$unit' and `level` = '$level' and `book_type` = '$book_type' and `c_name` = '$c_name' order by `seq` asc;";
                    $res = mysqli_query($connect_db, $sql);
                    $i=0;
                    while($r = mysqli_fetch_array($res)) {
                        $event_time = $r['event_time'];
                        ?>
                        <tr id="item_section_1">
                            <td>
                                <div class="plus_icon" onclick="append_div(this,'a')"><img src="img/plus.png" alt="plus"></div>
                                <input type="hidden" name="a_idx[]" value="<?=$r['answer_id']?>">
                            </td>
                            <td class="pt-17"><input type="text" name="a_item_number[]" placeholder="문항번호" value="<?=$r['item_number'];?>" onkeydown="tab_next('a', <?=$i?>)"></td>
                            <td>
                                <img src="<?=$r['answer_image']?>" width="40" height="40" class="pt-7" style="height: 45px; width: auto;" id="a_answer_img_<?=$i;?>">
                            </td>
                            <td style="border-left: none;">
                                <input type="file" id="a_answer_file_<?=$i;?>" onchange="readImage1(this, <?=$i;?>, 'a')" name="a_answer_images[]">
<!--                                <input type="hidden" name="a_answer_image[]" id="a_answer_base_--><?//=$i;?><!--" value="--><?//=$r['answer_image']?><!--">-->
                            </td>
                            <td>
                                <img src="<?=$r['explain_image']?>" width="40" height="40" class="pt-7" style="height: 45px; width: auto;" id="a_explain_img_<?=$i;?>">
                            </td>
                            <td style="border-left: none;">
                                <input type="file" id="a_explain_file_<?=$i;?>" onchange="readImage2(this, <?=$i;?>, 'a')" name="a_explain_images[]">
<!--                                <input type="hidden" name="a_explain_image[]" id="a_explain_base_--><?//=$i;?><!--" value="--><?//=$r['explain_image']?><!--">-->
                            </td>
                            <td>
                                <?
                                if ($i > 0) {
                                    echo '<div class="minus_icon" onclick = "delete_div(this)" ><img src = "img/minus.png" alt = "minus" ></div >';
                                }
                                ?>
                            </td>
                        </tr>
                        <?
                        $i++;
                    }
                    if($i==0) {
                        ?>
                        <tr id="item_section_1">
                            <td>
                                <div class="plus_icon" onclick="append_div(this,'a')"><img src="img/plus.png" alt="plus"></div>
                                <input type="hidden" name="a_idx[]" value="">
                            </td>
                            <td class="pt-17"><input type="text" name="a_item_number[]" placeholder="문항번호" value="" onkeydown="tab_next('a', <?=$i?>)"></td>
                            <td>
                                <img src="" width="40" height="40" class="pt-7" style="height: 45px; width: auto;" id="a_answer_img_<?=$i;?>">
                            </td>
                            <td style="border-left: none;">
                                <input type="file" id="a_answer_file_<?=$i;?>" onchange="readImage1(this, <?=$i;?>, 'a')" name="a_answer_images[]">
<!--                                <input type="hidden" name="a_answer_image[]" id="a_answer_base_--><?//=$i;?><!--" value="">-->
                            </td>
                            <td>
                                <img src="" width="40" height="40" class="pt-7" style="height: 45px; width: auto;" id="a_explain_img_<?=$i;?>">
                            </td>
                            <td style="border-left: none;">
                                <input type="file" id="a_explain_file_<?=$i;?>" onchange="readImage2(this, <?=$i;?>, 'a')" name="a_answer_images[]">
<!--                                <input type="hidden" name="a_explain_image[]" id="a_explain_base_--><?//=$i;?><!--" value="">-->
                            </td>
                            <td>
                                <?
                                if ($i > 0) {
                                    echo '<div class="minus_icon" onclick = "delete_div(this)" ><img src = "img/minus.png" alt = "minus" ></div >';
                                }
                                ?>
                            </td>
                        </tr>
                        <?
                    }
                    ?>
                    <input type="hidden" name="event" value="<?=$event_time?>">
                    </tbody>
                </table>
            </div>
            <!-- 개념확인 -->
            <div class="downside_2" id="section_2">
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <th>문항번호</th>
                        <th colspan="2">정답이미지</th>
                        <th colspan="2">풀이이미지</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?
                    if($level == "시그마") $c_name = "유형확인";
                    else $c_name = "개념확인";
                    $sql = "select * from `answer_master` where `grade` = '$grade' and `semester` = '$semester' and `unit` = '$unit' and `level` = '$level' and `book_type` = '$book_type' and `c_name` = '$c_name' order by `seq` asc;";
                    $res = mysqli_query($connect_db, $sql);
                    $i=0;
                    while($r = mysqli_fetch_array($res)) {
                        ?>
                        <tr id="item_section_2">
                            <td>
                                <div class="plus_icon" onclick="append_div(this,'b')"><img src="img/plus.png" alt="plus"></div>
                                <input type="hidden" name="b_idx[]" value="<?=$r['answer_id']?>">
                            </td>
                            <td class="pt-17"><input type="text" name="b_item_number[]" placeholder="문항번호" value="<?=$r['item_number'];?>" onkeydown="tab_next('b', <?=$i?>)"></td>
                            <td>
                                <img src="<?=$r['answer_image']?>" width="40" height="40" class="pt-7" style="height: 45px; width: auto;" id="b_answer_img_<?=$i;?>">
                            </td>
                            <td style="border-left: none;">
                                <input type="file" id="b_answer_file_<?=$i;?>" onchange="readImage1(this, <?=$i;?>, 'b')" name="b_answer_images[]">
<!--                                <input type="hidden" name="b_answer_image[]" id="b_answer_base_--><?//=$i;?><!--" value="--><?//=$r['answer_image']?><!--">-->
                            </td>
                            <td>
                                <img src="<?=$r['explain_image']?>" width="40" height="40" class="pt-7" style="height: 45px; width: auto;" id="b_explain_img_<?=$i;?>">
                            </td>
                            <td style="border-left: none;">
                                <input type="file" id="b_explain_file_<?=$i;?>" onchange="readImage2(this, <?=$i;?>, 'b')" name="b_explain_images[]">
<!--                                <input type="hidden" name="b_explain_image[]" id="b_explain_base_--><?//=$i;?><!--" value="--><?//=$r['explain_image']?><!--">-->
                            </td>
                            <td>
                                <?
                                if ($i > 0) {
                                    echo '<div class="minus_icon" onclick = "delete_div(this)" ><img src = "img/minus.png" alt = "minus" ></div >';
                                }
                                ?>
                            </td>
                        </tr>
                        <?
                        $i++;
                    }
                    if($i==0) {
                        ?>
                        <tr id="item_section_2">
                            <td>
                                <div class="plus_icon" onclick="append_div(this,'b')"><img src="img/plus.png" alt="plus"></div>
                                <input type="hidden" name="b_idx[]" value="">
                            </td>
                            <td class="pt-17"><input type="text" name="b_item_number[]" placeholder="문항번호" value="" onkeydown="tab_next('b', <?=$i?>)"></td>
                            <td>
                                <img src="" width="40" height="40" class="pt-7" style="height: 45px; width: auto;" id="b_answer_img_<?=$i;?>">
                            </td>
                            <td style="border-left: none;">
                                <input type="file" id="b_answer_file_<?=$i;?>" onchange="readImage1(this, <?=$i;?>, 'b')" name="b_answer_images[]">
<!--                                <input type="hidden" name="b_answer_image[]" id="b_answer_base_--><?//=$i;?><!--" value="">-->
                            </td>
                            <td>
                                <img src="" width="40" height="40" class="pt-7" style="height: 45px; width: auto;" id="b_explain_img_<?=$i;?>">
                            </td>
                            <td style="border-left: none;">
                                <input type="file" id="b_explain_file_<?=$i;?>" onchange="readImage2(this, <?=$i;?>, 'b')" name="b_explain_images[]">
<!--                                <input type="hidden" name="b_explain_image[]" id="b_explain_base_--><?//=$i;?><!--" value="">-->
                            </td>
                            <td>
                                <?
                                if ($i > 0) {
                                    echo '<div class="minus_icon" onclick = "delete_div(this)" ><img src = "img/minus.png" alt = "minus" ></div >';
                                }
                                ?>
                            </td>
                        </tr>
                        <?
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <!-- 서술과 코칭 -->
            <div class="downside_2" id="section_3">
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <th>문항번호</th>
                        <th colspan="2">정답이미지</th>
                        <th colspan="2">풀이이미지</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?
                    $sql = "select * from `answer_master` where `grade` = '$grade' and `semester` = '$semester' and `unit` = '$unit' and `level` = '$level' and `book_type` = '$book_type' and `c_name` = '서술과코칭' order by `seq` asc;";
                    $res = mysqli_query($connect_db, $sql);
                    $i=0;
                    while($r = mysqli_fetch_array($res)) {
                        ?>
                        <tr id="item_section_3">
                            <td>
                                <div class="plus_icon" onclick="append_div(this,'c')"><img src="img/plus.png" alt="plus"></div>
                                <input type="hidden" name="c_idx[]" value="<?=$r['answer_id']?>">
                            </td>
                            <td class="pt-17"><input type="text" name="c_item_number[]" placeholder="문항번호" value="<?=$r['item_number'];?>" onkeydown="tab_next('c', <?=$i?>)"></td>
                            <td>
                                <img src="<?=$r['answer_image']?>" width="40" height="40" class="pt-7" style="height: 45px; width: auto;" id="c_answer_img_<?=$i;?>">
                            </td>
                            <td>
                                <input type="file" id="c_answer_file_<?=$i;?>" onchange="readImage1(this, <?=$i;?>, 'c')" name="c_answer_images[]">
<!--                                <input type="hidden" name="c_answer_image[]" id="c_answer_base_--><?//=$i;?><!--" value="--><?//=$r['answer_image']?><!--">-->
                            </td>
                            <td>
                                <img src="<?=$r['explain_image']?>" width="40" height="40" class="pt-7" style="height: 45px; width: auto;" id="c_explain_img_<?=$i;?>">
                            </td>
                            <td>
                                <input type="file" id="c_explain_file_<?=$i;?>" onchange="readImage2(this, <?=$i;?>, 'c')" name="c_explain_images[]">
<!--                                <input type="hidden" name="c_explain_image[]" id="c_explain_base_--><?//=$i;?><!--" value="--><?//=$r['explain_image']?><!--">-->
                            </td>
                            <td>
                                <?
                                if ($i > 0) {
                                    echo '<div class="minus_icon" onclick = "delete_div(this)" ><img src = "img/minus.png" alt = "minus" ></div >';
                                }
                                ?>
                            </td>
                        </tr>
                        <?
                        $i++;
                    }
                    if($i==0) {
                        ?>
                        <tr id="item_section_3">
                            <td>
                                <div class="plus_icon" onclick="append_div(this,'c')"><img src="img/plus.png" alt="plus"></div>
                                <input type="hidden" name="c_idx[]" value="">
                            </td>
                            <td class="pt-17"><input type="text" name="c_item_number[]" placeholder="문항번호" value="" onkeydown="tab_next('c', <?=$i?>)"></td>
                            <td>
                                <img src="" width="40" height="40" class="pt-7" style="height: 45px; width: auto;" id="c_answer_img_<?=$i;?>">
                            </td>
                            <td>
                                <input type="file" id="c_answer_file_<?=$i;?>" onchange="readImage1(this, <?=$i;?>, 'c')" name="c_answer_images[]">
<!--                                <input type="hidden" name="c_answer_image[]" id="c_answer_base_--><?//=$i;?><!--" value="">-->
                            </td>
                            <td>
                                <img src="" width="40" height="40" class="pt-7" style="height: 45px; width: auto;" id="c_explain_img_<?=$i;?>">
                            </td>
                            <td>
                                <input type="file" id="c_explain_file_<?=$i;?>" onchange="readImage2(this, <?=$i;?>, 'c')" name="c_explain_images[]">
<!--                                <input type="hidden" name="c_explain_image[]" id="c_explain_base_--><?//=$i;?><!--" value="">-->
                            </td>
                            <td>
                                <?
                                if ($i > 0) {
                                    echo '<div class="minus_icon" onclick = "delete_div(this)" ><img src = "img/minus.png" alt = "minus" ></div >';
                                }
                                ?>
                            </td>
                        </tr>
                        <?
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <!-- 이야기수학 -->
            <div class="downside_2" id="section_4">
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <th>문항번호</th>
                        <th colspan="2">정답이미지</th>
                        <th colspan="2">풀이이미지</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?
                    $sql = "select * from `answer_master` where `grade` = '$grade' and `semester` = '$semester' and `unit` = '$unit' and `level` = '$level' and `book_type` = '$book_type' and `c_name` = '이야기수학' order by `seq` asc;";
                    $res = mysqli_query($connect_db, $sql);
                    $i=0;
                    while($r = mysqli_fetch_array($res)) {
                        ?>
                        <tr id="item_section_4">
                            <td>
                                <div class="plus_icon" onclick="append_div(this,'d')"><img src="img/plus.png" alt="plus"></div>
                                <input type="hidden" name="d_idx[]" value="<?=$r['answer_id']?>">
                            </td>
                            <td class="pt-17"><input type="text" name="d_item_number[]" placeholder="문항번호" value="<?=$r['item_number'];?>" onkeydown="tab_next('d', <?=$i?>)"></td>
                            <td>
                                <img src="<?=$r['answer_image']?>" width="40" height="40" class="pt-7" style="height: 45px; width: auto;" id="d_answer_img_<?=$i;?>">
                            </td>
                            <td>
                                <input type="file" id="d_answer_file_<?=$i;?>" onchange="readImage1(this, <?=$i;?>, 'd')" name="d_answer_images[]">
<!--                                <input type="hidden" name="d_answer_image[]" id="d_answer_base_--><?//=$i;?><!--" value="--><?//=$r['answer_image']?><!--">-->
                            </td>
                            <td>
                                <img src="<?=$r['explain_image']?>" width="40" height="40" class="pt-7" style="height: 45px; width: auto;" id="d_explain_img_<?=$i;?>">
                            </td>
                            <td>
                                <input type="file" id="d_explain_file_<?=$i;?>" onchange="readImage2(this, <?=$i;?>, 'd')" name="d_explain_images[]">
<!--                                <input type="hidden" name="d_explain_image[]" id="d_explain_base_--><?//=$i;?><!--" value="--><?//=$r['explain_image']?><!--">-->
                            </td>
                            <td>
                                <?
                                if ($i > 0) {
                                    echo '<div class="minus_icon" onclick = "delete_div(this)" ><img src = "img/minus.png" alt = "minus" ></div >';
                                }
                                ?>
                            </td>
                        </tr>
                        <?
                        $i++;
                    }
                    if($i==0) {
                        ?>
                        <tr id="item_section_4">
                            <td>
                                <div class="plus_icon" onclick="append_div(this,'d')"><img src="img/plus.png" alt="plus"></div>
                                <input type="hidden" name="d_idx[]" value="">
                            </td>
                            <td class="pt-17"><input type="text" name="d_item_number[]" placeholder="문항번호" value="" onkeydown="tab_next('d', <?=$i?>)"></td>
                            <td>
                                <img src="" width="40" height="40" class="pt-7" style="height: 45px; width: auto;" id="d_answer_img_<?=$i;?>">
                            </td>
                            <td>
                                <input type="file" id="d_answer_file_<?=$i;?>" onchange="readImage1(this, <?=$i;?>, 'd')" name="d_answer_images[]">
<!--                                <input type="hidden" name="d_answer_image[]" id="d_answer_base_--><?//=$i;?><!--" value="">-->
                            </td>
                            <td>
                                <img src="" width="40" height="40" class="pt-7" style="height: 45px; width: auto;" id="d_explain_img_<?=$i;?>">
                            </td>
                            <td>
                                <input type="file" id="d_explain_file_<?=$i;?>" onchange="readImage2(this, <?=$i;?>, 'd')" name="d_explain_images[]">
<!--                                <input type="hidden" name="d_explain_image[]" id="d_explain_base_--><?//=$i;?><!--" value="">-->
                            </td>
                            <td>
                                <?
                                if ($i > 0) {
                                    echo '<div class="minus_icon" onclick = "delete_div(this)" ><img src = "img/minus.png" alt = "minus" ></div >';
                                }
                                ?>
                            </td>
                        </tr>
                        <?
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <input type="hidden" id="submit_section_1">
</form>
</body>

</html>
<script>
    $(window).bind('beforeunload', function () {
        return "저장하지 않고 페이지를 벗어나시겠습니까?";
    });
    var a = 1000;
    var b = 1000;
    var c = 1000;
    var d = 1000;


    $("div#section_1").show();
    $("div#section_2").hide();
    $("div#section_3").hide();
    $("div#section_4").hide();

    $("option[value='<? echo $grade; ?>']").prop('selected', true);
    $("option[value='<? echo $semester; ?>']").prop('selected', true);
    $("option[value='<? echo $level; ?>']").prop('selected', true);
    $("option[value='<? echo $book_type; ?>']").prop('selected', true);
    if($('#unit').val() == "총정리(1)" || $('#unit').val() == "총정리(2)") {
        $("#nav_3").parent().hide();
        $("#nav_4").parent().hide();
        $("#nav_2").parent().css('border-right', '0px');
    }
    function change(n) {
        if(n==1) {
            $("div#section_1").show();
            $("div#section_2").hide();
            $("div#section_3").hide();
            $("div#section_4").hide();
        }
        if(n==2) {
            $("div#section_1").hide();
            $("div#section_2").show();
            $("div#section_3").hide();
            $("div#section_4").hide();
        }
        if(n==3) {
            $("div#section_1").hide();
            $("div#section_2").hide();
            $("div#section_3").show();
            $("div#section_4").hide();
        }
        if(n==4) {
            $("div#section_1").hide();
            $("div#section_2").hide();
            $("div#section_3").hide();
            $("div#section_4").show();
        }
    }

    function append_div(previous,idx) {
        var cnt;
        if(idx == 'a') cnt = ++a;
        else if(idx == 'b') cnt = ++b;
        else if(idx == 'c') cnt = ++c;
        else if(idx == 'd') cnt = ++d;

        var text = '<tr class="item_section">\n' + '<td>\n' +
            '<div class="plus_icon" onclick="append_div(this, \'' + idx + '\')">' +
            '<img src="img/plus.png" alt="plus"><input type="hidden" name="'+idx+'_idx[]"></div></td>\n' +
            '<td><input type="text" name="'+idx+'_item_number[]" placeholder="문항번호" onkeydown="tab_next(\''+idx+'\', '+cnt+')"></td>\n' +
            '<td><img src="" id="'+idx+'_answer_img_'+cnt+'" width="40" height="40" class="pt-7" style="height: 45px; width: auto;"></td>' +
            '<td><input type="file" id="'+idx+'_answer_file_'+cnt+'" onchange="readImage1(this, '+cnt+', \''+idx+'\')" name="'+idx+'_answer_images[]"></td>\n' +
            '<td><img src="" id="'+idx+'_explain_img_'+cnt+'" width="40" height="40" class="pt-7" style="height: 45px; width: auto;"></td>' +
            '<td><input type="file" id="'+idx+'_explain_file_'+cnt+'" onchange="readImage2(this, '+cnt+', \''+idx+'\')" name="'+idx+'_explain_images[]"></td>\n' +
            '<td><div class="minus_icon" onclick="delete_div(this)"><img src="img/minus.png" alt="minus"></div></td>\n' +
            '</tr>';
        $(previous).parent().parent().after(text);
    }

    function delete_div(t) {
        $(t).parent().parent().remove();
    }

    function myFunction() {
        $("select").prop('disabled', false);
        $(window).unbind('beforeunload');
        $("#answer_add_form").submit();
    }

    function readImage1(input, count, idx) {
        if (input.files && input.files[0]) {
            var FR= new FileReader();
            FR.onload = function(e) {
                // $("#"+idx+"_answer_base_"+count).val(e.target.result);
                $("#"+idx+"_answer_img_"+count).attr("src", e.target.result);
            };
            FR.readAsDataURL(input.files[0]);
        }
    }

    function readImage2(input, count, idx) {
        if (input.files && input.files[0]) {
            var FR= new FileReader();
            FR.onload = function(e) {
                // $("#"+idx+"_explain_base_"+count).val(e.target.result);
                $("#"+idx+"_explain_img_"+count).attr("src", e.target.result);
            };
            FR.readAsDataURL(input.files[0]);
        }
    }

    function book_info() {
        $.ajax({
            type: "GET",
            url: "book_info.php?grade="+$('#grade option:selected').val()+"&semester="+$('#semester option:selected').val(),
            dataType: "html",
            success: function(response){
                $("#unit").html(response);
            }
        });
    }

    function tab_next(t, e) {
        if(event.keyCode==9) $('#'+t+'_explain_file_'+e).focus();
    }
</script>