@extends('admin.layout.body')

@section('title', '微信公众号用户列表')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">微信公众号用户列表</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                            <th>#</th>
                            <th>头像</th>
                            <th>微信昵称</th>
                            <th>性别</th>
                            <th>省份</th>
                            <th>城市</th>
                            <th>关注状态</th>
                            <th>关注时间</th>
                        </tr>
                        @if(!empty($list))
                            @foreach($list as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td style="padding: 2px;"><img src="{{ substr($item->headimgurl, 0, -2) }}/64" class="img-circle" height="36"></td>
                                    <td>{{ $item->nickname }}</td>
                                    <td>{{ $admin_config['sex'][$item->sex] }}</td>
                                    <td>{{ $item->province }}</td>
                                    <td>{{ $item->city }}</td>
                                    <td>
                                        <span class="label {{ $item->subscribe == 1 ? 'label-success' : 'label-danger' }}">{{ $admin_config['subscribe'][$item->subscribe] }}</span>
                                    </td>
                                    <td>{{ date('Y-m-d H:i:s',$item->subscribe_time) }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection