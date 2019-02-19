<div class="hamburder_nav">
    <div class="ham_member_info_wrap">
        <div class="close_btn_line">
            <div class="close_btn"><img src="img/close.png" alt="close_icon"></div>
        </div>
        <div class="ham_member_info_line">
            <div class="ham_member_img"><img src="img/user.png" alt="member_img"></div>
            <div class="ham_member_info">
                <p class="ham_member_name">강태민</p>
                <p class="ham_member_grade">전임강사</p>
            </div>
        </div>
        <div class="ham_other_btn_line">
            <div class="setting_btn"><a href="setting.html"><img src="img/setting.png" alt="setting_icon"></a></div>
            <div class="alarm_btn"><a href="#none"><img class="test11" src="img/alarm.png" alt="alarm_icon"></a></div>
        </div>
    </div>
    <div class="hamnav_menu_wrap">
        <div class="hamnav_menu"><a href="#none"><span>학급목록</span></a>
            <div class="hamnav_class_list">
                <!--                <div class="hamnav_class"><a href="student_manegement_record.html"><span class="class_title">루트</span><span-->
                <!--                            class="class_grade_">초6</span></a></div>-->
                <?php
                for($i=0; $i<count($d_name); $i++) {
                    ?>
                    <div class="hamnav_class"><a href="student_manegement_record.html">
                            <span class="class_title"><?=$d_name[$i]?></span>
                        </a>
                    </div>
                    <?php
                }
                ?>

            </div>
        </div>
        <div class="hamnav_menu"><a href="homework_manegement_add.html"><span>숙제생성</span></a></div>
        <div class="hamnav_menu"><a href="student_manegement_score_all.html"><span>채점바로가기</span></a></div>
        <div class="hamnav_menu"><a href="class_schedule_list.php"><span>수업계획표/일지</span></a></div>
        <div class="hamnav_menu"><a href="notice_list.php"><span>공지사항</span></a></div>
    </div>
    <div class="alarm_box_wrap_wrap">
        <div class="alarm_box_wrap">
            <div class="alarm_tri"><img src="img/alarm_tri.png" alt="alarm_tri_icon"></div>
            <div class="alarm_box">
                <div>
                    <p id="x_alarm_btn" style="cursor:pointer;font-size:20px;font-weight: bold;text-align: right;">X</p>
                    <div>
                        <ul>
                            <li>
                                <div class="alarm_content">
                                    <p>알림내용이 들어갈자리입니다.</p>
                                </div>
                                <div class="alarm_time">
                                    <p><span>5분</span><span> 전</span></p>
                                </div>
                            </li>
                            <li>
                                <div class="alarm_content">
                                    <p>알림내용이 들어갈자리입니다.</p>
                                </div>
                                <div class="alarm_time">
                                    <p><span>5분</span><span> 전</span></p>
                                </div>
                            </li>
                            <li>
                                <div class="alarm_content">
                                    <p>알림내용이 들어갈자리입니다.</p>
                                </div>
                                <div class="alarm_time">
                                    <p><span>5분</span><span> 전</span></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>