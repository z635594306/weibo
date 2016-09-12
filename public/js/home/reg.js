var reg_phone = /^\w+[@]\w+[.]+\w+$/;
var reg_pwd = /^\w{6,16}$/;

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
    }else{
        $(".error").eq(0).css("display","none");
    };
});

$("#pwd").blur(function(){
    if (!reg_pwd.test(this.value)) {
        $(".error").eq(1).find("span:last").html("密码格式不正确,请重新输入").css("color","red");
        $(".error").eq(1).find("span:first").attr("class","glyphicon glyphicon-remove error-ico").css("color","#FF5F00");
    }else{
        $(".error").eq(1).css("display","none");
    };
});

$("#test").blur(function(){

});