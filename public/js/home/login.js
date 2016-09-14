var code_val = null

var mytime = setInterval(function(){
    $.ajax({
        url:"/reg/code",
        dataType:"text",
        type:"get",
        async:'true',
        success: function(data){
                code_val = data;
            }
    });
},1000);

function login(){
    var input_val = $('input[name=code]').val();
    if (input_val.toLowerCase() == code_val) {
        return true;
    }else{
        alert('验证码错误');
        return false;
    };
};