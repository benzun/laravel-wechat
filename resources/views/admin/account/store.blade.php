@extends('admin.layout.body')

@section('title', '添加微信公众号')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">添加微信公众号</h3>
                </div>
                <form method="post" class="form-horizontal">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        @if ($errors->has('failed'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('failed') }}
                            </div>
                        @endif

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">公众号名称:</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="公众号名称">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        {{ $errors->first('name') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('wechat_id') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">微信号:</label>
                            <div class="col-sm-10">
                                <input type="text" name="wechat_id" value="{{ old('wechat_id') }}" class="form-control" placeholder="微信号">
                                @if ($errors->has('wechat_id'))
                                    <span class="help-block">
                                        {{ $errors->first('wechat_id') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('original_id') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">公众号原始ID:</label>
                            <div class="col-sm-10">
                                <input type="text" name="original_id" value="{{ old('original_id') }}" class="form-control" placeholder="公众号原始ID">
                                @if ($errors->has('original_id'))
                                    <span class="help-block">
                                        {{ $errors->first('original_id') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">类型:</label>
                            <div class="col-sm-10">
                                @foreach($admin_config['account_type'] as $key => $item)
                                    <label class="radio-inline">
                                        <input type="radio" name="type" value="{{ $key }}" @if ( old('type') == $key) checked  @endif> {{ $item }}
                                    </label>
                                @endforeach
                                <span class="help-block">注意：即使公众平台显示为“未认证”, 但只要【公众号设置】/【账号详情】下【认证情况】显示资质审核通过, 即可认定为认证号.</span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('app_id') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">AppId(应用ID):</label>
                            <div class="col-sm-10">
                                <input type="text" name="app_id" value="{{ old('app_id') }}" class="form-control" placeholder="AppId(应用ID)">
                                @if ($errors->has('app_id'))
                                    <span class="help-block">
                                        {{ $errors->first('app_id') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('secret') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">AppSecret(应用密钥):</label>
                            <div class="col-sm-10">
                                <input type="text" name="secret" value="{{ old('secret') }}" class="form-control" placeholder="AppSecret(应用密钥)">
                                @if ($errors->has('secret'))
                                    <span class="help-block">
                                        {{ $errors->first('secret') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-flat btn-primary"> 提 交 </button>
                                <button type="button" style="margin-left: 5px;" class="btn btn-flat btn-success"> 返 回 </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection