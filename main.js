$(document).ready(function(){
    let hideMenu = $(".menu");
    $(".logo").on("hover", function (event){
        hideMenu.hide();
    });

    $(".logo").on("mouseleave", function (event) {
        hideMenu.show();
    });
});