$(function(){
    $(".reviewName input").change(function(){
        newval = $(this).val();
        $(this).parent().parent().find("input:hidden[name='name']").val(newval);
    })
    $(".reviewMessage textarea" ).change(function(){
        newval = $(this).val();
        $(this).parent().parent().parent().prev().find("input:hidden[name='message']").val(newval);
    })


    $(".reviewApprove").click(function(){
        $(this).siblings().eq(0).val("approve");
        $(this).parent().submit();
    })
    $(".reviewDisApprove").click(function(){
        $(this).siblings().eq(0).val("disapprove");
        $(this).parent().submit();
    })
    $(".reviewDelete").click(function(){
        $(this).siblings().eq(0).val("delete");
        $(this).parent().submit();
    })
});


