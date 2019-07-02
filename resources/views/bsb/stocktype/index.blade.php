@extends('bsb.templates.admin')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
        系统设置
            <small>管理>股票类型</small>
        </h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a href="{!! url('/stocktype/create') !!}" class="pull-right"><i class="material-icons">add_box</i></a>
                    <h2>
                    库存类型清单
                    </h2>

                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover index-table dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>选项</th>
                                <th>码</th>
                                <th>中文名</th>
                                <th>提交</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stockTypes as $index => $stockType)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $stockType->option }}</td>
                                <td>{{ $stockType->code }}</td>
                                <td>{{ $stockType->cn_name }}</td>
                                <td >
                                    <a class="col-teal" href="{!! url('stocktype/edit/'.$stockType->id) !!}" data-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit">
                                    汇编
                                    </a>
                                    <a href="javascript:del({{$stockType->id}})" class="col-pink" data-toggle="tooltip" data-placement="bottom" title="Delete" data-original-title="Delete" onclick="return confirm('are you sure?')">
                                    删除
                                    </a>
                                    {!! Form::open(array('url' => 'stocktype/delete/'.$stockType->id, 'method' => 'POST', 'id' => 'delete'.$stockType->id)) !!}
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
