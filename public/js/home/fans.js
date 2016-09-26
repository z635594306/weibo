// var token = $('#token').val();
// var UserInfoId = $('#LoginInfo').val();
/*-------------------------------------添加关注------------------------------------------------*/
function addFollow(myId, followId){
    if (myId == followId) {
        alert('不能关注自己');
        return;
    };

    if (myId == 0) {
        alert('请先登录');
        return;
    };

    $.ajax({
        url:'follow/add',
        data:{'_token':token, 'myId':myId, 'followId':followId},
        type:'post',
        dataType:'json',
        beforeSend:function(){
            $('#fans-btn-'+followId).html('<i class="fa fa-spinner fa-spin"> </i>');
            $('#fans-btn-'+followId).attr('disabled',true);
        },
        success:function(data){
            if (data.error == 0) {
                $('#fans-btn-'+followId).html('取消');
                $('#fans-btn-'+followId).removeAttr('disabled');
                $('#fans-btn-'+followId).attr('class', 'btn btn-warning btn-xs');
                $('#fans-btn-'+followId).attr('onclick', 'delFollow('+myId+','+followId+')');
                alert(data.message);
                return;
            }else if(data.error == 2){
                $('#fans-btn-'+followId).html('取消');
                $('#fans-btn-'+followId).removeAttr('disabled');
                $('#fans-btn-'+followId).attr('class', 'btn btn-warning btn-xs');
                $('#fans-btn-'+followId).attr('onclick', 'delFollow('+myId+','+followId+')');
                alert(data.message);
                return;
            }
                alert(data.message);
                return;

        }
    })
}

/*-------------------------------------添加关注------------------------------------------------*/


/*-------------------------------------取消关注------------------------------------------------*/
function delFollow(myId, followId){
    if (myId == 0) {
        alert('请先登录');
        return;
    };
    $.ajax({
        url:'follow/del',
        data:{'_token':token, 'myId':myId, 'followId':followId},
        type:'post',
        dataType:'json',
        beforeSend:function(){
            $('#fans-btn-'+followId).html('<i class="fa fa-spinner fa-spin"> </i>');
            $('#fans-btn-'+followId).attr('disabled',true);
        },
        success:function(data){
            if (data > 0) {
                $('#fans-btn-'+followId).html('关注');
                $('#fans-btn-'+followId).removeAttr('disabled');
                $('#fans-btn-'+followId).attr('class', 'btn btn-info btn-xs');
                $('#fans-btn-'+followId).attr('onclick', 'addFollow('+myId+','+followId+')');
                alert('取消关注成功');
            }else{
                $('#fans-btn-'+followId).html('关注');
                $('#fans-btn-'+followId).removeAttr('disabled');
                $('#fans-btn-'+followId).attr('class', 'btn btn-info btn-xs');
                $('#fans-btn-'+followId).attr('onclick', 'addFollow('+myId+','+followId+')');
                alert('未知错误');
            };
        }
    })
}
/*-------------------------------------取消关注------------------------------------------------*/

/*-------------------------------------查看粉丝------------------------------------------------*/

