@extends('bsb.templates.admin')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
             网站在线历史            
        </h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        网站在线历史
                    </h2>

                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover index-table dataTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>用户身份</th>
                                <th>平台</th>
                                <th>IP</th>
                                <th>进入时间</th>
                                <th>更新时间</th>                               
                                <th>行动</th> 
                            </tr>
                        </thead>
                        <tbody>
                        @if($onlinehistories)
                            @foreach($onlinehistories as $index => $onlinehistory)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $onlinehistory->user_id }}</td>
                                <td>{{ $onlinehistory->platform }}</td>
                                <td>{{ $onlinehistory->ipaddress }}</td>
                                <td>{{ $onlinehistory->created_at }}</td>
                                <td>{{ $onlinehistory->updated_at }}</td>
                                <td>                                   
                                    <a href="javascript:del({{$onlinehistory->id}})" class="col-pink" data-toggle="tooltip" data-placement="bottom" title="Delete" data-original-title="Delete" onclick="return confirm('are you sure?')">
                                    删除
                                    </a>
                                    {!! Form::open(array('url' => 'onlineuser/delete/'.$onlinehistory->id, 'method' => 'POST', 'id' => 'delete'.$onlinehistory->id)) !!}
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
