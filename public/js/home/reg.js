//邮箱正则
var reg_email = /^\w+[@]\w+[.]+\w+$/;
//密码正则
var reg_pwd = /^\w{6,16}$/;

//点击触发提示//
$("#email").focus(function(){
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
//点击触发提示结束//

//邮箱失去焦点
$("#email").blur(function(){
    if (!reg_email.test(this.value)) {
        $(".error").eq(0).find("span:last").html("邮箱号码不正确,请重新输入").css("color","red");
        $(".error").eq(0).find("span:first").attr("class","glyphicon glyphicon-remove error-ico").css("color","#FF5F00");
    }else{
        $(".error").eq(0).css("display","none");
    };
});
//邮箱失去焦点结束


//密码失去焦点
$("#pwd").blur(function(){
    if (!reg_pwd.test(this.value)) {
        $(".error").eq(1).find("span:last").html("密码格式不正确,请重新输入").css("color","red");
        $(".error").eq(1).find("span:first").attr("class","glyphicon glyphicon-remove error-ico").css("color","#FF5F00");
    }else{
        $(".error").eq(1).css("display","none");
    };
});
//密码失去焦点结束



function reg(){
    //密码格式默认不正确
    var pwd_code = 1;
    if (reg_pwd.test($('input[name=pwd]').val())) {
        //匹配正确格式密码后修改标识为0
        pwd_code = 0;
    }

    var email = $('#email').val();
    var pwd = $('#pwd').val();
    var code = $('#code').val();
    var token = $('#token').val();
    $.ajax({
        url:"/reg/doreg",
        data:{'_token':token,'email':email,'pwd':pwd,'pwd_code':pwd_code,'code':code},
        dataType:"json",
        type:"post",
        async:'true',
        beforeSend: function () {
            ShowDiv();
        },
        complete: function () {
            HiddenDiv();
        },
        success: function(data){
                if (data.error > 0) {
                    alert(data.message);
                    $('img[name=code]').click();
                    return;
                };
                alert(data.message);
                window.location = '/';
                return;
            }
    });
};


//显示加载数据
function ShowDiv() {
    $('#reg-btn').html('<span class="h4">正 在 提 交</span>');
    $('#reg-btn').attr('disabled','true');
}
//隐藏加载数据
function HiddenDiv() {
    $('#reg-btn').html('<span class="h4">立 即 注 册</span>');
    $('#reg-btn').removeAttr('disabled');
}
