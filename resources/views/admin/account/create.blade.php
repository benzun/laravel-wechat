@extends('admin.layout.body')

@section('title', '添加微信公众号')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">添加微信公众号</h3>
                </div>
                <form method="post" action="" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">公众号名称:</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="公众号名称">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">微信号:</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="微信号">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">公众号原始ID:</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="公众号原始ID">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">AppId(应用ID):</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="AppId(应用ID)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">AppSecret(应用密钥):</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="AppSecret(应用密钥)">
                                <span class="help-block">Help block with error</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">帐号类型:</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                            </div>
                        </div>


                    </div>
                    <div class="box-footer">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">提 交</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection