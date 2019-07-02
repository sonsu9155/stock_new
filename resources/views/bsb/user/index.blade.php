@extends('bsb.templates.admin')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            用户
            <small>管理  >  用户</small>
        </h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                <a href="{!! url('/users/create') !!}" class="pull-right">额外</a>
                    <h2>
                        用户列表
                    </h2>

                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover index-table dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>帐 号</th>
                                <th>真实姓名</th>
                                <th>身份证号码</th>
                                <th>开户行</th>
                                <th>银行名称</th>
                                <th>银行卡号码</th>
                                <th>手机</th>
                                <th>资金密码</th>
                                <th>钱钱包ID</th>
                                <th>股票钱包ID</th>
                                <th>动作</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($users)
                            @foreach($users as $index => $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->idcard }}</td>
                                <td>{{ $user->kh_bank }}</td>
                                <td>{{ $user->bank_name }}</td>
                                <td>{{ $user->bank_card }}</td>
                                <td>{{ $user->phone }} </td>
                                <td>{{ $user->atmpwd }} </td>
                                <td>{{ $user->money_wallet_id }}</td>
                                <td>{{ $user->stock_wallet_id }}</td>
                                <td >
                                    <a class="col-teal" href="{!! url('users/detail/'.$user->id) !!}" data-toggle="tooltip" data-placement="bottom" title="Detail" data-original-title="Detail">
                                    详情
                                    </a>
                                    <a class="col-teal" href="{!! url('users/edit/'.$user->id) !!}" data-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit">
                                    汇编
                                    </a>
                                    <a href="javascript:del({{$user->id}})" class="col-pink" data-toggle="tooltip" data-placement="bottom" title="Delete" data-original-title="Delete" onclick="return confirm('are you sure?')">
                                    删除
                                    </a>
                                    {!! Form::open(array('url' => 'users/delete/'.$user->id, 'method' => 'POST', 'id' => 'delete'.$user->id)) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('additional_footer')
<?php Assets::add('datatable'); ?>
<script type="text/javascript">
    $(function () {
        $('.index-table').DataTable({
            'scrollX': true
        });
    });

    function del(id) {
        $('#delete' + id).submit();
    }
</script>
@endsection
