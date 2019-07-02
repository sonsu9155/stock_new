@extends('bsb.templates.authentication')
@section('content')
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);"></a>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_in" method="POST" url="{{ url('/password/reset') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="msg">重置你的密码</div>
                @include('bsb.partials.flash')
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" placeholder="密码" required>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="确认密码" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 p-t-5">

                    </div>
                    <div class="col-xs-6">
                        <button class="btn btn-block bg-pink waves-effect" type="submit">重设密码</button>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6">
                        <a href="/login">登录</a>
                    </div>
                    <div class="col-xs-6 align-right">

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('additional_footer')
<script src="/bsb/js/customs/reset_password.js" type="text/javascript"></script>
@stop
