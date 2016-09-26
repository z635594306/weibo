var token = $('#token').val();
var UserInfoId = $('#LoginInfo').val();

/*-------------------------------微博类------------------------------------*/


/*-------------------------------微博字数判断*/
$('#weibo-edit').keyup(function(){
    if ($(this).val().length > 140) {
        $('#published').attr('disabled','true');
        $('#count-box').html('已超过 <span id="weibo-count">'+ ($(this).val().length - 140) +'</span> 字');
    }else{
        $('#published').removeAttr('disabled');
        $('#count-box').html('还可以输入 <span id="weibo-count">'+ (140 - $(this).val().length) +'</span> 字');
    };
});
/*-------------------------------微博字数判断*/


/*-------------------------------微博提交*/
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
            if (data.error == 0) {
                var str = '';
                str += '<li id="weibo-'+data[0].id+'" onmousemove="showDel('+data[0].id+')" onmouseout="hideDel('+data[0].id+')" style="display:none">';
                str += '<div class=" col-md-12 weibo-content">';
                str += '<div class="row"><div class="weibo-face-box pull-left">';
                str += '<a href=""><img src="./imgs/face.jpg" class="face-50"></a></div>';
                str += '<div class="weibo-content-box pull-right">';
                str += '<a href=""><b>'+data[1].nickname+'</b></a>';
                str += '<button id="weibo-del-'+data[0].id+'" onclick="delWeibo('+data[0].id+')" class="hidden pull-right weibo-del-btn btn btn-danger btn-xs" style="display:none">删除</button>';
                str += '<br>';
                str += '<span class="weibo-time"> '+data[0].time+'</span>';
                str += '<div>'+data[0].content+'</div>';
                str += '</div></div><div class="row weibo-btn-box">';
                str += '<div id="keep-btn-'+data[0].id+'" onclick="keep('+data[0].id+','+UserInfoId+')">收藏</div>';
                str += '<div onclick="comment('+data[0].id+','+UserInfoId+')">评论</div>';
                str += '<div id="praise-btn-'+data[0].id+'" onclick="praise('+data[0].id+','+UserInfoId+')">赞 <span>'+data[0].praise+'</span></div></div></div>';
                str += '<div class="col-md-12 weibo-comment-box wb-plk" id="pl-'+data[0].id+'" style="display:none;">';
                str += '<div class="row comment-edit-box">';
                str += '<div class="col-md-1"><img src="imgs/face.jpg" class="wb-comment-face"></div>';
                str += '<div class="col-md-11"><textarea class="weibo-comment-edit" id="wb-cmt-edit-'+data[0].id+'"></textarea></div>';
                str += '<div class="col-md-11 col-md-offset-1">'
                if (data[0].comment > 0) {
                    str += '<span style="color:#808080;font-size:12px;line-height:25px;">共有 '+data[0].comment+' 条评论</span>';
                }else{
                    str += '<span style="color:#808080;font-size:12px;line-height:25px;">还没有评论这条微博，快来第一个评论吧！</span>';
                };
                str += '<button class="pull-right btn btn-danger btn-xs comment-btn" id="comment-btn-'+data[0].id+'" onclick="setComment('+data[0].id+', '+data[1].id+')">评论</button>';
                str += '</div></div></div></li>';

                $('#weibo-list').find('li').eq(0).after(str);
                $('#weibo-'+data[0].id).fadeIn(3000);
                alert(data.message);
                $('#weibo-edit').val('');
                return;
            }else{
                alert(data.message);
                return;
            };
        }
    });
});
/*-------------------------------微博提交*/



/*-------------------------------下拉加载*/
var get_weibo = true;
var page = 2;
$(window).scroll(function(){
    var win_height = $(window).height();
    var scrollNum = $(document).height();
    var top = $(document).scrollTop();
    if ((scrollNum-win_height)*0.9 < top && get_weibo) {
        get_weibo = false;

        if (UserInfoId != 0) {
            getWeiboLogin()
        }else{
            getWeiboNoLogin()
        };
    };
});


