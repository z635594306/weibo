$(function(){
    $('img[name=code]').click();
});


function f5(){
    window.location ='/';
}

/*-------------------------------登陆处理------------------------------------*/
function login(){
    var email = $('#email').val();
    var pwd = $('#pwd').val();
    var code = $('#code').val();
    var token = $('#token').val();
    $.ajax({
        url:"/login",
        data:{'_token':token,'email':email,'pwd':pwd,'code':code},
        dataType:"json",
        type:"post",
        async:'true',
        success: function(data){
                if (data.error > 0) {
                    alert(data.message);
                    $('img[name=code]').click();
                    return;
                };
                f5();
                return;
            }
    });
};
/*-------------------------------登陆处理------------------------------------*/



/*-------------------------------天气API------------------------------------*/
function tianqi(){
    $.ajax({
        url:"/tianqi",
        dataType:"text",
        type:"get",
        success: function(data){
            eval('var tianqi = ' + data + ';');
            $('#tianqi-ico').attr('src','./imgs/tianqi/'+tianqi.results[0].now.code+'.png');
            $('#tq-name').html(tianqi.results[0].location.name);
            $('#tq-text').html(tianqi.results[0].now.text);
            $('#tq-wd').html(tianqi.results[0].now.temperature+'℃');
        }
    });
};

setInterval(tianqi,1800000);
tianqi();
/*-------------------------------天气API------------------------------------*/