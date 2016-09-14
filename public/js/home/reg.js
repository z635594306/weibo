//邮箱正则
var reg_phone = /^\w+[@]\w+[.]+\w+$/;
var phone = false;
//密码正则
var reg_pwd = /^\w{6,16}$/;
var pwd = false;

var test = false;

var code = null;
var mail = null;
var account = null;

setInterval(function(){
    mail = $('#phone').val();
    $.ajax({
        url:"/reg/code",
        dataType:"text",
        type:"get",
        async:'true',
        success: function(data){
            code = data;
            }
    });
    // $('#test').val(code.toUpperCase());  
    $.ajax({
        url:"/reg/account/" + mail,
        dataType:"text",
        type:"get",
        async:'false',
        success: function(data){
            account = data;
            }
    });

},1000);

$("#phone").focus(function(){
    $(".error").eq(0).find("span:last").html("请输入您的常用邮箱").css("color","#888");
    $(".error").eq(0).find("span:first").attr("class","glyphicon glyphicon-exclamation-sign error-ico").css("color","#41A8FF");
    $(".error").eq(0).css("display","inline-block");
});

$("#pwd").focus(function(){
    $(".error").eq(1).find("span:last").html("请输入6-16位数字、字母或常用符号，字母区分大小写").css("color","#888");
    $(".error").eq(1).find("span:first").attr("class","glyphicon glyphicon-exclamation-sign error-ico").css("color","#41A8FF");
    $(".error").eq(1).css("display","inline-block");
});

$("#test").focus(function(){
    $(".error").eq(2).css("display","inline-block");
});


$("#phone").blur(function(){
    if (!reg_phone.test(this.value)) {
        $(".error").eq(0).find("span:last").html("邮箱号码不正确,请重新输入").css("color","red");
        $(".error").eq(0).find("span:first").attr("class","glyphicon glyphicon-remove error-ico").css("color","#FF5F00");
    }else if(account > 0){
        $(".error").eq(0).find("span:last").html("此邮箱账号已被使用").css("color","red");
        $(".error").eq(0).find("span:first").attr("class","glyphicon glyphicon-remove error-ico").css("color","#FF5F00");
    }else{
        $(".error").eq(0).css("display","none");
        phone = true;
    };
});

$("#pwd").blur(function(){
    if (!reg_pwd.test(this.value)) {
        $(".error").eq(1).find("span:last").html("密码格式不正确,请重新输入").css("color","red");
        $(".error").eq(1).find("span:first").attr("class","glyphicon glyphicon-remove error-ico").css("color","#FF5F00");
    }else{
        $(".error").eq(1).css("display","none");
        pwd = true;
    };
});

// $("#test").blur(function(){
//     $(".error").eq(2).find("span:last").html("验证码错误").css("color","red");
//     $(".error").eq(2).find("span:first").attr("class","glyphicon glyphicon-remove error-ico").css("color","#FF5F00");
// });

$("#test").keyup(function(){
    if (this.value.length < 4 ) {
        return;
    };

    if (this.value.toLowerCase() != code) {
        $(".error").eq(2).find("span:last").html("验证码错误").css("color","red");
        $(".error").eq(2).find("span:first").attr("class","glyphicon glyphicon-remove error-ico").css("color","#FF5F00");
    }else{
        $(".error").eq(2).css("display","none");
        test = true;
    };
});




function sub(){
    if (!phone) {
        alert('邮箱账号有误或已被使用');
        return false;
    }; 

    if (!pwd) {
        alert('密码格式不正确');
        return false;
    };

    if (!test) {
        alert('验证码错误');
        return false;
    };

    return true;
};

