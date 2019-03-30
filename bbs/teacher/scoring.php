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
    <link rel="icon" type="image/png" sizes="96x96" href="img/f.png">
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/scoring.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/swiper.min.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
    <script src="js/swiper.min.js"></script>
    <style>
        html, body {
            position: relative;
            height: 100%;
        }
        body {
            margin: 0;
            padding: 0;
        }
        .swiper-container {
            width: 100%;
            height: 100%;
        }
        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }
    </style>
</head>

<body>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">
                    <span>초6</span>
                    <span>미적분학</span>
                </p>
                <p>
                    <span>(</span>
                    <span>월수금</span>
                    <span> 반</span>
                    <span>)</span>
                </p>
                <p>
                    <span> - </span>
                    <span>엘사</span>
                    <span> 학생</span>
                </p>
            </div>
            <div class="head_right">
                <div class="resend_btn"><a href="#none">재전송 요청</a></div>
                <div class="complete_btn"><a href="#none">완료</a></div>
                <div class="cancel_btn"><a href="#none">취소</a></div>
            </div>
        </div>
    </div>
    <div class="scoring_box">

        <div class="l_section">
            <div class="title_section">
                <p><span>중등</span><span>1-1</span></p>
                <p><span>01.</span><span>이산수학</span></p>
            </div>
            <p>개념다지기</p>
            <div class="score_board_table">
                <table>
                    <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>문항</th>
                        <th>정답</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><span>다지기1</span></td>
                        <td>
                            <div class="img_input_place">정답이미지가 들어갈 자리</div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><span>다지기1</span></td>
                        <td>
                            <div class="img_input_place">정답이미지가 들어갈 자리</div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><span>다지기1</span></td>
                        <td>
                            <div class="img_input_place">정답이미지가 들어갈 자리</div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="r_section">
            <div class="paper_input swiper-container">
                <ul class="swiper-wrapper">
                    <li class="swiper-slide">
                        <div class="paper_img_input"></div>
                    </li>
                    <li class="swiper-slide">
                        <div class="paper_img_input"></div>
                    </li>
                    <li class="swiper-slide">
                        <div class="paper_img_input"></div>
                    </li>
                </ul>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</section>
<script>
    var swiper = new Swiper('.swiper-container', {
        pagination: {
            el: '.swiper-pagination',
            type: 'fraction',
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
</body>

</html>