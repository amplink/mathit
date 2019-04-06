$(document).ready(function(){
    $('.detail_show_btn').click(function(){
		//alert($(this).html());
		var id = $(this).attr('id');
         $('#modal_wrap'+id).css('display','block');
    })
    $('.r_exit_btn').click(function(){
		var id = $(this).attr('id');
        $('#modal_wrap'+id).css('display','none');
		//alert($(this).parent().parent().parent('.modal_wrap').html());
    })
})