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