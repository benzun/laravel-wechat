@extends('admin.layout.body')

@section('title', '添加微信公众号')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">更新微信公众号</h3>
                </div>
                <form method="post" class="form-horizontal">
                    {!! csrf_field() !!}
                    <input type="hidden" name="identity" value="{{ $info['identity'] }}">
                    <div class="box-body">
                        @if ($errors->has('failed'))
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('failed') }}
                            </div>
                        @endif

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">公众号名称:</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" value="{{ $info['name'] }}" class="form-control" placeholder="公众号名称">
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
                                <input type="text" name="wechat_id" value="{{ $info['wechat_id'] }}" class="form-control" placeholder="微信号">
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
                                <input type="text" name="original_id" value="{{ $info['original_id'] }}" class="form-control" placeholder="公众号原始ID">
                                @if ($errors->has('original_id'))
                                    <span class="help-block">
                                        {{ $errors->first('original_id') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">AppId(应用ID):</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ $info['app_id'] }}" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('secret') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">AppSecret(应用密钥):</label>
                            <div class="col-sm-10">
                                <input type="text" name="secret" value="{{ substr_replace($info['secret'],'*********************',5,-5) }}" class="form-control" placeholder="AppSecret(应用密钥)">
                                @if ($errors->has('secret'))
                                    <span class="help-block">
                                        {{ $errors->first('secret') }}
                                    </span>
                                @else
                                    <span class="help-block fa fa-exclamation-circle"> 为保障帐号安全，部分可见</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">URL:</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ action('Wechat\WechatController@service')  }}?identity={{ $info['identity'] }}" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Token(令牌):</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ $info['token'] }}" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">EncodingAESKey:</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ $info['aes_key'] }}" class="form-control" disabled>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-flat btn-primary"> 更 新 </button>
                                <button type="button" style="margin-left: 5px;" class="btn btn-flat btn-success" onclick="history.back();"> 返 回 </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection