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
                history.go(0);
                return;
            }
    });
};


$('#weibo-edit').keyup(function(){
    if ($(this).val().length > 140) {
        $('#published').attr('disabled','true');
        $('#count-box').html('已超过 <span id="weibo-count">'+ ($(this).val().length - 140) +'</span> 字');
    }else{
        $('#published').removeAttr('disabled');
        $('#count-box').html('还可以输入 <span id="weibo-count">'+ (140 - $(this).val().length) +'</span> 字');
    };
});


$('#published').click(function(){
    var wb_content = $('#weibo-edit').val();
    var token = $('#token').val();
    // alert(token);

    $.ajax({
        url:"/published",
        data:{'_token':token,'weiboContent':wb_content},
        dataType:"json",
        type:"post",
        async:'true',
        success: function(data){
            if (data.error > 0) {
                alert(data.message);
                return;
            };
            alert(data.message);
            history.go(0);
            return;
        }
    });
});


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