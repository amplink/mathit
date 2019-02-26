<?php
include_once ('_common.php');
include_once ('head.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MathIt - teacher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/student_manegement_record.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
</head>

<body>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text"><span>초6</span>
                    <span> - </span>
                    <span>루트 </span>
                    <span>(월수금반)</span></p>
            </div>
            <div class="head_right">
                <div class="report_manegement_btn"><a href="record_manegement_list.html">성적관리</a></div>
                <div class="hw_make_btn"><a href="homework_manegement_add.html">숙제생성</a></div>
                <div class="scoring_shortcut_btn"><a href="student_manegement_score_each.html">채점바로가기</a></div>
            </div>
        </div>
    </div>
    <div class="class_table_section">
        <table>
            <thead>
            <tr>
                <th>이름</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><span>리오넬 메시</span></td>
                <td>
                    <div class="hw_manegement_btn disable"><a href="homework_manegement_personal.html">숙제관리</a></div>
                    <div class="con_manegement_btn"><a href="consult_manegement_write.html">상담관리</a></div>
                    <div class="report_view_btn disable"><a href="student_manegement_personal_record.html">성적표</a></div>
                    <div class="scoring_list_btn"><a href="scoring_list.html">채점목록</a></div>
                </td>
            </tr>
            <tr>
                <td><span>전원책</span></td>
                <td>
                    <div class="hw_manegement_btn disable"><a href="homework_manegement_personal.html">숙제관리</a></div>
                    <div class="con_manegement_btn"><a href="consult_manegement_write.html">상담관리</a></div>
                    <div class="report_view_btn disable"><a href="student_manegement_personal_record.html">성적표</a></div>
                    <div class="scoring_list_btn"><a href="scoring_list.html">채점목록</a></div>
                </td>
            </tr>
            <tr>
                <td><span>문재인</span></td>
                <td>
                    <div class="hw_manegement_btn disable"><a href="homework_manegement_personal.html">숙제관리</a></div>
                    <div class="con_manegement_btn"><a href="consult_manegement_write.html">상담관리</a></div>
                    <div class="report_view_btn disable"><a href="student_manegement_personal_record.html">성적표</a></div>
                    <div class="scoring_list_btn"><a href="scoring_list.html">채점목록</a></div>
                </td>
            </tr>
            <tr>
                <td><span>이명박</span></td>
                <td>
                    <div class="hw_manegement_btn disable"><a href="homework_manegement_personal.html">숙제관리</a></div>
                    <div class="con_manegement_btn"><a href="consult_manegement_write.html">상담관리</a></div>
                    <div class="report_view_btn disable"><a href="student_manegement_personal_record.html">성적표</a></div>
                    <div class="scoring_list_btn"><a href="scoring_list.html">채점목록</a></div>
                </td>
            </tr>
            <tr>
                <td><span>트럼프</span></td>
                <td>
                    <div class="hw_manegement_btn disable"><a href="homework_manegement_personal.html">숙제관리</a></div>
                    <div class="con_manegement_btn"><a href="consult_manegement_write.html">상담관리</a></div>
                    <div class="report_view_btn disable"><a href="student_manegement_personal_record.html">성적표</a></div>
                    <div class="scoring_list_btn"><a href="scoring_list.html">채점목록</a></div>
                </td>
            </tr>
            <tr>
                <td><span>아베신조</span></td>
                <td>
                    <div class="hw_manegement_btn disable"><a href="homework_manegement_personal.html">숙제관리</a></div>
                    <div class="con_manegement_btn"><a href="consult_manegement_write.html">상담관리</a></div>
                    <div class="report_view_btn disable"><a href="student_manegement_personal_record.html">성적표</a></div>
                    <div class="scoring_list_btn"><a href="scoring_list.html">채점목록</a></div>
                </td>
            </tr>
            <tr>
                <td><span>간디</span></td>
                <td>
                    <div class="hw_manegement_btn disable"><a href="homework_manegement_personal.html">숙제관리</a></div>
                    <div class="con_manegement_btn"><a href="consult_manegement_write.html">상담관리</a></div>
                    <div class="report_view_btn disable"><a href="student_manegement_personal_record.html">성적표</a></div>
                    <div class="scoring_list_btn"><a href="scoring_list.html">채점목록</a></div>
                </td>
            </tr>
            <tr>
                <td><span>엄홍길</span></td>
                <td>
                    <div class="hw_manegement_btn disable"><a href="homework_manegement_personal.html">숙제관리</a></div>
                    <div class="con_manegement_btn"><a href="consult_manegement_write.html">상담관리</a></div>
                    <div class="report_view_btn disable"><a href="student_manegement_personal_record.html">성적표</a></div>
                    <div class="scoring_list_btn"><a href="scoring_list.html">채점목록</a></div>
                </td>
            </tr>
            <tr>
                <td><span>푸틴</span></td>
                <td>
                    <div class="hw_manegement_btn disable"><a href="homework_manegement_personal.html">숙제관리</a></div>
                    <div class="con_manegement_btn"><a href="consult_manegement_write.html">상담관리</a></div>
                    <div class="report_view_btn disable"><a href="student_manegement_personal_record.html">성적표</a></div>
                    <div class="scoring_list_btn"><a href="scoring_list.html">채점목록</a></div>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</section>
</body>

</html>
