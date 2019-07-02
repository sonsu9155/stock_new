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
                <form class="form-inline" action="/users/create" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="name">帐 号:</label>
                                <input type="text" class="form-control" id="name"  name="name" value="">
                            </div>
                        </div>  
                        <br/>
                        <br/>
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="password">密 码:</label>
                                <input type="text" class="form-control" id="password"  name="password" value="">
                            </div>
                        </div> 
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="repassword">重新输入密码:</label>
                                <input type="text" class="form-control" id="repassword"  name="confirmpassword" value="">
                            </div>
                        </div> 

                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="username">真实姓名：</label>
                                <input type="text" class="form-control" id="username"  name="realname" value="">
                            </div>
                        </div>  
                        <br/>
                        <br/>
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="phone">身份证号码：</label>
                                <input type="text" class="form-control" id="id_card"  name="idcard" value="">
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
                                <input type="text" class="form-control" id="kh_bank"  name="kh_bank" value="">
                            </div>
                        </div>  
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="idcard">银行名称:</label>
                                <input type="text" class="form-control" id="bank_name"  name="bank_name" value="">
                            </div>
                        </div>
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="idcard">银行卡号码:</label>
                                <input type="text" class="form-control" id="bank_card"  name="bank_card" value="">
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
                                <input type="text" class="form-control" id="mobile"  name="mobile" value="">
                            </div>
                        </div>   
                        <div class="form-group  form-float">
                            <div class="form-line">
                                <label for="idcard">资金密码:</label>
                                <input type="text" class="form-control" id="atmpwd" name="atmpwd" value="">
                            </div>
                        </div> 
                        <input type="text" class="form-control" id="agent"  name="agent" value="1" type="hidden">  
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
