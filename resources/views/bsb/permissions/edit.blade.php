@extends('bsb.templates.admin')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            权限
            <small>证书 > <a href="{!! url('admin/permissions') !!}">权限</a> > Edit</small>
        </h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        编辑权限
                    </h2>
                </div>
                <div class="body">
                    {!! Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) !!}
                        <div>
                            <div class="form-group form-float">
                                <div class="form-line
                                    {!! active_class((($permission != null) || (($errors->first('name') != null))), 'focused', '') !!}
                                    {!! active_class(($errors->first('name') != null), 'error', '') !!}">
                                    {!! Form::text('name', null, ['class' => 'form-control', ($permission != null) ? 'disabled' : 'required']) !!}
                                    {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
                                </div>
                                <span class="col-pink">{!! $errors->first('name') !!}</span>
                            </div>
                            <div class="form-group  form-float">
                                <div class="form-line
                                    {!! active_class((($permission != null) || (($errors->first('display_name') != null))), 'focused', '') !!}
                                    {!! active_class(($errors->first('display_name') != null), 'error', '') !!}">
                                    {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
                                    {!! Form::label('display_name', 'Display Name', ['class' => 'form-label']) !!}
                                </div>
                                <span class="col-pink">{!! $errors->first('display_name') !!}</span>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line
                                    {!! active_class((($permission != null) || (($errors->first('description') != null))), 'focused', '') !!}
                                    {!! active_class(($errors->first('description') != null), 'error', '') !!}">
                                    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 2]) !!}
                                    {!! Form::label('description', 'Description', ['class' => 'form-label']) !!}
                                </div>
                                <span class="col-pink">{!! $errors->first('description') !!}</span>
                            </div>
                        </div>
                        <br>

                        {!! Form::submit('Save', ['class' => 'btn btn-primary m-t-15 waves-effect']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
