@extends('bsb.templates.admin')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            权限
            <small>Credentials > 权限</small>
        </h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a href="{!! url('admin/permissions/create') !!}" class="pull-right"><i class="material-icons">添加_框</i></a>
                    <h2>
                        权限列表
                    </h2>

                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover index-table dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>显示名称</th>
                                <th>系统名称</th>
                                <th>描述</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                            <tr>
                                <td>{!! $permission->display_name !!}</td>
                                <td>{!! $permission->name !!}</td>
                                <td>{!! $permission->description !!}</td>
                                <td>
                                    <a class="col-teal" href="{!! url('admin/permissions/'.$permission->id.'/edit') !!}" data-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <a href="javascript:del({{$permission->id}})" class="col-pink" data-toggle="tooltip" data-placement="bottom" title="Delete" data-original-title="Delete" onclick="return confirm('are you sure?')">
                                        <i class="material-icons">delete_forever</i>
                                    </a>
                                    {!! Form::open(array('route' => array('permissions.destroy', $permission->id), 'method' => 'delete', 'id' => 'delete'.$permission->id)) !!}
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