function getWeiboNoLogin(){
    $.ajax({
        url:'/page/1?page='+page,
        type:'get',
        dataType:'json',
        success:function(data){
            if (data.data.length > 0) {
                var str = '';
                for (var i = 0; i <= data.data.length-1; i++) {
                    str += '<li>'
                    str += '<div class=" col-md-12 weibo-content">';
                    str += '<div class="row text-box">';
                    // str += '<a href=""><span class="weibo-title"><b>#你妈炸了#</b></span></a>';
                    str += data.data[i].content;
                    str += '</div>';
                    str += '<div class="btn-box">';
                    str += '<span class="person-info">';
                    str += '<a href=""><img src="./imgs/face.jpg" width="18px" height="18px"></a>';
                    str += '<a href=""><span>@'+data.data[i].nickname+'</span></a>';
                    str += '<span class="weibo-time">'+data.data[i].time+'</span>';
                    str += '</span>';
                    str += '<a class="pull-right weibo-btn" href=""> <i class="fa fa-thumbs-o-up"> </i><span> '+data.data[i].praise+' </span></a>';
                    str += '<a class="pull-right weibo-btn" href=""> <i class="fa fa-comment-o"> </i><span> '+data.data[i].comment+' </span></a>';
                    str += '<a class="pull-right weibo-btn" href=""> <i class="fa fa-bookmark"> </i><span> '+data.data[i].keep+' </span></a>';
                    str += '</div>';
                    str += '</div>';
                    str += '</li>';
                 };
                 $('#weibo-list').append(str);
                 get_weibo = true;
                 page++;
            };
        }
    });
};



function getWeiboLogin(){
    $.ajax({
        url:'/page/1?page='+page,
        type:'get',
        dataType:'json',
        success:function(data){
            if (data.data.length > 0) {
                var str = '';
                for (var i = 0; i <= data.data.length-1; i++) {
                    str += '<li id="weibo-'+data.data[i].id+'" onmousemove="showDel('+data.data[i].id+')" onmouseout="hideDel('+data.data[i].id+')">';
                    str += '<div class=" col-md-12 weibo-content">';
                    str += '<div class="row"><div class="weibo-face-box pull-left">';
                    str += '<a href=""><img src="./imgs/face.jpg" class="face-50"></a></div>';
                    str += '<div class="weibo-content-box pull-right">';
                    str += '<a href=""><b>'+data.data[i].nickname+'</b></a>'
                    if (data.data[i].user_id == UserInfoId) {
                        str += '<button id="weibo-del-'+data.data[i].id+'" onclick="delWeibo('+data.data[i].id+')" class="hidden pull-right weibo-del-btn btn btn-danger btn-xs" style="display:none">删除</button>';
                    };
                    str += '<br>';
                    str += '<span class="weibo-time"> '+data.data[i].time+'</span>';
                    str += '<div>'+data.data[i].content+'</div>';
                    str += '</div></div><div class="row weibo-btn-box">';
                    str += '<div id="praise-btn-'+data.data[i].id+'" onclick="keep('+data.data[i].id+','+UserInfoId+')">收藏</div>';
                    str += '<div onclick="comment('+data.data[i].id+','+UserInfoId+')">评论</div>';
                    str += '<div id="praise-btn-'+data.data[i].id+'" onclick="praise('+data.data[i].id+','+UserInfoId+')">赞 <span>'+data.data[i].praise+'</span></div></div></div>';
                    str += '<div class="col-md-12 weibo-comment-box wb-plk" id="pl-'+data.data[i].id+'" style="display:none;">';
                    str += '<div class="row comment-edit-box">';
                    str += '<div class="col-md-1"><img src="imgs/face.jpg" class="wb-comment-face"></div>';
                    str += '<div class="col-md-11"><textarea class="weibo-comment-edit" id="wb-cmt-edit-'+data.data[i].id+'"></textarea></div>';
                    str += '<div class="col-md-11 col-md-offset-1">'
                    if (data.data[i].comment > 0) {
                        str += '<span style="color:#808080;font-size:12px;line-height:25px;">共有 '+data.data[i].comment+' 条评论</span>';
                    }else{
                        str += '<span style="color:#808080;font-size:12px;line-height:25px;">还没有评论这条微博，快来第一个评论吧！</span>';
                    };
                    str += '<button class="pull-right btn btn-danger btn-xs comment-btn" id="comment-btn-'+data.data[i].id+'" onclick="setComment('+data.data[i].id+', '+UserInfoId+')">评论</button>';
                    str += '</div></div></div></li>';
                };
            $('#weibo-list').append(str);
            get_weibo = true;
            page++;
            };
        }
    });
};
/*-------------------------------下拉加载*/


/*-------------------------------删除微博*/

function showDel(weiboId){
    $('#weibo-del-'+weiboId).attr('class', 'pull-right btn btn-danger btn-xs');
    $('#weibo-del-'+weiboId).attr('style', '');
};

