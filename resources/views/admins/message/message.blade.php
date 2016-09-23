@extends("admins.base.base")

@section("content")
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>微博信息管理</h1>
    </section>
    <input type="hidden" name="_token" id="token">

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-th"></i> 信息总览</h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tr>
                      <th style="width:170px">用户昵称</th>
                      <th>内容</th>
                      <th style="width: 170px">添加时间</th>
                      <th style="width: 170px">操作</th>
                    </tr>
                    @foreach($list as $vo)
                        <tr id="weibo-list-{{ $vo->id }}">
                            <td>{{ $vo->nickname }}</td>
                            <td>{{ $vo->content }}</td>
                            <td>{{ date("Y-m-d H:i:s",$vo->time) }}</td>
                            <td>
                            	<button class="btn btn-xs btn-danger" onclick="del({{ $vo->id }})">删除</button> 
                                
                                @if(!$vo->lock)
                                  <button class="btn btn-xs btn-warning" id="button-{{ $vo->id }}" onclick="ded({{ $vo->id.','.$vo->lock }})">封印</button>
                                @else
                                  <button class="btn btn-xs btn-info" id="button-{{ $vo->id }}" onclick="ded({{ $vo->id.','.$vo->lock }})">解封</button>
                                @endif
                                <a href="message/{{$vo->id}}">
                                  <button class="btn btn-xs btn-success">显示评论</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                 	{!! $list->render() !!}
                </div>
              </div><!-- /.box -->

            </div><!-- /.col --> 
          </div><!-- /.row -->
        </section><!-- /.content -->
        
    @endsection
    
    @section('my-js')
    <script type="text/javascript" src="{{ asset('js/admin/weibo.js') }}"></script>
	  @endsection