@extends('bsb.templates.admin')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
        新闻
            <small>管理  >  新闻</small>
        </h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                <a href="{!! url('/news/create') !!}" class="pull-right">额外</a>
                    <h2>
                    新闻
                    </h2>

                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover index-table dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>形式</th>
                                <th>主题</th>
                                <th>内容</th>
                                <th>创建时间</th>
                                <th>复兴时间</th>                                
                                <th>动作</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($news)
                            @foreach($news as $index => $new)
                            <tr>
                                <td>{{ $new->id }}</td>
                                <td>{{ $new->type }}</td>
                                <td>{{ $new->subject }}</td>
                                <td>{{ $new->contents }}</td>
                                <td>{{ $new->created_at }}</td>
                                <td>{{ $new->updated_at }}</td>
                                <td >                                    
                                    <a class="col-teal" href="{!! url('news/edit/'.$new->id) !!}" data-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit">
                                    汇编
                                    </a>
                                    <a href="javascript:del({{$new->id}})" class="col-pink" data-toggle="tooltip" data-placement="bottom" title="Delete" data-original-title="Delete" onclick="return confirm('are you sure?')">
                                    删除
                                    </a>
                                    {!! Form::open(array('url' => 'news/delete/'.$new->id, 'method' => 'POST', 'id' => 'delete'.$new->id)) !!}
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
