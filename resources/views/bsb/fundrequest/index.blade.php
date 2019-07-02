@extends('bsb.templates.admin')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
        入/扣款要求
               <small>提款/存款 > 存款历史</small>
        </h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                    入/扣款要求
                    </h2>

                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover index-table dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>名称</th>
                                <th>操作类型</th>
                                <th>转账金额</th>
                                <th>选择银行</th>
                                <th>进入时间</th>
                                <th>更新时间</th>
                                <th>行动</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($fund_requests)
                            @foreach($fund_requests as $index => $fund_request)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $fund_request->user_id }}</td>
                                <td>{{ $fund_request->type }}</td>
                                <td>{{ $fund_request->money }}</td>
                                <td>{{ $fund_request->bank }}</td>
                                <td>{{ $fund_request->created_at }}</td>
                                <td>{{ $fund_request->updated_at }}</td>
                                <td >                                    
                                    <a href="javascript:del({{$fund_request->id}})" class="col-pink" data-toggle="tooltip" data-placement="bottom" title="Delete" data-original-title="Delete" onclick="return confirm('are you sure?')">
                                    删除
                                    </a>
                                    {!! Form::open(array('url' => 'fundrequest/delete/'.$fund_request->id, 'method' => 'POST', 'id' => 'delete'.$fund_request->id)) !!}
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
