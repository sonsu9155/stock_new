@extends('bsb.templates.admin')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
        信息           
        </h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                    信息
                    </h2>

                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover index-table dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>主题</th>
                                <th>内容</th>
                                <th>用户</th>
                                <th>进入时间</th>
                                <th>更新时间</th>                               
                                <th>行动</th> 
                            </tr>
                        </thead>
                        <tbody>
                        @if($messages)
                            @foreach($messages as $index => $message)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $message->subject }}</td>
                                <td>{{ $message->messages[0]->body }}</td>
                                <td>{{ $message->users[0]->name }}</td>   
                                <td>{{ $message->created_at }}</td>
                                <td>{{ $message->updated_at }}</td>
                                <td>                                   
                                    <a href="javascript:del({{$message->id}})" class="col-pink" data-toggle="tooltip" data-placement="bottom" title="Delete" data-original-title="Delete" onclick="return confirm('are you sure?')">
                                    删除
                                    </a>
                                    {!! Form::open(array('url' => 'message/delete/'.$message->id, 'method' => 'POST', 'id' => 'delete'.$message->id)) !!}
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