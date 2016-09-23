@extends('admins.base.base')


@section('content')
<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1><i class="fa fa-calendar"></i>会员信息管理 </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- Horizontal Form -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-plus"></i> 编辑管理员信息</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{URL('admins/users')}}/{{ $vo->id }}" method="post">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <input type="hidden" name="_method" value="put">   
                  <div class="box-body">
                    
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">邮箱账号</label>
                      <div class="col-sm-4">
                        <input type="text" name="email" class="form-control" placeholder="邮箱" value="{{ $vo->email }}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
                      <div class="col-sm-4">
                        <input type="password" name="password" class="form-control" placeholder="密码" value="{{ $vo->password }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
            <div class="col-sm-offset-2 col-sm-1">
            <button type="submit" class="btn btn-primary">修改</button>
                    </div>
          <div class="col-sm-1">
            <button type="reset" class="btn btn-primary">重置</button>
          </div>
                  </div><!-- /.box-footer -->
                </form>
        <div class="row"><div class="col-sm-12">&nbsp;</div></div>
        <div class="row"><div class="col-sm-12">
                <br/>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                </div></div>
              </div><!-- /.box -->
       
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
        
    @endsection
  