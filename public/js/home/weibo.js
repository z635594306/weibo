var token = $('#token').val();


//显示评论输入框
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

//获取评论数据
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
                        str += '<span class="wb-cmt-ctt-btn pull-right"><button class="btn btn-info btn-xs">赞</button></span>';
                    str += '</div>';
                str += '</div>';
            };

            $('#pl-list-' + wbId).prepend(str);
        }
    });
}     


//写入评论
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
                        str += '<span class="wb-cmt-ctt-btn pull-right"><button class="btn btn-info btn-xs">赞</button></span>';
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



//将时间戳转换为事件字符串
function unix_to_datetime(unix) {
    var now = new Date(parseInt(unix) * 1000);
    return now.toLocaleString().replace(/\//, "年").replace(/\//, "月").replace(/\ /, "日 ");
}