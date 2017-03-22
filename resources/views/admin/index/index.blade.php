@extends('admin.layout.body')

@section('title', '微信公众号列表')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">我的公众号列表</h3>
                </div>

                <div class="box-header with-border">
                    <a class="btn btn-primary" href="{{ action('Admin\AccountController@getStore') }}"><i class="fa fa-plus"></i> 普通模式添加公众号</a>
                    <a class="btn btn-success" style="margin-left:5px;"><i class="fa fa-weixin"></i> 授权登录添加公众号</a>
                </div>

                <div class="box-body">
                    @if(!empty($list))
                        @foreach($list as $item)
                            <div class="col-md-3">
                                <div class="box-widget widget-user">

                                    <div class="widget-user-header bg-aqua-active" style="background-color: #57c8f2 !important;">
                                        <div class="widget-user-image">
                                            @if(file_exists(\App\Http\Controllers\Common\Helper::getWechatHeadImgPath($item['wechat_id'])))
                                                <img class="img-circle" src="{{ asset( \App\Http\Controllers\Common\Helper::getWechatHeadImgPath($item['wechat_id']) ) }}" alt="User Avatar">
                                            @else
                                                <img class="img-circle" src="http://open.weixin.qq.com/qr/code/?username={{ $item['wechat_id'] }}" alt="User Avatar">
                                            @endif
                                        </div>
                                        <h3 class="widget-user-username getWechaQrCode" data-name="{{ $item['name'] }}" data-wechat_id="{{ $item['wechat_id'] }}" style="cursor: pointer;">{{ $item->name }} <i class="fa fa-qrcode"></i></h3>
                                    </div>

                                    <div class="box-footer" style="padding-left: 15px;padding-right: 15px;padding-bottom: 0px;">
                                        <div class="row" style="padding: 10px 0;">
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <span class="description-text">SALES</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <span class="description-text">SALES</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="description-block">
                                                    <a href="{{ action('Admin\AccountController@getUpdate') }}?identity={{ $item['identity'] }}"><i class="fa fa-edit" aria-hidden="true"></i> 编辑</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @if($item['activate'] == 'yes')
                                            <a href="{{ action('Admin\AccountController@getChange') }}?identity={{ $item->identity }}"><button type="button" class="btn btn-block btn-primary btn-flat enter-the">进入公众号平台</button>
                                            </a>
                                            @else
                                                <a href="{{ action('Admin\AccountController@getGuide') }}?identity={{ $item->identity }}"><button type="button" class="btn btn-block btn-primary btn-flat enter-the">未接入服务，点击进行接入</button>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .box .border-right{
            border-right: 1px solid #e1e1e8;
        }
        .widget-user .box-footer{
            padding-top: 0;
        }
        .btn-primary,.enter-the:hover,.enter-the:active{
            background-color: #6ccac9;
            border-color: #6ccac9;
        }
        .enter-the{
            padding: 8px;
        }
        .widget-user .widget-user-image{
            top: 20px;
            margin-left: -45px;
        }
        .widget-user .widget-user-header{
            height:160px;
        }
        .widget-user .widget-user-image>img{
            width: 90px;
            height:90px;
            border: 5px solid rgba(256,256,256,0.3)
        }
        .widget-user .widget-user-username{
            margin-top: 90px;
            margin-bottom: 0;
            text-align: center;
            font-size: 18px;
            height: 40px;
            line-height: 40px;
        }
        .box-footer{

            border: 1px solid #6ccac9;
        }
    </style>
@endsection