function hideDel(weiboId){
    $('#weibo-del-'+weiboId).attr('class', 'hidden pull-right btn btn-danger btn-xs');
    $('#weibo-del-'+weiboId).attr('style', 'display:none');
};

function delWeibo(weibo_id){
    $.ajax({
        url:'/delweibo',
        type:'post',
        data:{'_token':token,'weibo_id':weibo_id},
        dataType:'text',
        beforeSend:function(){
            $('#weibo-del-'+weibo_id).html(' <i class="fa fa-spinner fa-spin"> </i> ');
        },
        success:function(data){
            if (data == 1) {
                $('#weibo-'+weibo_id).fadeOut("slow");
                // $('#weibo-'+weibo_id).remove();
            }else{
                alert('删除失败');
            };
        }
    });
}
/*-------------------------------删除微博*/



/*-------------------------------评论类------------------------------------*/

/*-------------------------------评论框显示*/
function comment(wbId, userId){
    $('.wb-plk').slideUp("slow");
    $('#pl-'+wbId+':visible').slideUp("slow");
    $('#pl-'+wbId+':hidden').slideDown("slow");
    var count = $('#pl-'+wbId).children().length;

    if (count <= 1) {
        //调用获取数据函数
        getComment(wbId);
    };
}
/*-------------------------------评论框显示*/


/*-------------------------------ajax获取评论信息*/
function getComment(wbId){
    $.ajax({
        url:'/comment/get',
        type:'post',
        data:{'_token':token,'wbId':wbId},
        async:'true',
        dataType:'json',
        success:function(data){
            var str = '';
            str += '<div class="row" style="display:block">';
            str += '<div class="col-md-11 col-md-offset-1"  id="pl-list-'+wbId+'">';
            str += '</div>';
            str += '</div>';

            $('#pl-'+wbId).append(str);

            str = '';
            for (var i = 0; i <= data.length - 1; i++) {
                str += '<div class="wb-comment-list">';
                    str += '<div class="pull-left comment-face-box">';
                        str += '<img src="/imgs/face.jpg" class="wb-comment-face">';
                    str += '</div>';
                    str += '<div class="wb-comment-info">';
                        str += '<a href="" style="color:#eb7350">'+data[i].nickname+'</a> : ';
                        str += '<span class="comment-content">'+data[i].content+'</span>';
                        str += '<br>';
                        str += '<span class="time">'+unix_to_datetime(data[i].time)+'</span>';
                    str += '</div>';
                str += '</div>';
            };

            $('#pl-list-' + wbId).prepend(str);
        }
    });
};
/*-------------------------------ajax获取评论信息*/


/*-------------------------------写入评论信息并无刷新显示*/
function setComment(wbId, user_id){
    var content = $('#wb-cmt-edit-'+wbId).val();
    if (content.length < 1) {
        alert('评论不能为空');
        return;
    };
    $.ajax({
        url:'/comment/set',
        type:'post',
        data:{'_token':token, 'weibo_id':wbId, 'user_id':user_id, 'comment':content},
        dataType:'json',
        beforeSend:function(){
            $('#comment-btn-'+wbId).html('<i class="fa fa-spinner fa-spin"> </i>');
            $('#comment-btn-'+wbId).attr('disabled',true);
        },
        complete:function(){
            $('#comment-btn-'+wbId).html('评论');
            $('#comment-btn-'+wbId).removeAttr('disabled');
        },
        success:function(data){
            if (data) {
                alert('评论成功');
                var str = '';
                str += '<div class="wb-comment-list">';
                    str += '<div class="pull-left comment-face-box">';
                        str += '<img src="/imgs/face.jpg" class="wb-comment-face">';
                    str += '</div>';
                    str += '<div class="wb-comment-info">';
                        str += '<a href="" style="color:#eb7350">'+data[0].nickname+'</a> : ';
                        str += '<span class="comment-content">'+data[0].content+'</span>';
                        str += '<br>';
                        str += '<span class="time">'+unix_to_datetime(data[0].time)+'</span>';
                        // str += '<span class="wb-cmt-ctt-btn pull-right"><button class="btn btn-info btn-xs">赞</button></span>';
                    str += '</div>';
                str += '</div>';
                $('#pl-list-' + wbId).prepend(str);
                $('textarea').val('');
                return;
            }else{
                alert('评论失败,未知错误');
                return;
            };
        }
    });
}
/*-------------------------------写入评论信息并无刷新显示*/


