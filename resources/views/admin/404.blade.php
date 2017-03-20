@extends('admin.layout.body')

@section('title', '出错了')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <i class="fa fa-warning"></i>
                    <h3 class="box-title">出错了！！！</h3>
                </div>
                <div class="box-body">
                    <div class="callout callout-danger">
                        <h4>{{ $error_msg }}</h4>
                        <h5>[<a href="javascript:history.go(-1);">点击这里返回上一页</a>]</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection