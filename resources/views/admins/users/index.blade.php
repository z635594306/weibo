@extends('admins.base.base')


@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>信息输出表</h1>
    </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-th"></i> 管理员信息管理</h3>
                  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tr>
                      <th style="width:60px">id号</th>
                      <th>邮箱</th>
                      <th>添加时间</th>
                      <th style="width: 170px">操作</th>
                    </tr>
                    @foreach($list as $vo)
                        <tr>
                            <td>{{ $vo->id }}</td>
                            <td>{{ $vo->email }}</td>
                            <td>{{ date("Y-m-d",$vo->registime) }}</td>
                            <td><button class="btn btn-xs btn-danger" onclick="doDel({{ $vo->id }})">删除</button> 
                             
                               <button class="btn btn-xs btn-primary" onclick="window.location='{{URL('admins/users')}}/{{ $vo->id }}/edit'">编辑</button>
                               <button class="btn btn-xs btn-success" onclick="window.location='{{URL('admins/users/create')}}'">添加用户</button></td>
                        </tr>
                    @endforeach
                    
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  {!! $list->appends($where)->render() !!}
                </div>
              </div><!-- /.box -->

            </div><!-- /.col --> 
          </div><!-- /.row -->
        </section><!-- /.content -->
        
    @endsection
    
    @section('myscript')
    <form action="/users/" method="post" name="myform" style="display:none;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <input type="hidden" name="_method" value="delete"/>
           
    </form>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">New message</h4>
          </div>
          <div class="modal-body">
           <!-- 此处填充 -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="button" onclick="saveRole()" class="btn btn-primary">保存</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
        function doDel(id){
            Modal.confirm({msg: "是否删除信息？"}).on(function(e){
                if(e){
                   var form = document.myform;
                    form.action = "{{URL('/admins/users')}}/"+id;
                    form.submit(); 
                }
              });
        }
        
        //加载角色信息
        function loadRole(uid,name){
            $("#exampleModalLabel").html(name+"的角色分配");
            $("#exampleModal").modal("show");
            $.ajax({
                url:"{{URL('admin/users/loadRole')}}/"+uid,
                type:"get",
                dataType:"html",
                async:true,
                success:function(data){
                  // alert(data);

                  $("#exampleModal .modal-body").html(data);   
                },
             });
        }
        
        //保存角色信息
        function saveRole(){
            $.ajax({
                url:"{{URL('admin/users/saveRole')}}",
                type:"post",
                dataType:"html",
                data:$("#rolelistform").serialize() ,
                async:true,
                success:function(data){
                    $('#exampleModal').modal('hide');
                    Modal.alert({msg:data,title: ' 信息提示',btnok: '确定',btncl:'取消'});
                },
             });
             
        }
    </script>
    @endsection