/*-------------------------------JS处理时间戳*/
function unix_to_datetime(unix) {
    var now = new Date(parseInt(unix) * 1000);
    return now.toLocaleString().replace(/\//, "年").replace(/\//, "月").replace(/\ /, "日 ");
}
/*-------------------------------JS处理时间戳*/

/*-------------------------------点赞类------------------------------------*/

/*-------------------------------点赞处理*/
function praise(weibo_id,user_id){
    $.ajax({
        url:'/praise/add',
        data:{'_token':token,'weibo_id':weibo_id,'user_id':user_id},
        type:'post',
        dataType:'json',
        success:function(data){
            if (data > 0) {
                var count = parseInt($('#praise-btn-'+weibo_id).find('span').html())+1;
                $('#praise-btn-'+weibo_id).html(' 已赞 <span> '+count+' </spam>')
            }else{
                alert('这条微博您已经赞过了!');
            };
        }
    });
}

function delPraise(weibo_id,user_id){
    $.ajax({
        url:'/praise/del',
        data:{'_token':token,'weibo_id':weibo_id,'user_id':user_id},
        type:'post',
        dataType:'json',
        success:function(data){
            if (data > 0) {
                $('#weibo-'+weibo_id).fadeOut("slow");
            }else{
                alert('失败');
            };
        }
    });
}
/*-------------------------------点赞处理*/

/*-------------------------------点赞查看*/
function lookPraise(){
    get_weibo = false;
    $('#weibo-list').empty();
    $.ajax({
        url:'/praise',
        type:'post',
        data:{'_token':token},
        dataType:'json',
        success:function(data){
            $('#weibo-list').empty();
            var str = '';
            if (data.length > 0) {
                for (var i = 0; i <= data.length-1; i++) {
                    str += '<li id="weibo-'+data[i].id+'" onmousemove="showDel('+data[i].id+')" onmouseout="hideDel('+data[i].id+')">';
                    str += '<div class=" col-md-12 weibo-content">';
                    str += '<div class="row"><div class="weibo-face-box pull-left">';
                    str += '<a href=""><img src="./imgs/face.jpg" class="face-50"></a></div>';
                    str += '<div class="weibo-content-box pull-right">';
                    str += '<a href=""><b>'+data[i].nickname+'</b></a>'
                    if (data[i].uid == UserInfoId) {
                        str += '<button id="weibo-del-'+data[i].id+'" onclick="delWeibo('+data[i].id+')" class="hidden pull-right weibo-del-btn btn btn-danger btn-xs" style="display:none">删除</button>';
                    };
                    str += '<br>';
                    str += '<span class="weibo-time"> '+data[i].time+'</span>';
                    str += '<div>'+data[i].content+'</div>';
                    str += '</div></div><div class="row weibo-btn-box">';
                    str += '<div id="keep-btn-'+data[i].id+'" onclick="keep('+data[i].id+','+UserInfoId+')">收藏</div>';
                    str += '<div onclick="comment('+data[i].id+','+UserInfoId+')">评论</div>';
                    str += '<div id="praise-btn-'+data[i].id+'" onclick="delPraise('+data[i].id+','+UserInfoId+')"> 已赞 <span>'+data[i].praise+'</span></div></div></div>';
                    str += '<div class="col-md-12 weibo-comment-box wb-plk" id="pl-'+data[i].id+'" style="display:none;">';
                    str += '<div class="row comment-edit-box">';
                    str += '<div class="col-md-1"><img src="imgs/face.jpg" class="wb-comment-face"></div>';
                    str += '<div class="col-md-11"><textarea class="weibo-comment-edit" id="wb-cmt-edit-'+data[i].id+'"></textarea></div>';
                    str += '<div class="col-md-11 col-md-offset-1">'
                    if (data[i].comment > 0) {
                        str += '<span style="color:#808080;font-size:12px;line-height:25px;">共有 '+data[i].comment+' 条评论</span>';
                    }else{
                        str += '<span style="color:#808080;font-size:12px;line-height:25px;">还没有评论这条微博，快来第一个评论吧！</span>';
                    };
                    str += '<button class="pull-right btn btn-danger btn-xs comment-btn" id="comment-btn-'+data[i].id+'" onclick="setComment('+data[i].id+', '+UserInfoId+')">评论</button>';
                    str += '</div></div></div></li>';
                };
            }else{
                str += '<li>';
                str += '<div class=" col-md-12 weibo-content">';
                str += '您 还 没 有 点 过 赞 唉 ~ 快 去 点 赞 吧 ! ';
                str += '</div>';
                str += '</li>';
            };
            $('#weibo-list').append(str);
        }
    });
}
/*-------------------------------点赞查看*/

/*-------------------------------点赞类------------------------------------*/









/*-------------------------------收藏类------------------------------------*/

function keep(weibo_id,user_id){
    $.ajax({
        url:'/keep/add',
        data:{'_token':token,'weibo_id':weibo_id,'user_id':user_id},
        type:'post',
        dataType:'json',
        success:function(data){
            if (data > 0) {
                $('#keep-btn-'+weibo_id).html(' 已收藏 ')
            }else{
                alert('这条微博您已经收藏过了，请前往您的收藏查看！');
            };
        }
    });
}


function delKeep(weibo_id,user_id){
    $.ajax({
        url:'/keep/del',
        data:{'_token':token,'weibo_id':weibo_id,'user_id':user_id},
        type:'post',
        dataType:'json',
        success:function(data){
            if (data > 0) {
                $('#weibo-'+weibo_id).fadeOut("slow");
            }else{
                alert('失败');
            };
        }
    });
}



function lookKeep(){
    get_weibo = false;
    $('#weibo-list').empty();
    $.ajax({
        url:'/keep',
        type:'post',
        data:{'_token':token},
        dataType:'json',
        success:function(data){
            $('#weibo-list').empty();
            var str = '';
            if (data.length > 0) {
                for (var i = 0; i <= data.length-1; i++) {
                    str += '<li id="weibo-'+data[i].id+'" onmousemove="showDel('+data[i].id+')" onmouseout="hideDel('+data[i].id+')">';
                    str += '<div class=" col-md-12 weibo-content">';
                    str += '<div class="row"><div class="weibo-face-box pull-left">';
                    str += '<a href=""><img src="./imgs/face.jpg" class="face-50"></a></div>';
                    str += '<div class="weibo-content-box pull-right">';
                    str += '<a href=""><b>'+data[i].nickname+'</b></a>'
                    if (data[i].uid == UserInfoId) {
                        str += '<button id="weibo-del-'+data[i].id+'" onclick="delWeibo('+data[i].id+')" class="hidden pull-right weibo-del-btn btn btn-danger btn-xs" style="display:none">删除</button>';
                    };
                    str += '<br>';
                    str += '<span class="weibo-time"> '+data[i].time+'</span>';
                    str += '<div>'+data[i].content+'</div>';
                    str += '</div></div><div class="row weibo-btn-box">';
                    str += '<div onclick="delKeep('+data[i].id+','+UserInfoId+')">已收藏</div>';
                    str += '<div onclick="comment('+data[i].id+','+UserInfoId+')">评论</div>';
                    str += '<div id="praise-btn-'+data[i].id+'" onclick="praise('+data[i].id+','+UserInfoId+')"> 赞 <span>'+data[i].praise+'</span></div></div></div>';
                    str += '<div class="col-md-12 weibo-comment-box wb-plk" id="pl-'+data[i].id+'" style="display:none;">';
                    str += '<div class="row comment-edit-box">';
                    str += '<div class="col-md-1"><img src="imgs/face.jpg" class="wb-comment-face"></div>';
                    str += '<div class="col-md-11"><textarea class="weibo-comment-edit" id="wb-cmt-edit-'+data[i].id+'"></textarea></div>';
                    str += '<div class="col-md-11 col-md-offset-1">'
                    if (data[i].comment > 0) {
                        str += '<span style="color:#808080;font-size:12px;line-height:25px;">共有 '+data[i].comment+' 条评论</span>';
                    }else{
                        str += '<span style="color:#808080;font-size:12px;line-height:25px;">还没有评论这条微博，快来第一个评论吧！</span>';
                    };
                    str += '<button class="pull-right btn btn-danger btn-xs comment-btn" id="comment-btn-'+data[i].id+'" onclick="setComment('+data[i].id+', '+UserInfoId+')">评论</button>';
                    str += '</div></div></div></li>';
                };
            }else{
                str += '<li>';
                str += '<div class=" col-md-12 weibo-content">';
                str += ' 您 还 没 有 收 藏 过 微 博 ';
                str += '</div>';
                str += '</li>';
            };
            $('#weibo-list').append(str);
        }
    });
}
/*-------------------------------收藏类------------------------------------*/
