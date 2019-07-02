@extends('bsb.templates.admin')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            存款历史
               <small>提款/存款 > 存款历史</small>
        </h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                    存款历史列表
                    </h2>

                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover index-table dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>名称</th>
                                <th>量</th>
                                <th>帐单类型</th>
                                <th>摘要</th>
                                <th>平衡之前</th>
                                <th>平衡之后</th>
                                <th>行动</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($depositHistories)
                            @foreach($depositHistories as $index => $depositHistory)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $depositHistory->user_id }}</td>
                                <td>{{ $depositHistory->amount }}</td>
                                <td>{{ $depositHistory->type }}</td>
                                <td>{{ $depositHistory->status }}</td>
                                <td>{{ $depositHistory->before_amount }}</td>
                                <td>{{ $depositHistory->before_amount + $depositHistory->amount * 10 }}</td>
                                <td>
                                    <a href="javascript:del({{$depositHistory->id}})" class="col-pink" data-toggle="tooltip" data-placement="bottom" title="Delete" data-original-title="Delete" onclick="return confirm('are you sure?')">
                                    删除
                                    </a>
                                    {!! Form::open(array('url' => 'deposithistory/delete/'.$depositHistory->id, 'method' => 'POST', 'id' => 'delete'.$depositHistory->id)) !!}
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
