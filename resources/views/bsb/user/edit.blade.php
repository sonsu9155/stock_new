@extends('bsb.templates.admin')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
        用户
            <small>证书 > <a href="{!! url('/users') !!}">用户</a> > 编辑</small>
        </h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                    编辑 用户
                    </h2>
                </div>
                <div class="body">
                <form class="form-inline" action="/users/update/{{$user->id}}" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="name">帐 号:</label>
                                <input type="text" class="form-control" id="name" placeholder="输入 名称" name="name" value="{{ $user->username}}">
                            </div>
                        </div>  
                        <br/>
                        <br/>
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="password">密 码:</label>
                                <input type="text" class="form-control" id="password" placeholder="输入  密码" name="password" value="">
                            </div>
                        </div> 
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="repassword">重新输入密码:</label>
                                <input type="text" class="form-control" id="repassword" placeholder="重新输入密码" name="confirmpassword" value="">
                            </div>
                        </div> 

                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="username">真实姓名：</label>
                                <input type="text" class="form-control" id="username" placeholder="输入 用户名" name="realname" value="{{ $user->name}}">
                            </div>
                        </div>  
                        <br/>
                        <br/>
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="phone">身份证号码：</label>
                                <input type="text" class="form-control" id="id_card" placeholder="输入  电话" name="idcard" value="{{ $user->idcard}}">
                            </div>
                        </div>  
                        <div class="form-group  form-float" style="margin-top: 20px;">
                            <div class="form-line">
                                <label for="phone">身份证正面照片：</label>
                                <input name="filename[]" type="file"  /></td>
                            </div>
                        </div> 
                        <div class="form-group  form-float" style="margin-top: 20px;">
                            <div class="form-line">
                                <label for="phone">身份证反面照片：</label>
                                <input name="filename[]" type="file"  /></td>
                            </div>
                        </div>    
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="verrification">开户行：</label>
                                <input type="text" class="form-control" id="kh_bank" placeholder="输入  验证号码" name="kh_bank" value="{{ $user->kh_bank}}">
                            </div>
                        </div>  
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="idcard">银行名称:</label>
                                <input type="text" class="form-control" id="bank_name" placeholder="输入  身份证" name="bank_name" value="{{ $user->bank_name}}">
                            </div>
                        </div>
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="idcard">银行卡号码:</label>
                                <input type="text" class="form-control" id="bank_card" placeholder="输入  身份证" name="bank_card" value="{{ $user->bank_card}}">
                            </div>
                        </div>
                        <div class="form-group  form-float" style="margin-top: 20px;">
                            <div class="form-line">
                                <label for="phone">银行卡正面照片:</label>
                                <input name="filename[]" type="file"  class="form-control"/></td>
                            </div>
                        </div> 
                        <div class="form-group  form-float" style="margin-top: 20px;">
                            <div class="form-line">
                                <label for="phone">银行卡反面照片:</label>
                                <input name="filename[]" type="file"  class="form-control"/></td>
                            </div>
                        </div> 
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="idcard">手机:</label>
                                <input type="text" class="form-control" id="mobile" placeholder="输入  身份证" name="mobile" value="{{ $user->phone}}">
                            </div>
                        </div>   
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="idcard">资金密码:</label>
                                <input type="text" class="form-control" id="atmpwd" placeholder="输入  身份证" name="atmpwd" value="{{ $user->atmpwd}}">
                            </div>
                        </div>        
                        <br/>
                        <br/>
                        <button type="submit" class="btn btn-default">提交</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
