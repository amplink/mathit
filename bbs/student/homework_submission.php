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
				   A.client_id = '$_SESSION[client_id]'
				  ";


//echo $sql;
$result = mysqli_query($connect_db, $sql);
$res = mysqli_fetch_array($result);

if($res['current_status'] == '' || $res['current_status'] == 's1'){
    ?>
    <!--section-->
    <section>
        <div class="bigimg" style="position:absolute;width:100%;height:100vh;z-index:999;display:none"></div>
        <div class="head_p">
            <p class="head_title">숙제제출</p>
            <div class="back_btn"><a href="homework_ing.php"><img src="img/back_btn.png" alt="back_btn_icon"></a></div>
        </div>
        <div class="content_p">
            <div class="homework_name_wrap">
                <p class="sub_title">숙제명</p>
                <p class="sub_section_info"><span><?= $res['grade'] ?> - <?= $res['semester'] ?>
                <span><?= $res['unit'] ?></span></p>
            </div>
            <div class="homework_limit_wrap">
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
                <div class="detail_head"><input multiple="multiple" name="files[]" id="files" type="file" style="display:none"/>
                    <div class="check_btn"  onclick='photosel()'><a><img src="img/check_btn.png" alt="check_btn_icon" style="width: 25px; float: left;"  id="imgReg"><span class="complete">등록</span></a></div>
                    <p><span>    등록 버튼을 눌러 숙제 이미지를 추가한 후</span><span>완료 버튼을 눌러 저장해 주세요</span></p>
                </div>

                <div class="photo_section" style="float:left" id="sortable">
                    <!--<div class="photo_box">
                        <div class="camera_icon">
                            <img src="img/camera.png" alt="camera_icon"></div>
                    </div>-->
                </div>

            </form>

            <div class="detail_footer">
                <p><span>현재 등록된 이미지 개수 : </span><span id="num">1</span><span>장</span></p>
                <div class="check_btn" id="check_btn" onClick="save()"><a><img src="img/check_btn.png" alt="check_btn_icon" style="width: 25px; float: left;"><span class="complete">완료</span></a></div>
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

    <script>

        $(function() {

            $('#files').change(function(){
                fileBuffer = [];
                const target = document.getElementsByName('files[]');

                Array.prototype.push.apply(fileBuffer, target[0].files);
                var html = '';
                var i = $('.photo_box').length;
                var j = 1;
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
                });
                var num = $('.photo_box').length + i;
                $('.photo_section').append(html);
                $("#num").text(num);
            });

            $(document).on('click', '#removeImg', function(){
                const fileIndex = $(this).parent().index();
                fileBuffer.splice(fileIndex,1);
                $('.photo_section>div:eq('+fileIndex+')').remove();
            });


            $(document).on('click', '.camera_icon', function(){

                var img = $(this).children("img");
                var img_src = img.attr("src");
                $("#bigimg").show();
                $("#bigimg").html("<img src='"+img_src+"'>");

            });

            $(document).on('click', '.camera_icon', function(){

                var img = $(this).children("img");
                var img_src = img.attr("src");
                $(".bigimg").show();
                $(".bigimg").html("<img src='"+img_src+"'>");

            });


            $(document).on('click', '.bigimg', function(){
                $(this).hide();
            });


            $("#sortable").sortable({
                update : function(event, ui){
                    var postData = $(this).sortable('serialize');
                    console.log(postData);
                    $("#sort").val(postData);
                    /* $.post('sort_save.php', postData, function(data){
                       console.log(data);
                     },'text');*/
                }
            });

            $("#sortable").disableSelection();

            $("#check_btn").click(function(){

                $("#photoForm").ajaxForm({
                    type: "post",
                    url : "./upload_photo.php",
                    enctype : "multipart/form-data",
                    dataType : "text",
                    error : function(){
                        alert("잠시 후 다시 시도해 주십시오.") ;
                    },
                    success : function(result){
                        if(result == "success") alert('정상 제출 되었습니다.');
                        else if(result == "err") alert('잠시 후 다시 시도해 주십시오.');
                    }
                }).submit();

            });
        });

        function photosel(){

            document.getElementById('files').click();

        }

        function save(){



            //$("#photoForm").submit();

        }

    </script>

    <?
}else{
    ?>
    <script>
        alert('제출 할수 없습니다.');
    </script>
    <?
}
?>

</body>
</html>