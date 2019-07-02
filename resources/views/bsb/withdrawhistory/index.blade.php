@extends('bsb.templates.admin')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            提取历史
            <small>提款/存款 > 提取历史</small>
        </h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        提取历史列表
                    </h2>

                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover index-table dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>名称</th>
                                <th>量</th>
                                <th>银行</th>
                                <th>开户行</th>
                                <th>状态</th>
                                <th>行动</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($withdrawHistories)
                            @foreach($withdrawHistories as $index => $withdrawHistory)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $withdrawHistory->user->name }}</td>
                                <td>{{ $withdrawHistory->amount }}</td>
                                <td>{{ $withdrawHistory->bank }}</td>
                                <td>{{ $withdrawHistory->bank_name }}</td>
                                <td>{{ $withdrawHistory->status }}</td>
                                <td>
                                    <a href="javascript:del({{$withdrawHistory->id}})" class="col-pink" data-toggle="tooltip" data-placement="bottom" title="Delete" data-original-title="Delete" onclick="return confirm('are you sure?')">
                                    删除
                                    </a>
                                    {!! Form::open(array('url' => 'withdrawhistory/delete/'.$withdrawHistory->id, 'method' => 'POST', 'id' => 'delete'.$withdrawHistory->id)) !!}
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
