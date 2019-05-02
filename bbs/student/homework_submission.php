<?php
include_once ('head.php');
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/homework_submission.css" />
<?php
$sql = "SELECT 
                   A.current_status,
				   B.grade, B.semester, B.unit, B._to
				FROM 
				  `homework_assign_list` A,
				  `homework` B
				WHERE 
				   B.seq = A.h_id
				AND
				   A.id = '$_GET[no]'
				AND 
				   A.student_id = '$_SESSION[s_id]'
				AND 
				   A.client_id = '$_SESSION[client_id]'
				  ";

//echo $sql;
$result = sql_query($sql);
$res = mysqli_fetch_array($result);
$tot = count($res);
if($tot == 0) {
    alert_msg("존재하지 않는 숙제 입니다.");
    echo "<script>history.back();</script>";
    exit;
}
?>
<!--section-->
<section>
    <div class="bigimg" style="position:absolute;width:100%;height:100vh;z-index:999;background-color:white;display:none"></div>
    <div class="head_p">
        <p class="head_title">숙제제출</p>
        <div class="back_btn"><a href="homework_ing.php"><img src="img/back_btn.png" alt="back_btn_icon"></a></div>
    </div>
    <div class="content_p">
        <div class="homework_name_wrap" style="padding-left:10px">
            <p class="sub_title">숙제명</p>
            <p class="sub_section_info"><span><?= $res['grade'] ?> - <?= $res['semester'] ?>
                <span><?= $res['unit'] ?></span></p>
        </div>
        <div class="homework_limit_wrap" style="float:right;padding-right:10px">
            <p class="sub_title">마감 시간</p>
            <p class="sub_section_info">
                <span><?=substr($res['_to'],-4)?>-<?=substr($res['_to'],0,2)?>-<?=substr($res['_to'],3,2)?></span>
            </p>
        </div>
    </div>

    <div class="content_detail_p">
        <form action='./upload_photo.php' method="post" name="photoForm" id="photoForm" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$_GET['no']?>">
            <input type="hidden" name="sort" id="sort" value="">
            <input type="hidden" name="status" id="status" value="<?=$res['current_status']?>">
            <div class="detail_head"><input multiple name="files[]" id="files" type="file" style="display:none"/>
                <div class="check_btn"  onclick='photosel()'><a><img src="img/check_btn.png" alt="check_btn_icon" style="width: 25px; float: left;"  id="imgReg"><span class="complete">등록</span></a></div>
                <p><span>    등록 버튼을 눌러 숙제 이미지를 추가한 후</span><span>완료 버튼을 눌러 저장해 주세요</span></p>
            </div>

            <div class="photo_section" style="float:left" id="sortable">

                <?php
                $sql2 = "SELECT * FROM 
					       `upload_photo` 
					     WHERE 
					       id = '$_GET[no]' 
						 AND student_id = '$_SESSION[s_id]'
					     ORDER BY sort asc";

                $result2 = sql_query($sql2);
                $i = 0;
                while ($res2 = mysqli_fetch_array($result2)) {
                    ++$i;
                    ?>
                    <div class="file" id="img_<?=$res2['seq']?>">
                        <div class="photo_box">
                            <div class="camera_icon" style="width:100%;">
                                <img src="./data/photo/<?=$res2['reg_month']?>/<?=$res2['id']?>/<?=$res2['file_name']?>" height="70" style="margin-top:-25px">
                            </div>
                        </div>
                        <span style="font-size:13px"><?=$i?></span>
                        <span class="removeImgDb" data-value="<?=$res2['seq']?>">X</span>
                    </div>
                    <?
                }
                ?>
            </div>

        </form>

        <div class="detail_footer">
            <p><span>등록된 이미지 개수 : </span><span id="num"><?=$i?></span><span>장</span></p>
            <?
            if($res['current_status'] == '' || $res['current_status'] == 's1') {
                ?>
                <div class="check_btn" id="check_btn"><a><img src="img/check_btn.png" alt="check_btn_icon" style="width: 25px; float: left;"><span class="complete">완료</span></a></div>
                <?
            }else{
                ?>
                <div class="check_btn" style="width:80px"><a><img src="img/check_btn.png" alt="check_btn_icon" style="width: 25px; float: left;"><span class="complete">제출완료</span></a></div>
                <?
            }
            ?>
        </div>
        <div class="decoration">
            <span class="deco_circle"></span>
            <span class="deco_circle"></span>
            <span class="deco_circle"></span>
            <span class="deco_circle"></span>
            <span class="deco_circle"></span>
            <span class="deco_circle"></span>
            <span class="deco_circle"></span>
            <span class="deco_circle"></span>
            <span class="deco_circle"></span>
            <span class="deco_circle"></span>
        </div>
    </div>

</section>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
<script type="text/javascript" src="./js/jquery.form.min.js" ></script>
<script type="text/javascript" src="./js/jquery-ui.js" ></script>
<script type="text/javascript" src="./js/jquery.ui.touch-punch.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-touch-events/1.0.5/jquery.mobile-events.js"></script>

