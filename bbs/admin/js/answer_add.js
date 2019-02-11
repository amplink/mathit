$( document ).ready(function() {
    //교재구분 선택시 페이지 이동
    var textbook_val = "";
    $( "#textbook" ).change(function() {
        textbook_val = $("#textbook").val();
        if(textbook_val == "alpha"){
            location.href = 'answer_add.php';
        }else if(textbook_val == "beta"){
            location.href = 'answer_add_2.php';
        }
    });
    var books_class = "";
    $( ".r_nav_menu" ).on("click",function(){
        $( ".r_nav_menu" ).children("p").attr("class", "");
        // books_class = $(this).children("p").attr("class", "on");
        $(this).children("p").attr("class", "on");
    });

    
});