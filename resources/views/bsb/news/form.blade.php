<div class="form-group form-float">
    <div class="form-line
        {!! active_class((($user != null) || (($errors->first('name') != null))), 'focused', '') !!}
        {!! active_class(($errors->first('name') != null), 'error', '') !!}">
        {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
        {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
    </div>
    <span class="col-pink">{!! $errors->first('name') !!}</span>
</div>
<div class="form-group  form-float">
    <div class="form-line
        {!! active_class((($user != null) || (($errors->first('username') != null))), 'focused', '') !!}
        {!! active_class(($errors->first('username') != null), 'error', '') !!}">
        {!! Form::text('username', null, ['class' => 'form-control', 'required']) !!}
        {!! Form::label('username', 'Username', ['class' => 'form-label']) !!}
    </div>
    <span class="col-pink">{!! $errors->first('username') !!}</span>
</div>
<div class="form-group  form-float">
    <div class="form-line
        {!! active_class((($user != null) || (($errors->first('email') != null))), 'focused', '') !!}
        {!! active_class(($errors->first('email') != null), 'error', '') !!}">
        {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
        {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
    </div>
    <span class="col-pink">{!! $errors->first('email') !!}</span>
</div>
<div class="form-group  form-float">
    <div class="form-line
        {!! active_class((($user != null) || (($errors->first('password') != null))), 'focused', '') !!}
        {!! active_class(($errors->first('password') != null), 'error', '') !!}">
        <input type="password" class="form-control" name="password" placeholder="">
        {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}
    </div>
    <span class="col-pink">{!! $errors->first('password') !!}</span>
</div>
<div class="form-group ">
    {!! Form::select('role_id', ['' => '-- Please select --'] + $roles, null, ['class' => 'form-control show-tick', 'required']) !!}
</div>
<br>

@section('additional_header')
<link rel="stylesheet" type="text/css" href="/bsb/plugins/bootstrap-select/css/bootstrap-select.css">
@endsection

@section('additional_footer')
<script src="/bsb/plugins/bootstrap-select/js/bootstrap-select.js" type="text/javascript"></script>
@endsection