function lookFollow(){
    //关闭下拉加载
    get_weibo = false;
    //清空页面内容
    $('#weibo-list').empty();
    //请求后台
    $.ajax({
        url:'/follow/look',
        data:{'_token':token, 'userId':UserInfoId},
        type:'post',
        dataType:'json',
        success:function(data){
            $('#weibo-list').empty();
            var str = '';
            if (data[0].length > 0) {
                var str = '';
                for (var i = 0; i <= data[0].length - 1; i++) {
                    str += '<li>';
                    str += '<div class=" col-md-12 weibo-content">';
                    str += '<a href="">'
                    str += '<div class="weibo-face-box pull-left"><img src="/imgs/face.jpg" class="face-50"></div>'
                    str += '<div class="hot-person-info-big pull-left">'
                    str += '<b class="person-nickname">'+data[0][i].nickname+'</b><br>'
                    str += '<span>状态：</span><span">互相关注</span>'
                    str += '</div></a>'
                    str += '<div class="pull-right person-btn-box">'
                    str += '<button class="btn btn-warning btn-xs" id="fans-btn-'+data[0][i].follow_id+'" onclick="delFollow('+data[0][i].my_id+','+data[0][i].follow_id+')">取消</button>';
                    str += '</div>';
                    str += '</div>';
                    str += '</li>';
                };
                $('#weibo-list').append(str);
            };

            if (data[1].length > 0) {
                var str = '';
                for (var i = 0; i <= data[1].length - 1; i++) {
                    str += '<li>';
                    str += '<div class=" col-md-12 weibo-content">';
                    str += '<a href="">'
                    str += '<div class="weibo-face-box pull-left"><img src="/imgs/face.jpg" class="face-50"></div>'
                    str += '<div class="hot-person-info-big pull-left">'
                    str += '<b class="person-nickname">'+data[1][i].nickname+'</b><br>'
                    str += '<span>状态：</span><span">已关注</span>'
                    str += '</div></a>'
                    str += '<div class="pull-right person-btn-box">'
                    str += '<button class="btn btn-warning btn-xs" id="fans-btn-'+data[1][i].follow_id+'" onclick="delFollow('+data[1][i].my_id+','+data[1][i].follow_id+')">取消</button>';
                    str += '</div>';
                    str += '</div>';
                    str += '</li>';
                };
                $('#weibo-list').append(str);
            };

            if (data[0].length == 0 && data[1].length == 0) {
                str += '<li>';
                str += '<div class=" col-md-12 weibo-content">';
                str += '你 还 没 有 关 注 别 人 !';
                str += '</div>';
                str += '</li>';

                $('#weibo-list').append(str);
            };
        }
    });
}


/*-------------------------------------查看关注------------------------------------------------*/
function lookFans(){
    //关闭下拉加载
    get_weibo = false;
    //清空页面内容
    $('#weibo-list').empty();
    //请求后台
    $.ajax({
        url:'/fans/look',
        data:{'_token':token, 'userId':UserInfoId},
        type:'post',
        dataType:'json',
        success:function(data){
            $('#weibo-list').empty();
            var str = '';
            if (data[0].length > 0) {
                var str = '';
                for (var i = 0; i <= data[0].length - 1; i++) {
                    str += '<li>';
                    str += '<div class=" col-md-12 weibo-content">';
                    str += '<a href="">'
                    str += '<div class="weibo-face-box pull-left"><img src="/imgs/face.jpg" class="face-50"></div>'
                    str += '<div class="hot-person-info-big pull-left">'
                    str += '<b class="person-nickname">'+data[0][i].nickname+'</b><br>'
                    str += '<span>状态：</span><span">互相关注</span>'
                    str += '</div></a>'
                    str += '<div class="pull-right person-btn-box">'
                    str += '<button class="btn btn-warning btn-xs" id="fans-btn-'+data[0][i].follow_id+'" onclick="delFollow('+data[0][i].follow_id+','+data[0][i].my_id+')">取消</button>';
                    str += '</div>';
                    str += '</div>';
                    str += '</li>';
                };
                $('#weibo-list').append(str);
            };

            if (data[1].length > 0) {
                var str = '';
                for (var i = 0; i <= data[1].length - 1; i++) {
                    str += '<li>';
                    str += '<div class=" col-md-12 weibo-content">';
                    str += '<a href="">'
                    str += '<div class="weibo-face-box pull-left"><img src="/imgs/face.jpg" class="face-50"></div>'
                    str += '<div class="hot-person-info-big pull-left">'
                    str += '<b class="person-nickname">'+data[1][i].nickname+'</b><br>'
                    str += '<span>状态：</span><span">已关注你</span>'
                    str += '</div></a>'
                    str += '<div class="pull-right person-btn-box">'
                    str += '<button class="btn btn-info btn-xs" id="fans-btn-'+data[1][i].follow_id+'" onclick="addFollow('+data[1][i].follow_id+','+data[1][i].my_id+')">关注</button>';
                    str += '</div>';
                    str += '</div>';
                    str += '</li>';
                }; 
                $('#weibo-list').append(str);
            }

            if (data[0].length == 0 && data[1].length == 0) {
                str += '<li>';
                str += '<div class=" col-md-12 weibo-content">';
                str += '还 没 有 人 关 注 你 ! ';
                str += '</div>';
                str += '</li>';

                $('#weibo-list').append(str);
            };

        }
    });
}
/*-------------------------------------查看粉丝------------------------------------------------*/