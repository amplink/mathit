$(document).ready(function(){
    $('.hamburger_btn').click(function(){
        $('.hamburger_btn span').toggleClass('on');
        $('.hamburder_nav').toggleClass('on');
        if($('.alarm_box_wrap').hasClass('on') === true) {
            $('.alarm_box_wrap').removeClass('on')
        } else {

        }
    })

    $('.close_btn').click(function(){
        $('.hamburger_btn span').removeClass('on');
        $('.hamburder_nav').removeClass('on');
        $('.alarm_box_wrap').removeClass('on');
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
                    $('.alarm_box_wrap').removeClass('on')
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

    $('.alarm_btn').click(function(){
         // $('.alarm_box_wrap').removeClass('off');
        if($('.alarm_box_wrap').hasClass('on') === true) {
             $('.alarm_box_wrap').removeClass('on');
        } else {
            $('.alarm_box_wrap').addClass('on');
        }
    })
})