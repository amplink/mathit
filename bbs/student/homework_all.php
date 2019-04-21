<?php
include_once ('head.php');
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/homework_all.css" />
<script>
    $( function() {
          var dateFormat = "y-mm-dd",
            from = $( "#from" )
              .datepicker({
                dateFormat: "y-mm-dd",
                defaultDate: "19-01-01",
                showOn: "button",
                buttonImage: "img/calendar.png",
                buttonImageOnly: true,
                buttonText: "Select date",
                nextText: "다음달",
                prevText: "이전달",
                changeMonth: true,
                dateformat: "yymmdd",
                dayNames: ['월요일', '화요일', '수요일', '목요일', '금요일', '토요일', '일요일'],
                dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'],
                monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
                monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
                numberOfMonths: 1
              })
              .on( "change", function() {
                to.datepicker( "option", "minDate", getDate( this ) );
              }),
            to = $( "#to" ).datepicker({
              dateFormat: "y-mm-dd",
              defaultDate: "19-01-01",
              showOn: "button",
              buttonImage: "img/calendar.png",
              buttonImageOnly: true,
              buttonText: "Select date",
              nextText: "다음달",
              prevText: "이전달",
              changeMonth: true,
              dateformat: "yymmdd",
              dayNames: ['월요일', '화요일', '수요일', '목요일', '금요일', '토요일', '일요일'],
              dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'],
              monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
              monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
              numberOfMonths: 1
            })
            .on( "change", function() {
              from.datepicker( "option", "maxDate", getDate( this ) );
            });

          function getDate( element ) {
            var date;
            try {
              date = $.datepicker.parseDate( dateFormat, element.value );
            } catch( error ) {
              date = null;
            }

            return date;
          }
    });
</script>
<body>
    <!--section-->
    <section>
        <div class="head_p">
            <p class="head_title">숙제관리</p>
            <div class="back_btn"><a href="home.php"><img src="img/back_btn.png" alt="back_btn_icon"></a></div>
        </div>
        <div class="content_p">
            <div class="content_menu_wrap">
                <div class="content_menu"><a href="homework_ing.php">진행 중인 숙제</a></div>
                <div class="content_menu on"><a href="homework_all.php" class="on">전체 목록</a></div>
            </div>
            <div class="content_list_wrap">
                <div class="calendar_wrap">
                    <div class="calendar_section">
                        <input type="tel" id="from" disabled>
                        <span> ~ </span>
                        <input type="tel" id="to" disabled>
                    </div>
                    <div class="search_btn"><img src="img/search_btn.png" alt="search_btn_icon"></div>
                </div>
                <div class="content_list">
                    <div class="content_alarm_section">
                        <a href="homework_submission.php">
                            <!--숙제 제출화면-->
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
                                    <p><span>AM</span> <span>00:00</span></p>
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
                                    <p><span>AM</span> <span>00:00</span></p>
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
                                    <p><span>AM</span> <span>00:00</span></p>
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
                                    <p><span>AM</span> <span>00:00</span></p>
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
                                    <p><span>AM</span> <span>00:00</span></p>
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
                                    <p><span>AM</span> <span>00:00</span></p>
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
                                    <p><span>AM</span> <span>00:00</span></p>
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
                                    <p><span>AM</span> <span>00:00</span></p>
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
                                    <p><span>AM</span> <span>00:00</span></p>
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
                                    <p><span>AM</span> <span>00:00</span></p>
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