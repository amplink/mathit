$(document).ready(function(){
    $(document).on("click",".hamburger_btn",function(){
        //$('.hamburger_btn').click(function(){
        $('.hamburger_btn span').toggleClass('on');
        $('.hamburder_nav').toggleClass('on');
        if($('.alarm_box_wrap').hasClass('on') === true) {
            $('.alarm_box_wrap').removeClass('on');
            $('.alarm_box_wrap').hide();
        } else {

        }
    })

    //$('.close_btn').click(function(){
    $(document).on("click",".close_btn",function(){
        $('.hamburger_btn span').removeClass('on');
        $('.hamburder_nav').removeClass('on');
        $('.alarm_box_wrap').removeClass('on');
        $('.alarm_box_wrap').hide();
    })


    $('body').on('click', function(event){

        // $('.alarm_box_wrap').removeClass('on');
        // $('.alarm_box_wrap').addClass('off');
        // if($('.alarm_box_wrap').hasClass('on')){
        //     alert(1);
        //     $('.alarm_box_wrap').addClass('off');
        // }

        if($(event.target.parentElement.parentElement).attr("class")== 'alarm_btn'){

        }else {
            if($(event.target).parents('.alarm_box_wrap').attr("class") == 'alarm_box_wrap') {

            }else {
                if($('.alarm_box_wrap').hasClass('on') === true ) {
                    $('.alarm_box_wrap').removeClass('on');
                    $('.alarm_box_wrap').hide();
                }
            }

        }
        // if($(this).attr('class') == 'test11'){
        //         alert(1);
        //         $('.alarm_box_wrap').toggleClass('on');
        // }else{
        //     alert(2);
        // }


    })

    $(document).on("click",".alarm_btn",function(){
        // $('.alarm_box_wrap').removeClass('off');
        console.log('a');
        if($('.alarm_box_wrap').hasClass('on') === true) {
            $('.alarm_box_wrap').removeClass('on');
            $('.alarm_box_wrap').hide();
        } else {
            $('.alarm_box_wrap').show();
            $('.alarm_box_wrap').addClass('on');
        }
    })
})