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
                      <th>转发数</th>
                      <th>收藏数</th>
                      <th>评论数</th>
                      <th>时间</th>
                    </tr>
                	<tr>
                        <td>{{ $vo->turn }}</td>
                        <td>{{ $vo->keep }}</td>
                        <td>{{ $vo->comment }}</td>
                        <td>{{ date("Y-m-d H:i:s",$vo->time) }}</td>
                    </tr>
                  </table>
                  <br>
                  <table class="table table-bordered">
                    <tr>
                      <th>评论者</th>
                      <th>评论内容</th>
                      <th>评论时间</th>
                    </tr>
                    @if(count($list) > 0)
	                    @foreach($list as $vv)
	                    <tr>
	                        <td>{{ $vv->nickname }}</td>
	                        <td>{{ $vv->content }}</td>
	                        <td>{{ date("Y-m-d H:i:s",$vv->time) }}</td>
	                    </tr>
						@endforeach
					@else
						<tr>
	                        <td style="width:100%;font-size:22px;" colspan="3"><strong>暂无数据</strong></td>
	                    </tr>
					@endif
                  </table>
                  <br>
                  <button class="btn btn-info" onclick="goback()" id="button">返回</button>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                </div>
              </div><!-- /.box -->

            </div><!-- /.col --> 
          </div><!-- /.row -->
        </section><!-- /.content -->
        
    @endsection

    @section('my-js')
    <script type="text/javascript">
    	$("#button").click(function(){
    		window.history.go(-1) 
    	});
    </script>
	@endsection