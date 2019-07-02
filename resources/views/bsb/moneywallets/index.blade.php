@extends('bsb.templates.admin')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
        钱帐户
            <small>管理  > 钱帐户 </small>
        </h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                <a href="{!! url('/moneywallets/edit') !!}" class="pull-right"><i class="material-icons">add_box</i></a>
                    <h2>
                         钱帐户
                    </h2>

                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover index-table dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>用户名</th>
                                <th>交易金额</th>
                                <th>可用金额</th>
                                <th>创造时间</th>
                                <th>更新时间</th>
                                <th>动作</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($money_wallets)
                            @foreach($money_wallets as $index => $money_wallet)
                                @if($money_wallet->user)
                                <tr>
                                    <td>{{ $money_wallet->id }}</td>                            
                                    <td>{{ $money_wallet->user->name }}</td>             
                                    <td>{{ $money_wallet->before_amount }}</td>
                                    <td>{{ $money_wallet->after_amount }}</td>
                                    <td>{{ $money_wallet->created_at }}</td>
                                    <td>{{ $money_wallet->updated_at }}</td>
                                    <td ></td>
                                </tr>
                                @endif
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
