@extends('bsb.templates.admin')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
                购买历史
            <small>买/卖 > 购买历史</small>
        </h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        销售历史列表
                    </h2>

                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover index-table dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>名称</th>
                                <th>证券代码</th>
                                <th>证券名称</th>
                                <th>升/跌</th>
                                <th>买入成本价</th>
                                <th>买入手续费</th>
                                <th>买入下单时间</th>
                                <th>买出成本价</th>
                                <th>买出手续费</th>
                                <th>买出下单时间</th>
                                <th>手数</th>
                                <th>留仓费</th>
                                <th>印花税</th>
                                <th>盈亏</th>
                                <th>行动</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sellHistories as $index => $sellhistory)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $sellhistory->user->name }}</td>
                                <td>{{ $sellhistory->stockType->code }}</td>                               
                                <td>{{ $sellhistory->stockType->cn_name }}</td>
                                <td>{{ $sellhistory->method }}</td>
                                <td>{{ $sellhistory->buy_cost }}</td>
                                <td>{{ $sellhistory->buy_fee }}</td>
                                <td>{{ $sellhistory->buy_time  }}</td>
                                <td>{{ $sellhistory->sell_cost }}</td>
                                <td>{{ $sellhistory->sell_fee }}</td>
                                <td>{{ $sellhistory->created_at }}</td>
                                <td>{{ $sellhistory->amount }}</td>
                                <td>{{ $sellhistory->save_fee  * $sellhistory->amount * $sellhistory->sell_cost }}</td>
                                <td>{{ $sellhistory->state_fee * $sellhistory->amount * $sellhistory->sell_cost }}</td>
                                <td>{{ $sellhistory->fee }}</td>
                                <td>                                   
                                    <a href="javascript:del({{$sellhistory->id}})" class="col-pink" data-toggle="tooltip" data-placement="bottom" title="Delete" data-original-title="Delete" onclick="return confirm('are you sure?')">
                                    删除
                                    </a>
                                    {!! Form::open(array('url' => 'sellhistory/delete/'.$sellhistory->id, 'method' => 'POST', 'id' => 'delete'.$sellhistory->id)) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
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
