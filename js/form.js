/**
 * Created by Artmadiar on 14.03.2016.
 */

initializeForm();

function initializeForm() {

    $('.btn-toggle').click(function() {
        $(this).find('.btn').toggleClass('active');

        input = $(this).find('input');
        if (input.val()=="true")
            input.val("false");
        else
            input.val("true");

        if ($(this).find('.btn-primary').size()>0) {
            $(this).find('.btn').toggleClass('btn-primary');
        }
        if ($(this).find('.btn-danger').size()>0) {
            $(this).find('.btn').toggleClass('btn-danger');
        }
        if ($(this).find('.btn-success').size()>0) {
            $(this).find('.btn').toggleClass('btn-success');
        }
        if ($(this).find('.btn-info').size()>0) {
            $(this).find('.btn').toggleClass('btn-info');
        }

        $(this).find('.btn').toggleClass('btn-default');
    //btn-toggle function end
    });

    //PICTURE START

    $(".pic").each(function(i,el){
        $(this).offset({
            "top" :($(this).offset().top-($(this).width()/1.5))
        });
    });

    $(".link_to_pic").hover(function(){
        pic = $(this).next().next().css("z-index","2");
    },function(){
        $(this).next().next().css("z-index","-1");
    });

    $(".remove_pic").on("click",function() {
        var input_val = $(this).parent().children()[0];
        if (input_val.value != "") {
            input_val.value = "";
            $(this).prev().hide();
            $(this).next().hide();
            $(this).hide();
        }
    });

    //PICTURE END

}