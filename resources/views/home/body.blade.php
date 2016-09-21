<div class="container-fluid" style="background:url(./imgs/body_bg.jpg) no-repeat;">
    <div class="col-md-8 col-md-offset-2" style="z-index:2;padding:5px;">
        <div class="row">
            <!-- 左侧菜单开始 -->
            <div class="col-md-2 hidden-xs">
                <ul id="index-nav">
                    @if(session('userInfo'))
                        <li><a href="">首页</a></li>
                        <li><a href="">我的收藏</a></li>
                        <li><a href="">我的赞</a></li>
                        <li><a href="">我的关注</a></li>
                        <li><a href="">我的粉丝</a></li>
                    @else
                        <li><a href=""><span class="glyphicon glyphicon-heart"> </span>&nbsp;&nbsp; 推荐 </a></li>
                        <li><a href=""><span class="glyphicon glyphicon-user"> </span>&nbsp;&nbsp;  明星 </a></li>
                        <li><a href=""><span class="glyphicon glyphicon-star-empty"> </span>&nbsp;&nbsp;  搞笑 </a></li>
                        <li><a href=""><span class="glyphicon glyphicon-heart-empty"> </span>&nbsp;&nbsp;  情感 </a></li>
                        <li><a href=""><span class="glyphicon glyphicon-send"> </span>&nbsp;&nbsp;  社会 </a></li>
                        <li><a href=""><span class="glyphicon glyphicon-sunglasses"> </span>&nbsp;&nbsp;  综艺 </a></li>
                        <li><a href=""><span class="glyphicon glyphicon-cutlery"> </span>&nbsp;&nbsp;  美食 </a></li>
                        <li><a href=""><span class="glyphicon glyphicon-gift"> </span>&nbsp;&nbsp;  美女 </a></li>
                        <li><a href=""><span class="glyphicon glyphicon-equalizer"> </span>&nbsp;&nbsp;  更多 </a></li>
                    @endif
                </ul>
            </div>
            <!-- 左侧菜单结束 -->

            <!-- 中间内容开始 -->
            <div class="col-md-7" style="padding-left:0px;">
                <ul>
                    <!-- 展示发博框 -->
                    @if(session('userInfo'))
                    <li>
                        <div class=" col-md-12 weibo-content">
                            <div class="row"><img src="{{ asset('imgs/weiboedit.jpg') }}"></div>
                            <textarea id="weibo-edit" name="weiboContent"></textarea>
                            <div class="row">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" id="token">
                                <span id="count-box">还可以输入 <span id="weibo-count">140</span> 字</span>
                                <button class="btn btn-warning pull-right" style="width:80px;" id="published">发布</button>
                            </div>
                        </div>
                    </li>
                    <!-- 展示发博框 -->
                    <!-- 遍历个人微博 -->
                    @foreach ($weibos as $weibo)
                        <li weibo="{{ $weibo->id }}">
                            <div class=" col-md-12 weibo-content">
                                <div class="row">
                                    <div class="weibo-face-box pull-left">
                                        <a href=""><img src="{{ asset('imgs/face.jpg') }}" class="weibo-face"></a>
                                    </div>
                                    <div class="weibo-content-box pull-right">
                                        <a href=""><b>{{ $weibo->nickname }}</b></a><br>
                                        @if(date('Ynj') == date('Ynj',$weibo->time))
                                            <span class="weibo-time">今天 {{ date('H:i',$weibo->time) }}</span>
                                        @elseif(date('Y') == date('Y',$weibo->time))
                                            <span class="weibo-time"> {{ date('n月j日 H:i',$weibo->time) }}</span>
                                        @else
                                            <span class="weibo-time"> {{ date('Y年n月j日',$weibo->time) }}</span>
                                        @endif
                                        <div>{{ $weibo->content }}</div>
                                    </div>
                                </div>
                                <div class="row weibo-btn-box">
                                    <div>转发</div>
                                    <div>收藏</div>
                                    <div onclick="comment({{ $weibo->id }},{{ session('userInfo')->id }})">评论</div>
                                    <div>点赞</div>
                                </div>
                            </div>
                            <div class="col-md-12 weibo-comment-box wb-plk" id="pl-{{ $weibo->id }}" style="display:none;">
                                <div class="row comment-edit-box">
                                    <div class="col-md-1"><img src="{{ asset('imgs/face.jpg') }}" class="wb-comment-face"></div>
                                    <div class="col-md-11"><textarea class="weibo-comment-edit" id="wb-cmt-edit-{{ $weibo->id }}"></textarea></div>
                                    <div class="col-md-11 col-md-offset-1">
                                        
                                            @if($weibo->comment > 0)
                                                <span style="color:#808080;font-size:12px;line-height:25px;">共有{{ $weibo->comment }}条评论</span>
                                            @else
                                                <span style="color:#808080;font-size:12px;line-height:25px;">还没有评论这条微博，快来第一个评论吧！</span>
                                            @endif
                                        
                                        <button class="pull-right btn btn-danger btn-xs comment-btn" id="comment-btn-{{ $weibo->id }}" onclick="setComment({{ $weibo->id }}, {{ session('userInfo')->id }})">评论</button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    <!-- 结束遍历 -->
                    @else
                    <!-- 遍历所有微博 -->
                    @foreach ($weibos as $weibo)
                         <li>
                            <div class=" col-md-12 weibo-content">
                                <div class="row text-box">
                                    <a href=""><span class="weibo-title"><b>#你妈炸了#</b></span></a>
                                    {{ $weibo->content }}
                                </div>
                                <div class="btn-box">
                                    <span class="person-info">
                                        <a href=""><img src="{{ asset('imgs/face.jpg') }}" width="18px" height="18px"></a>
                                        <a href=""><span>{{ '@'.$weibo->nickname }}</span></a>
                                        @if(date('Ynj') == date('Ynj',$weibo->time))
                                            <span class="weibo-time">今天 {{ date('H:i',$weibo->time) }}</span>
                                        @elseif(date('Y') == date('Y',$weibo->time))
                                            <span class="weibo-time"> {{ date('n月j日 H:i',$weibo->time) }}</span>
                                        @else
                                            <span class="weibo-time"> {{ date('Y年n月j日',$weibo->time) }}</span>
                                        @endif
                                    </span>
                                    <a class="pull-right weibo-btn" href=""> <i class="fa fa-thumbs-o-up"> </i><span> {{ $weibo->comment }} </span></a>
                                    <a class="pull-right weibo-btn" href=""> <i class="fa fa-comment-o"> </i><span> {{ $weibo->keep }} </span></a>
                                    <a class="pull-right weibo-btn" href=""> <i class="fa fa-bookmark"> </i><span> {{ $weibo->turn }} </span></a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    <!-- 结束遍历 -->
                    @endif
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
                            <li class="top-person"><a href=""><div class="face-box-sm"><img src="{{ asset('imgs/face.jpg') }}" width="50px" height="50px"></div></a></li>
                            <li class="top-person"><a href=""><div class="face-box-sm"><img src="{{ asset('imgs/face.jpg') }}" width="50px" height="50px"></div></a></li>
                            <li class="top-person"><a href=""><div class="face-box-sm"><img src="{{ asset('imgs/face.jpg') }}" width="50px" height="50px"></div></a></li>
                            <li class="top-person"><a href=""><div class="face-box-sm"><img src="{{ asset('imgs/face.jpg') }}" width="50px" height="50px"></div></a></li>
                            <li class="top-person"><a href=""><div class="face-box-sm"><img src="{{ asset('imgs/face.jpg') }}" width="50px" height="50px"></div></a></li>
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