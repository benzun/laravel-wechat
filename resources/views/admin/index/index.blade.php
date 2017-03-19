@extends('admin.layout.body')

@section('title', '微信公众号列表')

@section('body')
    <div class="row">
        <div class="col-md-12">
            @if(!empty($list))
                @foreach($list as $item)
                <div class="col-md-4">
                    <div class="box box-widget widget-user">

                        <div class="widget-user-header bg-aqua-active" style="background-color: #57c8f2 !important;">
                            <div class="widget-user-image">
                                <img class="img-circle" src="http://open.weixin.qq.com/qr/code/?username={{ $item['wechat_id'] }}" alt="User Avatar">
                            </div>
                            <h3 class="widget-user-username">{{ $item->name }}</h3>
                        </div>



                        <div class="box-footer" style="padding-left: 15px;padding-right: 15px;padding-bottom: 0px;">
                            <div class="row">
                                <a href="{{ action('Admin\AccountController@getChange') }}?account_id={{ $item->id }}"><button type="button" class="btn btn-block btn-primary btn-flat">进入公众号平台</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

@section('css')
    <style>
        .btn-primary{
            background-color: #6ccac9;
            border-color: #6ccac9;
            padding: 10px;
        }
        .widget-user .widget-user-image{
            top: 20px;
            margin-left: -60px;
        }
        .widget-user .widget-user-header{
            height:190px;
        }
        .widget-user .widget-user-image>img{
            width: 120px;
            height:120px;
            border: 5px solid rgba(256,256,256,0.3)
        }
        .widget-user .widget-user-username{
            margin-top: 120px;
            margin-bottom: 0;
            text-align: center;
            font-size: 18px;
            height: 40px;
            line-height: 40px;
        }
    </style>
@endsection