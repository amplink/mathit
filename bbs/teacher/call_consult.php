<?php
include_once ('_common.php');

$seq = $_GET['seq'];

$sql = "select * from `teacher_consult` where `seq` = '$seq';";
$result = mysqli_query($connect_db, $sql);
$res = mysqli_fetch_array($result);

?>
<textarea name="content" cols="30" rows="10" id="content"><?=$res['content']?></textarea>
<div class="btn_section">
    <div class="btn_wrap">
        <div class="modify_btn" onclick="submit_val();"><a href="#">수정</a></div>
        <div class="delete_btn" onclick="del_val()"><a href="#">삭제</a></div>
        <input type="hidden" value="<?=$res['seq']?>" name="seq">
    </div>
</div>
<script>
    ClassicEditor
        .create( document.querySelector( '#content' ),  {
            toolbar: [
                'headings',
                'bold',
                'italic',
                'link',
                'unlink'
            ]
        })
        .catch( error => {
            console.error( error );
        });
</script>
