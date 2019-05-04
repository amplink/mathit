<?php
include_once ('head.php');
$page = $_GET['page'];
$search = $_GET['search'];
if(!$page) $page = 1;
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/notice.css" />
<body>
    <!--section-->
    <section>
        <div class="head_p">
            <p class="head_title">공지사항</p>
            <div class="back_btn"><a href="home.php"><img src="img/back_btn.png" alt="back_btn_icon"></a></div>
        </div>
        <div class="content_p">
            <div class="search_box_wrap">
                <div class="search_box">
                    <input type="text" placeholder="제목 검색" id="search_val" onkeydown="chk_enter()" value="<?=$search?>">
                    <div class="search_btn" onclick="search_notice()"><img src="img/search.png" alt="search_icon"></div>
                </div>
            </div>
        </div>
        <div class="content_detail_p">
            <div class="notice_list_wrap">
                <!-- 공지사항 리스트 -->
            </div>
        </div>
    </section>
</body>
</html>
<script>
    var page = <?php echo $page; ?>;

    search_notice();
    function search_notice() {
        var val = $('#search_val').val();
        $.ajax({
            url: 'notice_search.php?search='+val+'&page='+page,
            success: function(res) {
                $('.notice_list_wrap').html(res);
            }
        });
    }

    function chk_enter() {
        if(event.keyCode == 13) search_notice();
    }
</script>