<script>

    $(function() {

        $('#files').change(function(){
            fileBuffer = [];
            //const target = document.getElementsByName('files[]');
            var files   = document.querySelector('input[type=file]').files;

            //Array.prototype.push.apply(fileBuffer, target[0].files);

            var i = $('.photo_box').length + 1;

            function readAndPreview(file) {

                var j = 1;
                var html = '';

                // Make sure `file.name` matches our extensions criteria
                if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {

                    var reader = new FileReader();
                    reader.addEventListener("load", function () {
                        if(i > 10){
                            alert('최대 10개까지 첨부 가능합니다.');
                            return false;
                        }

                        var image = new Image();
                        image.height = 100;
                        image.title = file.name;
                        image.src = this.result;
                        //preview.appendChild( image );

                        html += '<div class="file"  id="img_'+(i-1)+'">';
                        html += '<div class="photo_box">';
                        html += '<div class="camera_icon" style="width:100%;">';
                        //html += '<img src="img/camera.png" alt="camera_icon"></div>';
                        html += '<img src="'+image.src+'" height="70" style="margin-top:-25px"></div>';
                        html += '</div>';
                        //html += '<img src="'+URL.createObjectURL(file)+'" width="30" height="30">'
                        html += '<span style="font-size:13px">'+i+'</span>';
                        //html += '<span> <input type="text" style="width:250px/"></span>';
                        html += '<span id="removeImg">X</span>';
                        html += '</div>';

                        ++i;

                        $("#num").text(i-1);
                        $('.photo_section').append(html);
                    }, false);

                    reader.readAsDataURL(file);
                }

            }

            if (files) {
                [].forEach.call(files, readAndPreview);
            }



            /*
                            $.each(target[0].files, function(index, file){
                                const fileName = file.name;
                                html += '<div class="file"  id="img_'+j+'">';

                                html += '<div class="photo_box">';
                                html += '<div class="camera_icon" style="width:100%;">';
                                //html += '<img src="img/camera.png" alt="camera_icon"></div>';
                                html += '<img src="'+URL.createObjectURL(file)+'" height="70" style="margin-top:-25px"></div>';
                                html += '</div>';
                                //html += '<img src="'+URL.createObjectURL(file)+'" width="30" height="30">'
                                html += '<span style="font-size:13px">'+i+'</span>';
                                //html += '<span> <input type="text" style="width:250px/"></span>';
                                html += '<span id="removeImg">X</span>';
                                html += '</div>';
                                const fileEx = fileName.slice(fileName.indexOf(".") + 1).toLowerCase();
                                if(fileEx != "jpg" && fileEx != "png" &&  fileEx != "gif"){
                                    alert("파일은 (jpg, png, gif) 형식만 등록 가능합니다.");
                                    //resetFile();
                                    return false;
                                }

                                i++;
                                j++;
                            });*/
            //var num = i;
            // $('.photo_section').append(html);

        });

        $(document).on('mousedown', '#removeImg', function(){
            const fileIndex = $(this).parent().index();
            fileBuffer.splice(fileIndex,1);
            $('.photo_section>div:eq('+fileIndex+')').remove();
        });

        $(document).on('mousedown', '.removeImgDb', function(){
            if(confirm('정말 삭제 하겠습니가?')){
                var fileIndex = $(this).data("value");
                var n = $(".file").index($(this).parent('div'));
                $.post('img_del.php', {no:fileIndex}, function(data){
                    $('.photo_section>div:eq('+n+')').remove();
                },'text');
            }
        });

        $(document).on('mousedown', '.camera_icon', function(){
            var img = $(this).children("img");
            var img_src = img.attr("src");
            $(".bigimg").show();
            $(".bigimg").html("<img src='"+img_src+"'>");

        });
//});

        $(document).on('mousedown', '.bigimg', function(){
            $(this).hide();
        });

        /*
                     $("#sortable").sortable({
                        update : function(event, ui){
                            var postData = $(this).sortable('serialize');
                            console.log(postData);
                            $("#sort").val(postData);
                             $.post('sort_save.php?id=<?=$_GET[no]?>', postData, function(data){
                       console.log(data);
                     },'text');
                }
             }).disableSelection().on("tap", ".camera_icon", function() {
                var img = $(this).children("img");
                var img_src = img.attr("src");
                $(".bigimg").show();
                $(".bigimg").html("<img src='"+img_src+"'>");
            });
*/



        $("#check_btn").click(function(){

            if($('.photo_box').length == 0){
                alert("첨부할 사진을 먼저 선택해 주세요.");
                return false;
            }

            $("#photoForm").ajaxForm({
                type: "post",
                url : "./upload_photo.php",
                enctype : "multipart/form-data",
                dataType : "text",
                error : function(){
                    alert("잠시 후 다시 시도해 주십시오.") ;
                },
                success : function(result){
                    if(result == "success") alert('사진이 정상 등록 되었습니다.');
                    else if(result == "err") alert('사진이 정상 등록 되지 않았습니다.');
                    location.href = "homework_submission.php?no=<?=$_GET['no']?>";
                }
            }).submit();

        });
    });

    function photosel(){

        document.getElementById('files').click();

    }


</script>

</body>
</html>