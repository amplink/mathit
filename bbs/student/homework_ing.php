<?php
include_once ('head.php');
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/homework_ing.css" />
<body>
    <!--section-->
    <section>
        <div class="head_p">
            <p class="head_title">숙제관리</p>
            <div class="back_btn"><a href="home.php"><img src="img/back_btn.png" alt="back_btn_icon"></a></div>
        </div>
        <div class="content_p">
            <div class="content_menu_wrap">
                <div class="content_menu on"><a href="homework_ing.php" class="on">진행중인 숙제</a></div>
                <div class="content_menu"><a href="homework_all.php">전체 목록</a></div>
            </div>
            <div class="content_list_wrap">
                <div class="content_list">
                    <div class="content_alarm_section btn_on">
                        <a href="homework_submission.php">
                            <!--숙제 제출화면-->
                            <div class="submission">
                                <div class="submission_sign green"></div>
                            </div>
                            <div class="scoring">
                                <div class="scoring_none"><span>-</span></div>
                                <div class="scoring_ing_sign" style="display: none;"><img src="img/doing.png" alt="scoring_icon"></div>
                                <div class="scoring_ed_sign" style="display: none;"><img src="img/check.png" alt="scoring_icon"></div>
                            </div>
                        </a>
                    </div>
                    <div class="content_detail_section">
                        <a href="homework_chat.php">
                            <!--숙제 확인화면-->
                            <div class="book">
                                <div class="section_icon"><img src="img/range.png" alt="range_icon"></div>
                                <div class="section_text">
                                    <p class="book_name">주교재</p>
                                    <p class="book_page"><span>p</span><span>10~11</span></p>
                                </div>
                            </div>
                            <div class="limit">
                                <div class="section_icon"><img src="img/time.png" alt="time_icon"></div>
                                <div class="section_text">
                                    <p>9/20~9/22</p>
                                    <p><span>AM</span><span>00:00</span></p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="content_list">
                    <div class="content_alarm_section">
                        <a href="homework_submission.php">
                            <div class="submission">
                                <div class="submission_sign green"></div>
                            </div>
                            <div class="scoring">
                                <div class="scoring_none" style="display: none;"><span>-</span></div>
                                <div class="scoring_ing_sign"><img src="img/doing.png" alt="scoring_icon"></div>
                                <div class="scoring_ed_sign" style="display: none;"><img src="img/check.png" alt="scoring_icon"></div>
                            </div>
                        </a>
                    </div>
                    <div class="content_detail_section">
                        <a href="homework_chat.php">
                            <div class="book">
                                <div class="section_icon"><img src="img/range.png" alt="range_icon"></div>
                                <div class="section_text">
                                    <p class="book_name">주교재</p>
                                    <p class="book_page"><span>p</span><span>10~11</span></p>
                                </div>
                            </div>
                            <div class="limit">
                                <div class="section_icon"><img src="img/time.png" alt="time_icon"></div>
                                <div class="section_text">
                                    <p>9/20~9/22</p>
                                    <p><span>AM</span><span>00:00</span></p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="content_list">
                    <div class="content_alarm_section btn_on">
                        <a href="homework_submission.php">
                            <div class="submission">
                                <div class="submission_sign blue"></div>
                            </div>
                            <div class="scoring">
                                <div class="scoring_none" style="display: none;"><span>-</span></div>
                                <div class="scoring_ing_sign" style="display: none;"><img src="img/doing.png" alt="scoring_icon"></div>
                                <div class="scoring_ed_sign"><img src="img/check.png" alt="scoring_icon"></div>
                            </div>
                        </a>
                    </div>
                    <div class="content_detail_section btn_on">
                        <a href="homework_chat.php">
                            <div class="book">
                                <div class="section_icon"><img src="img/range.png" alt="range_icon"></div>
                                <div class="section_text">
                                    <p class="book_name">주교재</p>
                                    <p class="book_page"><span>p</span><span>10~11</span></p>
                                </div>
                            </div>
                            <div class="limit">
                                <div class="section_icon"><img src="img/time.png" alt="time_icon"></div>
                                <div class="section_text">
                                    <p>9/20~9/22</p>
                                    <p><span>AM</span><span>00:00</span></p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="content_list">
                    <div class="content_alarm_section">
                        <a href="homework_submission.php">
                            <div class="submission">
                                <div class="submission_sign blue"></div>
                            </div>
                            <div class="scoring">
                                <div class="scoring_none" style="display: none;"><span>-</span></div>
                                <div class="scoring_ing_sign"><img src="img/doing.png" alt="scoring_icon"></div>
                                <div class="scoring_ed_sign" style="display: none;"><img src="img/check.png" alt="scoring_icon"></div>
                            </div>
                        </a>
                    </div>
                    <div class="content_detail_section">
                        <a href="homework_chat.php">
                            <div class="book">
                                <div class="section_icon"><img src="img/range.png" alt="range_icon"></div>
                                <div class="section_text">
                                    <p class="book_name">주교재</p>
                                    <p class="book_page"><span>p</span><span>10~11</span></p>
                                </div>
                            </div>
                            <div class="limit">
                                <div class="section_icon"><img src="img/time.png" alt="time_icon"></div>
                                <div class="section_text">
                                    <p>9/20~9/22</p>
                                    <p><span>AM</span><span>00:00</span></p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="content_list">
                    <div class="content_alarm_section">
                        <a href="homework_submission.php">
                            <div class="submission">
                                <div class="submission_sign blue"></div>
                            </div>
                            <div class="scoring">
                                <div class="scoring_none" style="display: none;"><span>-</span></div>
                                <div class="scoring_ing_sign" style="display: none;"><img src="img/doing.png" alt="scoring_icon"></div>
                                <div class="scoring_ed_sign"><img src="img/check.png" alt="scoring_icon"></div>
                            </div>
                        </a>
                    </div>
                    <div class="content_detail_section final">
                        <a href="homework_chat.php">
                            <div class="book">
                                <div class="section_icon"><img src="img/range.png" alt="range_icon"></div>
                                <div class="section_text">
                                    <p class="book_name">주교재</p>
                                    <p class="book_page"><span>p</span><span>10~11</span></p>
                                </div>
                            </div>
                            <div class="limit">
                                <div class="section_icon"><img src="img/time.png" alt="time_icon"></div>
                                <div class="section_text">
                                    <p>9/20~9/22</p>
                                    <p><span>AM</span><span>00:00</span></p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="content_list">
                    <div class="content_alarm_section">
                        <a href="homework_submission.php">
                            <div class="submission">
                                <div class="submission_sign red"></div>
                            </div>
                            <div class="scoring">
                                <div class="scoring_none" style="display: none;"><span>-</span></div>
                                <div class="scoring_ing_sign" style="display: none;"><img src="img/doing.png" alt="scoring_icon"></div>
                                <div class="scoring_ed_sign"><img src="img/check.png" alt="scoring_icon"></div>
                            </div>
                        </a>
                    </div>
                    <div class="content_detail_section final">
                        <a href="homework_chat.php">
                            <div class="book">
                                <div class="section_icon"><img src="img/range.png" alt="range_icon"></div>
                                <div class="section_text">
                                    <p class="book_name">주교재</p>
                                    <p class="book_page"><span>p</span><span>10~11</span></p>
                                </div>
                            </div>
                            <div class="limit">
                                <div class="section_icon"><img src="img/time.png" alt="time_icon"></div>
                                <div class="section_text">
                                    <p>9/20~9/22</p>
                                    <p><span>AM</span><span>00:00</span></p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="content_list">
                    <div class="content_alarm_section">
                        <a href="homework_submission.php">
                            <div class="submission">
                                <div class="submission_sign blue"></div>
                            </div>
                            <div class="scoring">
                                <div class="scoring_none" style="display: none;"><span>-</span></div>
                                <div class="scoring_ing_sign" style="display: none;"><img src="img/doing.png" alt="scoring_icon"></div>
                                <div class="scoring_ed_sign"><img src="img/check.png" alt="scoring_icon"></div>
                            </div>
                        </a>
                    </div>
                    <div class="content_detail_section final">
                        <a href="homework_chat.php">
                            <div class="book">
                                <div class="section_icon"><img src="img/range.png" alt="range_icon"></div>
                                <div class="section_text">
                                    <p class="book_name">주교재</p>
                                    <p class="book_page"><span>p</span><span>10~11</span></p>
                                </div>
                            </div>
                            <div class="limit">
                                <div class="section_icon"><img src="img/time.png" alt="time_icon"></div>
                                <div class="section_text">
                                    <p>9/20~9/22</p>
                                    <p><span>AM</span><span>00:00</span></p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="content_list">
                    <div class="content_alarm_section">
                        <a href="homework_submission.php">
                            <div class="submission">
                                <div class="submission_sign blue"></div>
                            </div>
                            <div class="scoring">
                                <div class="scoring_none" style="display: none;"><span>-</span></div>
                                <div class="scoring_ing_sign" style="display: none;"><img src="img/doing.png" alt="scoring_icon"></div>
                                <div class="scoring_ed_sign"><img src="img/check.png" alt="scoring_icon"></div>
                            </div>
                        </a>
                    </div>
                    <div class="content_detail_section final">
                        <a href="homework_chat.php">
                            <div class="book">
                                <div class="section_icon"><img src="img/range.png" alt="range_icon"></div>
                                <div class="section_text">
                                    <p class="book_name">주교재</p>
                                    <p class="book_page"><span>p</span><span>10~11</span></p>
                                </div>
                            </div>
                            <div class="limit">
                                <div class="section_icon"><img src="img/time.png" alt="time_icon"></div>
                                <div class="section_text">
                                    <p>9/20~9/22</p>
                                    <p><span>AM</span><span>00:00</span></p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="content_list">
                    <div class="content_alarm_section">
                        <a href="homework_submission.php">
                            <div class="submission">
                                <div class="submission_sign blue"></div>
                            </div>
                            <div class="scoring">
                                <div class="scoring_none" style="display: none;"><span>-</span></div>
                                <div class="scoring_ing_sign" style="display: none;"><img src="img/doing.png" alt="scoring_icon"></div>
                                <div class="scoring_ed_sign"><img src="img/check.png" alt="scoring_icon"></div>
                            </div>
                        </a>
                    </div>
                    <div class="content_detail_section final">
                        <a href="homework_chat.php">
                            <div class="book">
                                <div class="section_icon"><img src="img/range.png" alt="range_icon"></div>
                                <div class="section_text">
                                    <p class="book_name">주교재</p>
                                    <p class="book_page"><span>p</span><span>10~11</span></p>
                                </div>
                            </div>
                            <div class="limit">
                                <div class="section_icon"><img src="img/time.png" alt="time_icon"></div>
                                <div class="section_text">
                                    <p>9/20~9/22</p>
                                    <p><span>AM</span><span>00:00</span></p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="content_list">
                    <div class="content_alarm_section">
                        <a href="homework_submission.php">
                            <div class="submission">
                                <div class="submission_sign blue"></div>
                            </div>
                            <div class="scoring">
                                <div class="scoring_none" style="display: none;"><span>-</span></div>
                                <div class="scoring_ing_sign" style="display: none;"><img src="img/doing.png" alt="scoring_icon"></div>
                                <div class="scoring_ed_sign"><img src="img/check.png" alt="scoring_icon"></div>
                            </div>
                        </a>
                    </div>
                    <div class="content_detail_section final">
                        <a href="homework_chat.php">
                            <div class="book">
                                <div class="section_icon"><img src="img/range.png" alt="range_icon"></div>
                                <div class="section_text">
                                    <p class="book_name">주교재</p>
                                    <p class="book_page"><span>p</span><span>10~11</span></p>
                                </div>
                            </div>
                            <div class="limit">
                                <div class="section_icon"><img src="img/time.png" alt="time_icon"></div>
                                <div class="section_text">
                                    <p>9/20~9/22</p>
                                    <p><span>AM</span><span>00:00</span></p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="page_wrap">
                <div class="page_wrap_wrap">
                    <div class="left_btn"><a href="#none"><img src="img/prev_btn.png" alt="prev_btn_icon"></a></div>
                    <div class="page_btn_wrap">
                        <div class="page_btn"><a href="#none" class="on">1</a></div>
                        <div class="page_btn"><a href="#none">2</a></div>
                        <div class="page_btn"><a href="#none">3</a></div>
                        <div class="page_btn"><a href="#none">4</a></div>
                        <div class="page_btn"><a href="#none">5</a></div>
                        <div class="page_btn"><a href="#none">6</a></div>
                        <div class="page_btn"><a href="#none">7</a></div>
                    </div>
                    <div class="right_btn"><a href="#none"><img src="img/next_btn.png" alt="next_btn_icon"></a></div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>