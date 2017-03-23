@extends('admin.layout.body')

@section('title', '微信公众号接入指南')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">微信公众号配置接入指南</h3>
                </div>
                <div class="box-body">
                    <blockquote>
                        登录 <a href="https://mp.weixin.qq.com/" target="_blank">微信公众平台</a>，点击左侧菜单最后一项，进入 [ <span class="guide">基本配置</span> ]
                    </blockquote>
                    <img src="{{ asset('static/admin/img/guide/guide_01.png') }}">
                    <blockquote>
                        在基本配置，找到［ 服务器配置 ］如果没有启用，先启用，启用了的话，点击[ <span class="guide">修改配置</span> ]
                    </blockquote>
                    <img src="{{ asset('static/admin/img/guide/guide_02.png') }}">
                    <blockquote>
                        将以下信息填入对应的输入框
                    </blockquote>
                    <hr>
                    <h4>URL：<span class="text-light-blue">{{ action('Wechat\WechatController@service')  }}?identity={{ $info['identity'] }}</span></h4>
                    <hr>
                    <h4>Token：<span class="text-light-blue">{{ $info['token'] }}</span></h4>
                    <hr>
                    <h4>EncodingAESKey：<span class="text-light-blue">{{ $info['aes_key'] }}</span></h4>
                    <br>
                    <blockquote class="guide">
                        请按照以上步骤操作，填入对应，信息接入公众平台
                    </blockquote>
                    <button type="button" id="checkActivate" class="btn btn-block btn-success btn-lg">检测是否接入成功</button>
                    <br>
                    <a href="{{ action('Admin\IndexController@index') }}"><button type="button" class="btn btn-block btn-primary btn-lg">返回公众号列表</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .guide{
            color: #d9534f;
        }
    </style>
@endsection

@section('js')
    <script>
        $(function () {
            $('#checkActivate').click(function () {
                swal({
                    title: "检测是否接入成功?",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                },
                function(){
                    $.get('{{ action('Admin\AccountController@getCheckActivate') }}', { identity:'{{ $info->identity }}'}, function(result){
                        if (result.data == 'yes'){
                            swal("接入成功", "", 'success');
                        }else {
                            swal("接入失败，请按照以上步骤操作", "", 'error');
                        }
                    })
                });
            })
        })
    </script>
@endsection