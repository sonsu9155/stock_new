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
