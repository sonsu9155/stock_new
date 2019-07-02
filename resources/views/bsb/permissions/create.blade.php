@extends('bsb.templates.admin')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
             权限
            <small>Credentials > <a href="{!! url('admin/permissions') !!}">权限</a> > 创建</small>
        </h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        创建新权限
                    </h2>
                </div>
                <div class="body">
                    {!! Form::open(['url' => 'admin/permissions']) !!}
                        {!! view('bsb.permissions.form', ['permission' => null]) !!}
                        {!! Form::submit('Save', ['class' => 'btn btn-primary m-t-15 waves-effect']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
