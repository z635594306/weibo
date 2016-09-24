/*-------------------------关闭广告窗---------------------------------*/
$('#close-left').click(function(){$('#cs_left_couplet').remove();});
$('#close-right').click(function(){$('#cs_right_couplet').remove();});
/*-------------------------关闭广告窗---------------------------------*/

$(function(){
    $.ajax({
        url:'/guanggao',
        type:'get',
        dataType:'json',
        success:function(data){
            $('#guanggao-flash-left').attr('src', data[0].src);
            $('#guanggao-flash-right').attr('src', data[1].src);
            $('#cs_left_couplet').show();
            $('#cs_right_couplet').show();
        }
    });
});