<div class="container-fluid" style="background:url(./imgs/body_bg.jpg) no-repeat;">
    <div class="col-md-8 col-md-offset-2" style="z-index:2;padding:5px;">
        <div class="row">
            <!-- 左侧菜单开始 -->
            <div class="col-md-2 hidden-xs">
                <ul id="index-nav">
                    <li><a href=""><span class="glyphicon glyphicon-heart"> </span>&nbsp;&nbsp; 推荐 </a></li>
                    <li><a href=""><span class="glyphicon glyphicon-user"> </span>&nbsp;&nbsp;  明星 </a></li>
                    <li><a href=""><span class="glyphicon glyphicon-star-empty"> </span>&nbsp;&nbsp;  搞笑 </a></li>
                    <li><a href=""><span class="glyphicon glyphicon-heart-empty"> </span>&nbsp;&nbsp;  情感 </a></li>
                    <li><a href=""><span class="glyphicon glyphicon-send"> </span>&nbsp;&nbsp;  社会 </a></li>
                    <li><a href=""><span class="glyphicon glyphicon-sunglasses"> </span>&nbsp;&nbsp;  综艺 </a></li>
                    <li><a href=""><span class="glyphicon glyphicon-cutlery"> </span>&nbsp;&nbsp;  美食 </a></li>
                    <li><a href=""><span class="glyphicon glyphicon-gift"> </span>&nbsp;&nbsp;  美女 </a></li>
                    <li><a href=""><span class="glyphicon glyphicon-equalizer"> </span>&nbsp;&nbsp;  更多 </a></li>
                </ul>
            </div>
            <!-- 左侧菜单结束 -->

            <!-- 中间内容开始 -->
            <div class="col-md-7" style="padding-left:0px;">
                <ul>
                    @foreach($weibos as $weibo)
                        <li>
                            <div class=" col-md-12 weibo-content">
                                <div class="row text-box">
                                    <a href=""><span class="weibo-title"><b></b></span></a>
                                    外国一小哥分享的一款特殊的.....套套..可以让你在黑暗中也能看清自己.....大家自己感受下...我看不懂
                                </div>
                                <div class="btn-box">
                                    <span class="person-info">
                                        <a href=""><img src="holder.js/18x18"></a>
                                        <a href=""><span>@薄荷包蛋派</span></a>
                                        <span class="weibo-time">今天 12:03</span>
                                    </span>
                                    <a class="pull-right weibo-btn" href=""> <i class="fa fa-thumbs-o-up "> </i><span> 27370 </span></a>
                                    <a class="pull-right weibo-btn" href=""> <i class="fa fa-comment-o"> </i><span> 27370 </span></a>
                                    <a class="pull-right weibo-btn" href=""> <i class="fa fa-bookmark"> </i><span> 27370 </span></a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- 中间内容结束 -->

            <!-- 右侧菜单开始 -->
            <div class="col-md-3 hidden-xs" id="hot-box">
                <!-- 热门话题开始 -->
                <div class="row">
                    <div class="col-md-12" id="hot-talk-btn">
                        <b>热门话题</b><a href="" class="pull-right hv-orange"><i class="fa fa-refresh fa-spin"></i> </span> 换一换 </a>
                    </div>
                    <div class="col-md-12" id="hot-talk-list">
                        <ul id="talk-list">
                            <li><a href="">#王宝强离婚#</a> <span class="pull-right">300万</span></li>
                            <li><a href="">#王宝强离婚#</a> <span class="pull-right">300万</span></li>
                            <li><a href="">#王宝强离婚#</a> <span class="pull-right">300万</span></li>
                            <li><a href="">#王宝强离婚#</a> <span class="pull-right">300万</span></li>
                            <li><a href="">#王宝强离婚#</a> <span class="pull-right">300万</span></li>
                            <li><a href="">#王宝强离婚#</a> <span class="pull-right">300万</span></li>
                            <li><a href="">#王宝强离婚#</a> <span class="pull-right">300万</span></li>
                            <li><a href="">#王宝强离婚#</a> <span class="pull-right">300万</span></li>
                            <li><a href="">#王宝强离婚#</a> <span class="pull-right">300万</span></li>
                        </ul>
                    </div>
                    <div class="col-md-12" id="hot-talk-more">
                        <a href="" class="hv-orange">查看更多 ></a>
                    </div>
                </div>
                <!-- 热门话题结束 -->

                <!-- 热门人物开始 -->
                <div class="row">
                    <div class="col-md-12" id="hot-talk-btn">
                        <b class="">热门人物</b>
                    </div>
                    <div class="col-md-12" id="hot-talk-list">
                        <ul class="top-person-list">
                            <li class="top-person"><a href=""><div class="face-box-sm"><img src="holder.js/50x50"></div></a></li>
                            <li class="top-person"><a href=""><div class="face-box-sm"><img src="holder.js/50x50"></div></a></li>
                            <li class="top-person"><a href=""><div class="face-box-sm"><img src="holder.js/50x50"></div></a></li>
                            <li class="top-person"><a href=""><div class="face-box-sm"><img src="holder.js/50x50"></div></a></li>
                            <li class="top-person"><a href=""><div class="face-box-sm"><img src="holder.js/50x50"></div></a></li>
                            <li class="top-person"><a href=""><div class="face-box-sm"><img src="holder.js/50x50"></div></a></li>
                        </ul>
                    </div>
                    <div class="col-md-12" id="hot-talk-more">
                        <a href="" class="hv-orange">查看更多 ></a>
                    </div>
                </div>
                <!-- 热门人物结束 -->

            </div>
            <!-- 右侧菜单结束 -->
        </div>
    </div>
    <!-- 半透明背景 -->
    <div class="col-md-8 col-md-offset-2" id="body-bg"></div>
</div>