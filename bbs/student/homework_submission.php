<?php
include_once ('head.php');
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/homework_submission.css" />
<body>
    <!--section-->
    <section>
        <div class="head_p">
            <p class="head_title">숙제제출</p>
            <div class="back_btn"><a href="homework_ing.php"><img src="img/back_btn.png" alt="back_btn_icon"></a></div>
        </div>
        <div class="content_p">
           <div class="homework_name_wrap">
               <p class="sub_title">숙제명</p>
               <p class="sub_section_info"><span>주교재</span>
               <span> p</span>
               <span>10~11</span></p>
           </div>
           <div class="homework_limit_wrap">
               <p class="sub_title">마감 시간</p>
               <p class="sub_section_info"><span>~</span>
               <span>9/22</span>
               <span> AM </span>
               <span>00:00</span></p>
           </div>
        </div>
        <div class="content_detail_p">
            <div class="detail_head">
                <p><span>카메라 버튼을 눌러 숙제 이미지를 추가한 후</span><span>체크 버튼을 눌러 저장해 주세요</span></p>
            </div>
            <div class="photo_section">
                <div class="photo_box">
                    <div class="camera_icon"><img src="img/camera.png" alt="camera_icon"></div>
                </div>
                <div class="photo_box">
                    <div class="camera_icon"><img src="img/camera.png" alt="camera_icon"></div>
                </div>
            </div>
            <div class="detail_footer">
                <p><span>현재 등록된 이미지 개수 : </span><span>1</span><span>장</span></p>
                <div class="check_btn"><a href="#none"><img src="img/check_btn.png" alt="check_btn_icon"></a></div>
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
</body>
</html>