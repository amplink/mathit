$(document).ready(function(){
    $('.ham_wrap').click(function(){
        $('.hamburger_wrap').toggleClass('on');
    })

    $('.close_btn').click(function(){
        $('.hamburger_wrap').removeClass('on');
    })

    $('.calender_icon').click(function(){
        $('.schedule_wrap').toggleClass('on');
    })

    $('.sc_close_btn').click(function(){
        $('.schedule_wrap').removeClass('on');
    })

    $('.onboard_cancel_btn').click(function(){
        $('.bus_box').addClass('on');
    })

    $('.yes_btn, .no_btn').click(function(){
        $('.bus_box').removeClass('on');
    })
}) 