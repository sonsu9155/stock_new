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
                                <th>出金可用金额</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($users)
                            @foreach($users as $index => $user)                             
                                <tr>
                                    <td>{{ $user->id }}</td>                            
                                    <td>{{ $user->name }}</td>             
                                    <td>                                    
                                    @if($user->money_wallet->after_amount >$user->stock_wallet->after_amount)
                                        ￥{{ number_format( $user->money_wallet->after_amount - $user->stock_wallet->after_amount , 2) }}
                                    @else
                                        ￥0
                                    @endif
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
